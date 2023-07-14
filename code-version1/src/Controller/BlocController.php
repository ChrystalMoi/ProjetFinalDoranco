<?php

// src/Controller/BlocController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlocController extends AbstractController
{
    /**
     * @Route("/carte/bloc", name="bloc")
     */
    
    public function conseil(): Response
    {
        return $this->render('carte/bloc/bloc.html.twig', [
            'css_path' => 'css/lavoie.css'
        ]);
    }
}
