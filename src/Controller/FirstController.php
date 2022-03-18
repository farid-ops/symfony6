<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', ['name'=>'farid', 'lastName' =>'chaibou']);
    }

    #[Route('/sayHello/{name}', name: 'say.hello')]
    public function sayHello($name) : Response
    {
        return $this->render('sayHello.html.twig', ['nom' => $name]);
    }

    #[Route(
        'multiplication/{entier1}/{entier2}',
        name: 'app.multiplication',
        requirements: ['entier1'=>'\d+', 'entier2'=>'\d+'])]
    public function multiplication($entier1, $entier2): Response{
        $resultat = $entier1 * $entier2;
        return new Response("<h1>$resultat</h1>");
    }
}
