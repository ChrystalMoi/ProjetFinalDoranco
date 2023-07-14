<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Commentaire;

class CommentaireController extends AbstractController {
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;      
    }    

    /**
     * @Route("/commentaires/supprimer/{id}", name="supprimer-commentaire", methods={"DELETE"})
     */
    public function supprimerCommentaire(Request $request): Response{
        $id = $request->attributes->get('id');

        // Si l'utilisateur essaye d'accéder a cette route, on lui renvoie une erreur 401
        if(!$request->getSession()->get('email')){
            return new Response("", 401);
        }

        /** @var CommentaireRepository $userRepository */
        $commentaireRepository = $this->entityManager->getRepository(Commentaire::class);
        $commentaire = $commentaireRepository->findOneById($id);        

        // Vérification que le commentaire existe bien avant de le supprimer
        if(!$commentaire){
            return new Response(json_encode(['message' => 'Le commentaire que vous voulez supprimer n\'existe pas!']), 400);
        }
        
        if($request->getSession()->get('email') != $commentaire->getEmail()){
            return new Response(json_encode(['message' => 'Vous ne pouvez pas supprimer une commentaire qui n\'est pas le vôtre !']), 403);
        }
        else {
            // Suppressions des modifications
            $this->entityManager->remove($commentaire);
            $this->entityManager->flush();

            //Message flash
            $this->addFlash('success-commentaire', 'Le commentaire a bien été supprimé !');

            return new Response('', 204);
        }       
    }

    /**
     * @Route("/commentaires", name="commentaires", methods={"GET"})
     */
    // Pour recharger tous les commentaires de l'utilisateur connecté
    public function getAllCommentaires(Request $request): Response{
        //retourne l'email de l'user connecter
        $email= $request->getSession()->get('email');        

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
            return $this->render('compte/accordionCommentaires.html.twig', [
                'css_path' => 'css/lavoie.css',
                'user' => $user,
                'commentaires' => $commentaires
            ]);
        } 
        
        else {
            // Si l'utilisateur essaye d'accéder a cette route mais qu'il n'est pas authentifié, on lui renvoie une erreur 401
            return new Response("", 401);
        }
    }

    /**
     * @Route("/commentaires/maj/{id}", name="commentaires-maj", methods={"GET", "POST"})
    */
    // Mise à jour des commentaires
    public function majCommentaire(Request $request): Response{
        $id = $request->attributes->get('id');
        
        // Si l'utilisateur essaye d'accéder a cette route, on lui renvoie une erreur 401
        if(!$request->getSession()->get('email')){
            return new Response("", 401);
        }

        /** @var CommentaireRepository $commentaireRepository */
        $commentaireRepository = $this->entityManager->getRepository(Commentaire::class);
            
        // Si il est user normal, il ne voit que ses propres commentaires        
        $commentaire = $commentaireRepository->findOneById($id);

        // Si l'utilisateur connecté n'est pas le même que l'auteur du commentaire, on renvoit une 403
        if($request->getSession()->get('email') != $commentaire->getEmail()){
            return new Response("", 403);
        }

        // GET
        if($request->getMethod()=="GET"){
            return $this->render('compte/majCorpsCommentaire.html.twig',[
                'css_path' => 'css/lavoie.css',               
                'commentaire' => $commentaire
            ]);
        }

        //POST
        else {
            // Récupération du contenu JSON du corps de la requête
            $content = json_decode($request->getContent(), true);

            // Récupération du champs commentaire
            $messageCommentaire = $content['commentaire'];

            // Vérification de la longueur de commentaire
            if (strlen($messageCommentaire) > 255 ) {
                return new Response(json_encode(['message' => 'Le commentaire doit faire moins de 255 caractères.']), 400);
            }  

            // Enregistrement de $messageCommentaire dans l'obj $commentaire
            $commentaire->setCommentaire($messageCommentaire);            

            // Enregistrement des modifications du commentaire dans la base de données
            $this->entityManager->persist($commentaire);
            $this->entityManager->flush();

            //Message flash
            $this->addFlash('success-maj-commentaire', 'Le commentaire a bien été modifié !');

            // Renvoie d'une réponse avec un message de succès
            return new Response('', 204);

        }
    }

    /**
     * @Route("/commentaires/{id}", name="commentaires-id", methods={"GET"})
    */   
    public function getCommentaire(Request $request): Response{
        $id = $request->attributes->get('id');

        // Si l'utilisateur essaye d'accéder a cette route, on lui renvoie une erreur 401
        if(!$request->getSession()->get('email')){
            return new Response("", 401);
        }
        
        /** @var CommentaireRepository $commentaireRepository */
        $commentaireRepository = $this->entityManager->getRepository(Commentaire::class);

        /** @var UserRepository $userRepository */
        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->findOneByEmail($request->getSession()->get('email'));
            
        // Si il est user normal, il ne voit que ses propres commentaires        
        $commentaire = $commentaireRepository->findOneById($id);

        // Si l'utilisateur connecté n'est pas le même que l'auteur du commentaire, on renvoit une 403
        if($request->getSession()->get('email') != $commentaire->getEmail()){
            return new Response("", 403);
        }

        //Affichage de la page mon compte
        return $this->render('compte/corpsCommentaire.html.twig', [
            'css_path' => 'css/lavoie.css',
            'commentaire' => $commentaire,
            'user' => $user
        ]);
    }
}