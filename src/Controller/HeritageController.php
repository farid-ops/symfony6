<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HeritageController extends AbstractController
{
    #[Route('/template', name: 'app.template')]
    public function template(): Response
    {
        return $this->render('template.html.twig', []);
    }

    #[Route('/heritage', name: 'app_heritage')]
    public function index(): Response
    {
        return $this->render('heritage/index.html.twig', []);
    }

    #[Route('/heritagepage', name: 'heritage.page')]
    public function heritage(): Response
    {
        return $this->render('heritage.html.twig');
    }
}
