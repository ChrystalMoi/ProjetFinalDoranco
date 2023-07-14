<?php

// src/Controller/FalaiseController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FalaiseController extends AbstractController
{
    /**
     * @Route("/carte/falaise", name="falaise")
     */
    
    public function conseil(): Response
    {
        return $this->render('carte/falaise/falaise.html.twig', [
            'css_path' => 'css/lavoie.css'
        ]);
    }
}
