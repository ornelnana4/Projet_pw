<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class FormController extends AbstractController
{
    #[Route('/hello/{prenom}', name: 'hello', defaults: ['prenom' => 'Bryan'])]
    public function hello($prenom = "Bryan", Environment $twig): Response
    {
        // Étape 3 (voir plus bas pour le passage de variable)
        $html = $twig->render('hello.html.twig', ['prenom' => $prenom]);
        return new Response($html);
    }
}
