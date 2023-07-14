<?php

// src/Controller/CarteController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{
    /**
     * @Route("/carte/carte", name="carte")
     */
    
    public function conseil(): Response
    {
        return $this->render('carte/carte.html.twig', [
            'css_path' => 'css/lavoie.css'
        ]);
    }
}
