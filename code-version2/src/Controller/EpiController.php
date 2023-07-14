<?php

// src/Controller/EpiController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EpiController extends AbstractController
{
    /**
     * @Route("/boiteaoutils/epi", name="epi")
     */
    
    public function conseil(): Response
    {
        return $this->render('boiteaoutils/epi/epi.html.twig', [
            'css_path' => 'css/lavoie.css'
        ]);
    }
}
