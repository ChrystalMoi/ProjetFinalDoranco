<?php

// src/Controller/PasseportsController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PasseportsController extends AbstractController
{
    /**
     * @Route("/boiteaoutils/passeport", name="passeport")
     */
    
    public function conseil(): Response
    {
        return $this->render('boiteaoutils/passeport/passeport.html.twig', [
            'css_path' => 'css/lavoie.css'
        ]);
    }
}
