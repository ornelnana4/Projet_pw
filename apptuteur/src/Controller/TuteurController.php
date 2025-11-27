<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TuteurController extends AbstractController
{
    #[Route('/tuteur', name: 'tuteur_index')]
    public function index(Request $request): Response
    {
        $tuteurs = [
            [
                'id' => 1,
                'nom' => 'Johnson',
                'prenom' => 'Paul',
                'entreprise' => 'Acme',
                'email' => 'paul.johnson@acme.com',
                'telephone' => '06 00 00 00 01',
                'etudiants' => [
                    [
                        'nom' => 'Martin',
                        'prenom' => 'Léa',
                        'sujet' => 'Détection d’anomalies sur flux bancaires'
                    ],
                    [
                        'nom' => 'Durand',
                        'prenom' => 'Noah',
                        'sujet' => 'Dashboard risques crédit'
                    ]
                ]
            ],
            [
                'id' => 2,
                'nom' => 'Walberg',
                'prenom' => 'Mark',
                'entreprise' => 'Globex',
                'email' => 'mark.walberg@globex.com',
                'telephone' => '06 00 00 00 02',
                'etudiants' => []
            ]
        ];

        // Récupére les paramètres GET (ex: ?sort=nom&dir=asc)
        $sort = $request->query->get('sort', 'nom');
        $dir = $request->query->get('dir', 'asc');

        // Protéger le tri si tableau vide
        if (!is_array($tuteurs)) {
            $tuteurs = [];
        }

        // Tri du tableau
        usort($tuteurs, function ($a, $b) use ($sort, $dir) {
            if ($dir === 'asc') {
                return $a[$sort] <=> $b[$sort];
            } else {
                return $b[$sort] <=> $a[$sort];
            }
        });

        // Affichage twig + params de tri
        return $this->render('tuteur/index.html.twig', [
            'tuteurs' => $tuteurs,
            'sort' => $sort,
            'dir'  => $dir
        ]);
    }

    #[Route('/tuteur/{id}',name:'tuteur_show')]
    public function show(int $id):Response
    {
        $tuteurs = [
            [
                'id' => 1,
                'nom' => 'Johnson',
                'prenom' => 'Paul',
                'entreprise' => 'Acme',
                'email' => 'paul.johnson@acme.com',
                'telephone' => '06 00 00 00 01',
                'etudiants' => [
                    [
                        'nom' => 'Martin',
                        'prenom' => 'Léa',
                        'sujet' => 'Détection d’anomalies sur flux bancaires',
                    ],
                ],
            ],
            [
                'id' => 2,
                'nom' => 'Walberg',
                'prenom' => 'Mark',
                'entreprise' => 'Globex',
                'email' => 'mark.walberg@globex.com',
                'telephone' => '06 00 00 00 02',
                'etudiants' => [],
            ],
        ];
        $tuteur = null;
        foreach ($tuteurs as $t) {
            if ($t['id'] == $id) {
                $tuteur = $t;
                break;
            }
        }
        if(!$tuteur) {
            throw $this->createNotFoundException('Tuteur non trouve');
        }

        return $this->render('tuteur/show.html.twig' , ['tuteur' => $tuteur, ]); 
    }

    #[Route('/sujets', name: 'sujet_index')]
    public function sujets(): Response
    {
        // même tableau que dans index()/show()
        $tuteurs = [ /* ... ton tableau de tuteurs avec etudiants ... */];

        $entrepriseFiltre = $_GET['entreprise'] ?? null;

        $sujets = [];

        foreach ($tuteurs as $tuteur) {
            foreach ($tuteur['etudiants'] as $etu) {
                if ($entrepriseFiltre && $tuteur['entreprise'] !== $entrepriseFiltre) {
                    continue;
                }
                $sujets[] = [
                    'sujet'      => $etu['sujet'],
                    'etudiant'   => $etu['prenom'] . ' ' . $etu['nom'],
                    'tuteur'     => $tuteur['prenom'] . ' ' . $tuteur['nom'],
                    'entreprise' => $tuteur['entreprise'],
                ];
            }
        }

        // liste pour le menu déroulant
        $entreprises = array_values(array_unique(array_map(
            fn($t) => $t['entreprise'],
            $tuteurs
        )));

        return $this->render('sujet/index.html.twig', [
            'sujets'      => $sujets,
            'entreprises' => $entreprises,
            'filtre'      => $entrepriseFiltre,
        ]);
    }
}
