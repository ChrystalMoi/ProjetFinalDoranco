<?php

// src/Controller/ContactController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mime\Email;
use App\Entity\Commentaire;

class ContactController extends AbstractController {
    private $entityManager;
    private $mailer;

    public function __construct(EntityManagerInterface $entityManager, MailerInterface $mailer)
    {
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request): Response {

        if ($request->isMethod('POST')) {           
            $objet = $request->request->get('objet');
            $message = $request->request->get('message');

            //Vérification de la taille des champs (pas plus de 255 caractères par champs)
            if (strlen($objet) > 255 ) {
                //Message flash
                $this->addFlash('error-contact', 'Erreur : le champ objet ne doit pas dépasser 255 caractères.');

                // Afficher une erreur ou prendre une action appropriée
                return $this->render('contact/contact.html.twig', [
                    'css_path' => 'css/lavoie.css'
                ]);
            }

            if (strlen($message) > 255) {
                //Message flash
                $this->addFlash('error-contact', 'Erreur : le champ message ne doit pas dépasser 255 caractères.');

                // Afficher une erreur ou prendre une action appropriée
                return $this->render('contact/contact.html.twig', [
                    'css_path' => 'css/lavoie.css'
                ]);
            }
            
            $email=$request->getSession()->get('email');

            // Création de l'entité Commentaire et enregistrement en base de données
            $commentaire = new Commentaire();
            $commentaire->setEmail($email); 
            $commentaire->setObjet($objet);                       
            $commentaire->setCommentaire($message);
            
            $this->entityManager->persist($commentaire);
            $this->entityManager->flush();

            // Envoi de l'e-mail à contact@lavoie-escalade.fr
           /*$this->sendEmailNotification($email, $message);*/

            //Message flash
            $this->addFlash('success-contact', 'Le commentaire a bien été ajouté !');
        }

        return $this->render('contact/contact.html.twig', [
            'css_path' => 'css/lavoie.css'
        ]);
    }

    /*private function sendEmailNotification($email, $message){
        $content = "Un nouveau commentaire a été soumis :\n";
        $content .= "Email: $email\n";
        $content .= "Objet: $objet\n";
        $content .= "Message: $message";

        $email = (new Email())
            ->from($email)
            ->to('contact@lavoie-escalade.fr')
            ->subject('Nouveau commentaire')
            ->text($content);

        $this->mailer->send($email);
    }*/
}