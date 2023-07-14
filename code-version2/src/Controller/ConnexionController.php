<?php

// src/Controller/ConnexionController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConnexionController extends AbstractController{
    /**
     * @Route("/form-connexion", name="connexion")
    */
    
    public function index(): Response
    {
        return $this->render('compte/connexion.html.twig', [
            'css_path' => 'css/lavoie.css'
        ]);
    }
}