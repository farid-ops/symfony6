<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TabController extends AbstractController
{
    #[Route('/tab/{nombre?5<\d+>}', name: 'app_tab')]
    public function index($nombre): Response
    {
        $notes = [];

        for ($i = 0; $i < $nombre; $i++){
            $notes[] = rand(0, 20);
        }

        return $this->render('tab/index.html.twig', ['notes' => $notes]);
    }

    #[Route('/users', name: 'tab.users')]
    public function users()
    {
        $users = [
            ['firstname'=>'aokiji', 'lastname'=>'amiral', 'age'=>29],
            ['firstname'=>'kizaru', 'lastname'=>'amiral', 'age'=>29],
            ['firstname'=>'shanks', 'lastname'=>'captain', 'age'=>29],
            ['firstname'=>'luffy', 'lastname'=>'captain', 'age'=>29],
            ['firstname'=>'Asce', 'lastname'=>'captain barbe blanche', 'age'=>29]
        ];

        return $this->render('user/index.html.twig', ['users'=>$users]);
    }
}
