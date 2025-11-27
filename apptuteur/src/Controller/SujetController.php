<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class SujetController extends AbstractController
{
    #[Route('/sujets', name: 'sujet_index')]
    public function sujets(Request $request): Response
    {
        // Même tableau que dans index()
        $tuteurs = [
            // ... ton tableau de tuteurs avec 'etudiants'
        ];

        $entrepriseFiltre = $request->query->get('entreprise');

        $sujets = [];
        foreach ($tuteurs as $tuteur) {
            foreach ($tuteur['etudiants'] as $etu) {
                if ($entrepriseFiltre && $tuteur['entreprise'] !== $entrepriseFiltre) {
                    continue;
                }
                $sujets[] = [
                    'sujet' => $etu['sujet'],
                    'etudiant' => $etu['prenom'] . ' ' . $etu['nom'],
                    'tuteur' => $tuteur['prenom'] . ' ' . $tuteur['nom'],
                    'entreprise' => $tuteur['entreprise'],
                ];
            }
        }

        $entreprises = array_values(array_unique(array_map(
            fn($t) => $t['entreprise'],
            $tuteurs
        )));

        return $this->render('sujet/index.html.twig', [
            'sujets' => $sujets,
            'entreprises' => $entreprises,
            'filtre' => $entrepriseFiltre,
        ]);
    }
}
