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
    public function conseil(Request $request): Response
    {
        $success = false;

        if ($request->isMethod('POST')) {
            $name = $request->request->get('name');
            $lastName = $request->request->get('last_name');
            $email = $request->request->get('email');
            $message = $request->request->get('message');

            // Création de l'entité Commentaire et enregistrement en base de données
            $commentaire = new Commentaire();
            $commentaire->setNom($name);
            $commentaire->setPrenom($lastName);
            $commentaire->setEmail($email);
            $commentaire->setCommentaire($message);

            $this->entityManager->persist($commentaire);
            $this->entityManager->flush();

            // Envoi de l'e-mail à contact@lavoie-escalade.fr
           /*$this->sendEmailNotification($name, $lastName, $email, $message);*/

            // Marquer la soumission du formulaire comme réussie
            $success = true;
        }

        return $this->render('contact/contact.html.twig', [
            'css_path' => 'css/lavoie.css',
            'success' => $success,
        ]);
    }

    /*private function sendEmailNotification($name, $lastName, $email, $message){
        $content = "Un nouveau commentaire a été soumis :\n";
        $content .= "Nom: $name\n";
        $content .= "Prénom: $lastName\n";
        $content .= "Email: $email\n";
        $content .= "Message: $message";

        $email = (new Email())
            ->from($email)
            ->to('contact@lavoie-escalade.fr')
            ->subject('Nouveau commentaire')
            ->text($content);

        $this->mailer->send($email);
    }*/
}