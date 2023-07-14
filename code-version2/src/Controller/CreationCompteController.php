<?php

// src/Controller/CreationCompteController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;

class CreationCompteController extends AbstractController {
    private $entityManager;

    //constructeur de la classe 
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/form-creer-compte", name="form-creer-compte")
     */
    public function index(): Response {
        // Afficher le formulaire de création de compte
        return $this->render('compte/creer.html.twig', [
            'css_path' => 'css/lavoie.css'
        ]);
    }

    /**
     * @Route("/creer-compte", name="creer-compte", methods={"POST"})
     */
    public function creationCompte(Request $request): Response {
        // Récupération du contenu JSON du corps de la requête
        $content = json_decode($request->getContent(), true);

        // Vérification du champ email
        if (!isset($content['email']) || empty($content['email'])) {
            return new Response(json_encode(['message' => 'Le champ email est obligatoire']), 400);
        }
        $email = $content['email'];

        // Vérification du champ mot de passe
        if (!isset($content['password']) || empty($content['password'])){
            return new Response(json_encode(['message' => 'Le champ mot de passe est obligatoire']), 400);
        }
        $password = $content['password'];  

        // Vérification des champs nom et prénom
        $prenom = isset($content['prenom']) && $content['prenom'] != '' ? $content['prenom'] : null;
        $nom = isset($content['nom']) && $content['nom'] != '' ? $content['nom'] : null;

        // Vérification de la longueur des champs $email, $prénom et $nom
        if (strlen($email) > 255 ) {
            return new Response(json_encode(['message' => 'L\'email doit faire moins de 255 caractères.']), 400);
        }

        if (strlen($prenom) > 255 ) {
            return new Response(json_encode(['message' => 'Le prénom doit faire moins de 255 caractères.']), 400);
        }

        if (strlen($nom) > 255 ) {
            return new Response(json_encode(['message' => 'Le nom doit faire moins de 255 caractères.']), 400);
        }

        // Initialisation du role par défaut -> Utilisateur normal 
        //1 = Administrateur
        //2 = Utilisateur normal
        $role = 2;    

        // Vérification de si l'utilisateur existe déjà avec l'email donné
        $existingUser = $this->entityManager->getRepository(User::class)->findOneByEmail(['email' => $email]);
        if ($existingUser) {
            // Si l'utilisateur existe déjà, renvoyer une réponse avec un message d'erreur
            return new Response(json_encode(['message' => 'Un compte avec cet email existe déjà !']), 400);
        }

        // Création d'un nouvel utilisateur
        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setPrenom($prenom);
        $user->setNom($nom);
        $user->setRole($role);

        // Enregistrement de l'utilisateur dans la base de données
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        // Renvoie d'une réponse avec un message de succès
        return new Response(json_encode(['message' => 'Compte créé avec succès !']), 201);
    }

}
