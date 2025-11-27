<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;





class MainController extends AbstractController
{
    #[Route('/index')]
    public function index(): Response
    {
        return new Response('<html><body>Ma premiere page</body></html>');
    }
    #[Route('/bonjour/{nom}', methods: ['GET'], defaults: ['nom' => 'inconnu'], requirements: ['nom' => '[A-Za-z]+'])]
    public function indexbis(Request $request, $nom = '[A-Za-z]+'): Response
    {
        $nom2 = $request->query->get('nom2', 'ornella');
        return new Response('<html><body>HELLO WORLD</body></html>' . htmlspecialchars($nom) . $nom2);

    }

    #[Route('/calcul/{nombre}', requirements: ['nombre' => '\d+'])]
    public function indexter($nombre)
    {
        if ($nombre > 100) {
            throw $this->createNotFoundException();
        }
        return new Response('<html><body>Nombre:' . htmlspecialchars($nombre) . '</body></html>');
    }
}

?>