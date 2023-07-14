<?php

// src/Controller/LuckyController.php

namespace App\Controller;

use App\Entity\Point;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 
class LuckyController extends AbstractController
{
    #[Route('/testpoint', name: 'test')]
    public function testPoint(EntityManagerInterface $em): Response
    {
        /*créer une variable*/
        $point = new Point();

        /**/
        $point->setName("PointTest");
        $point->setLatitude("48.09873");
        $point->setLongitude(("2.87665"));
        $em->persist($point);

        $em->flush();

        return $this->render('notifications.html.twig', [
            "nombre" => $point->getId()
        ]);
    }
}
