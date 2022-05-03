<?php

namespace App\Controller;

use App\Entity\Person;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/personnes')]
class PersonController extends AbstractController
{
    #[Route('/persons', name: 'app_person')]
    public function index(): Response
    {
        return $this->render('person/index.html.twig', [
            'controller_name' => 'PersonController',
        ]);
    }

    #[Route('/findAll/{page?1}/{size?12}',  name:'person.all')]
    public function findAll(ManagerRegistry $doctrine, $page, $size): Response
    {
        $this->addFlash("info", "la liste des personnes");
        $repository = $doctrine->getRepository(Person::class);
        $personnesAll = $repository->findBy([],[], $size, ($page-1)*$size);
        return $this->render('person/index.html.twig', ['personnesAll'=>$personnesAll]);
    }

    #[Route('/{id<\d+>}', name: 'person.detail')]
    public function detail($id, ManagerRegistry $doctrine) : Response
    {
        $repository = $doctrine->getRepository(Person::class);
        $person = $repository->find($id);
        if (!$person){
            $this->addFlash("error", "La personne avec cet Id = $id est introuvable");
            return $this->redirectToRoute("person.all");
        }
        return $this->render('person/details.html.twig', ['person'=>$person]);
    }

    #[Route('/save', name: 'person.save')]
    public function save(ManagerRegistry $registry): Response
    {
        $repository = $registry->getManager();
        for ($i=0; $i<4; $i++){
            $newperson = new Person();
            $newperson->setFirstname('monckey');
            $newperson->setLastname('luffy');
            $newperson->setJob('manga');
            $newperson->setAge(22);
            $repository->persist($newperson);
            $repository->flush();
        }
        return $this->redirectToRoute('person.all');
    }

    #[Route('/findByAge/{page<\d+>?1}/{size<\d+>?12}', name: 'person.age')]
    public function findByAge(ManagerRegistry $registry, $page, $size): Response
    {
        $repository = $registry->getRepository(Person::class);
        $person = $repository->findBy(['firstname'=>'monckey'], ['age'=>'ASC'], $size, ($page - 1)*$size);
        return $this->render('person/index.html.twig', ['personnesAll'=>$person]);
    }

}
