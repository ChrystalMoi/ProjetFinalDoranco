<?php

// src/Controller/ConseilController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConseilController extends AbstractController
{
    /**
     * @Route("/boiteaoutils/conseil", name="conseil")
     */
    
    public function conseil(): Response
    {
        return $this->render('boiteaoutils/conseil/conseil.html.twig', [
            'css_path' => 'css/lavoie.css'
        ]);
    }
}
