<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Entity\Commentaire;
use App\Repository\CommentaireRepository;

class MonCompteController extends AbstractController{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;      
    }
    
    /**
     * @Route("/mon-compte", name="mon-compte")
     */
    public function monCompte(Request $request): Response {      
        //retourne l'email de l'user connecter
        $email= $request->getSession()->get('email');

        // Si l'utilisateur essaye d'accéder a cette route, on lui renvoie une erreur 401
        if(!$request->getSession()->get('email')){
            return new Response("", 401);
        }

        /** @var UserRepository $userRepository */
        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->findOneByEmail($email);

        if($user){      
            //Récupération des commentaire de l'user
            /** @var CommentaireRepository $commentaireRepository */
            $commentaireRepository = $this->entityManager->getRepository(Commentaire::class);
            // Si il est user normal, il ne voit que ses propres commentaires
            if($user->getRole() == 2) {
                $commentaires = $commentaireRepository->findByEmail($email);
            } 
            // Si il est user admin, il voit tous les commentaires
            else {
                $commentaires = $commentaireRepository->findAll($email);
            }            
            
            //Affichage de la page mon compte
            return $this->render('compte/monCompte.html.twig', [
                'css_path' => 'css/lavoie.css',
                'user' => $user,
                'commentaires' => $commentaires
            ]);
        } else {
            return $this->redirectToRoute('accueil');
        }
    }

    /**
     * @Route("/maj-infos-compte", name="maj-infos-compte")
     */
    public function majInfosCompte(Request $request): Response {   
        // Si l'utilisateur essaye d'accéder a cette route, on lui renvoie une erreur 401
        if(!$request->getSession()->get('email')){
            return new Response("", 401);
        }

        // Récupération les données du body de la requête
        $donnees = json_decode($request->getContent(), true);
        
        // Vérification si les données requises sont présentes
        if (!isset($donnees['password'])) {
            return new Response('Les données du compte sont incomplètes.', 400);
        }

        /** @var UserRepository $userRepository */
        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->findOneByEmail($request->getSession()->get('email'));

        $user->setNom($donnees['nom']);
        $user->setPrenom($donnees['prenom']);

        // Vérification de la longueur des champs $email, $prénom et $nom
        if (strlen($donnees['nom']) > 255 ) {
            return new Response(json_encode(['message' => 'Le nom doit faire moins de 255 caractères.']), 400);
        }

        if (strlen($donnees['prenom']) > 255 ) {
            return new Response(json_encode(['message' => 'Le prenom doit faire moins de 255 caractères.']), 400);
        }

        if($donnees['password']){
            if(strlen($donnees['password']) < 8){
                return new Response(json_encode(['message' => 'Le mot de passe doit faire au moins de 8 caractères.']), 400);
            }
            else {
                $user->setPassword($donnees['password']);
            }            
        }
        
        // Enregistrement de l'utilisateur dans la base de données
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->addFlash('success-maj-compte', 'Les modifications ont bien été enregistrées !');

        // 204 (No Content) : Indique que la maj a été effectuée avec succès, 
        // mais qu'aucune donnée n'est renvoyée dans la réponse.
        return new Response('', 204);
    }

    /**
     * @Route("/infos-compte", name="infos-compte")
     */
    public function infosCompte(Request $request): Response {      
        //retourne l'email de l'user connecter
        $email= $request->getSession()->get('email');

        // Si l'utilisateur essaye d'accéder a cette route, on lui renvoie une erreur 401
        if(!$request->getSession()->get('email')){
            return new Response("", 401);
        }

        /** @var UserRepository $userRepository */
        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->findOneByEmail($email);

        return $this->render('compte/infosCompte.html.twig', [
            'css_path' => 'css/lavoie.css',
            'user'=> $user
        ]);
    }
    
    /**
     * @Route("/form-maj-compte", name="form-maj-compte")
     */
    public function formMajCompte(Request $request): Response {
        //retourne l'email de l'user connecter
        $email= $request->getSession()->get('email');

        // Si l'utilisateur essaye d'accéder a cette route, on lui renvoie une erreur 401
        if(!$request->getSession()->get('email')){
            return new Response("", 401);
        }

        /** @var UserRepository $userRepository */
        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->findOneByEmail($email);

        return $this->render('compte/formulaireMajCompte.html.twig', [
            'css_path' => 'css/lavoie.css',
            'user'=> $user
        ]);
    }
}
