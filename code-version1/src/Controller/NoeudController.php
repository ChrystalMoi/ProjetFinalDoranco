<?php

// src/Controller/NoeudController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NoeudController extends AbstractController
{
    /**
     * @Route("/boiteaoutils/noeud", name="noeud")
     */
    
    public function conseil(): Response
    {
        return $this->render('boiteaoutils/noeud/noeud.html.twig', [
            'css_path' => 'css/lavoie.css'
        ]);
    }
}
