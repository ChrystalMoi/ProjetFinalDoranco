<?php

// src/Controller/CotationController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CotationController extends AbstractController
{
    /**
     * @Route("/boiteaoutils/cotation", name="cotation")
     */
    
    public function conseil(): Response
    {
        return $this->render('boiteaoutils/cotation/cotation.html.twig', [
            'css_path' => 'css/lavoie.css'
        ]);
    }
}
