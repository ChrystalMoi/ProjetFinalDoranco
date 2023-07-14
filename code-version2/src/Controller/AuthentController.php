<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class AuthentController extends AbstractController {
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;      
    }    

    /**
     * @Route("/authent", name="authent", methods={"POST"})
     */
    public function login(Request $request): Response {
        // Récupération du contenu JSON du corps de la requête
        $content = json_decode($request->getContent(), true);        
        
        //$email = 'eliot@mail.love';
        $email = $content['email'];
        
        // $password = 'azertyuiop';
        $password = $content['password'];

        /** @var UserRepository $userRepository */
        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->findOneByEmail($email);

        if (!$user || !password_verify($password, $user->getPassword())) {
            return new Response(json_encode(['message' => 'Email ou mot de passe incorrect !']), 401);
        }
        
        // $session = $request->getSession();  
        $request->getSession()->start();     

        //Démarrage de la session (de l'ensemble de cookies)
        // $session->start();

        // Stockage en cookies des infos user (tableau[nom du champs, valeur du champs])
        $request->getSession()->set('email', $email);
        $request->getSession()->set('role', $user->getRole());

        return new Response(json_encode(['message' => 'Authentification réussie !']), 200);
    }

    /**
     * @Route("/logout", name="logout", methods={"GET"})
     */
    public function logout(Request $request): Response {
        $request->getSession()->invalidate();
        
        return $this->redirectToRoute('accueil');
    }
}
