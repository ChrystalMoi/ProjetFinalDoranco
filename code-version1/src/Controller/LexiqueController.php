<?php

// src/Controller/LexiqueController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LexiqueController extends AbstractController
{
    /**
     * @Route("/boiteaoutils/lexique", name="lexique")
     */
    
    public function conseil(): Response
    {
        return $this->render('boiteaoutils/lexique/lexique.html.twig', [
            'css_path' => 'css/lavoie.css'
        ]);
    }
}
