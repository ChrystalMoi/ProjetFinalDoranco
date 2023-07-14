<?php

// src/ControllerMentionlegaleController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MentionlegaleController extends AbstractController
{
    /**
     * @Route("/mentionlegale", name="mentionlegale")
     */
    
    public function conseil(): Response
    {
        return $this->render('mentionlegale/mentionlegale.html.twig', [
            'css_path' => 'css/lavoie.css'
        ]);
    }
}
