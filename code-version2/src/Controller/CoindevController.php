<?php

// src/Controller/CoindevController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoindevController extends AbstractController
{
    /**
     * @Route("/coindev", name="coindev")
     */

    public function index(): Response
    {
        return $this->render('coindev/coindev.html.twig', [
            'css_path' => 'css/lavoie.css'
        ]);
    }
}
