<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ImportController extends AbstractController
{
    #[Route('/import', name: 'import')]
    public function importAction(HttpClientInterface $httpClient): JsonResponse
    {
        // URL de l'API pour récupérer les données d'escalade
        $apiUrl = 'https://equipements.sports.gouv.fr/api/records/1.0/search/?dataset=data-es&q=escalade&rows=1500';

        // Effectuer une requête GET à l'API pour obtenir les données
        $response = $httpClient->request('GET', $apiUrl);

        // Convertir la réponse en tableau PHP
        $data = $response->toArray();

        // Récupérer les enregistrements depuis les données
        $records = $data['records'];

        // Tableau pour stocker les points
        $points = [];

        // Parcourir les enregistrements
        foreach ($records as $record) {
            // Récupérer la valeur du champ "nominstallation"
            $nomInstallation = $record['fields']['nominstallation'];

            // Récupérer les coordonnées (latitude et longitude)
            $coordonnees = $record['fields']['coordonnees'];

            // Récupérer la latitude et la longitude
            $latitude = $coordonnees[0];
            $longitude = $coordonnees[1];

            // Récupérer le code postal
            $codePostal = $record['fields']['codepostal'];

            // Vérifier si le nom de l'installation contient le mot "escalade" et les coordonnées ne sont pas déjà enregistrées
            if (strpos(strtolower($nomInstallation), 'escalade') !== false) {
                // Créer un tableau associatif représentant un point
                $point = [
                    'name' => $nomInstallation,
                    'latlng' => [$latitude, $longitude],
                    'codepostal' => $codePostal,
                ];

                // Ajouter le point au tableau des points
                $points[] = $point;
            }
        }

        // Renvoyer les données sous forme de JSON
        return new JsonResponse($points);
    }
}