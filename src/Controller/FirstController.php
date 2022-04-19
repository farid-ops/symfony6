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
        return $this->render('first/index.html.twig', ['name'=>'farid', 'lastName' =>'chaibou', 'path'=>'']);
    }

//    #[Route('/sayHello/{name}', name: 'say.hello')]
    public function sayHello($firstname, $lastname) : Response
    {
        return $this->render('sayHello.html.twig', ['firstname' => $firstname, 'lastname'=>$lastname]);
    }

    #[Route(
        'multiplication/{entier1}/{entier2}',
        name: 'app.multiplication',
        requirements: ['entier1'=>'\d+', 'entier2'=>'\d+'])]
    public function multiplication($entier1, $entier2): Response
    {
        $resultat = $entier1 * $entier2;
        return new Response("<h1>$resultat</h1>");
    }

//    #[Route('/image', name: 'app.image')]
//    public function image()
//    {
//        return $this->render('first/index.html.twig', ['path'=>'    ']);
//    }
}
