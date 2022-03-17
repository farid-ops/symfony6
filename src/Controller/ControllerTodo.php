<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControllerTodo extends AbstractController
{
    #[Route('/todos', name: 'app_todos')]
    public function todos(Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->has('todos')){
            $todos = ['todo1'=>'value1','todo2'=>'value2','todo3'=>'value3','todo4'=>'value4'];
            $session->set('todos',$todos);
            $this->addFlash('info', "la liste de todos viens d'etre initialisé.");
        }
        return $this->render('todos/index.html.twig');
    }

    #[Route('/add/{name}/{content}', name: 'todo.add', methods: ['GET'])]
    public function addTodos(Request $request, $name, $content) : RedirectResponse
    {
        $session = $request->getSession();

        if ($session->has('todos')) {
            $todos = $session->get('todos');
            if (isset($todos[$name])) {
                $this->addFlash('info', "le todo $name existe deja");
            }else
            {
                $todos[$name] = $content;
                $this->addFlash('success', "todos ajouter avec success");
                $session->set('todos', $todos);
            }
        }else
        {
            $this->addFlash('error', "la liste des todos n'est pas encore initialise.");
        }
        return $this->redirectToRoute('app_todos');
    }

    #[Route('/update/{name}/{content}', name: 'todo.update')]
    public function todoUpdate(Request $request, $name, $content) : RedirectResponse
    {
        $session = $request->getSession();
        if ($session->has('todos'))
        {
            $todos = $session->get('todos');
            if (!isset($todos[$name]))
            {
                $this->addFlash('error', "le todo avec cet ID $name n'existe pas.");
            }else
            {
                $todos[$name] = $content;
                $session->set('todos', $todos);
                $this->addFlash('success', "le todo avec a ete mis a jour.");
            }
        }else
        {
            $this->addFlash('error', "la liste des todos n'est pas encore initialise.");
        }
        return $this->redirectToRoute('app_todos');
    }

    #[Route('/delete/{key}', name: 'todo.delete')]
    public function todoDelete(Request $request, $key) : RedirectResponse
    {
        //on recupere la session
        $session = $request->getSession();
        //on verifie si notre session existe
        if ($session->has('todos'))
        {
            //on recupere la variable de la session sous forme de tableau
            $todos = $session->get('todos');
            //on verifier si l'element existe dans le tableau
            if (!isset($todos[$key]))
            {
                $this->addFlash('error', "le todo avec cette cle $key n'existe pas.");
            }else
            {
                unset($todos[$key]);
                $session->set('todos', $todos);
                $this->addFlash('success', 'supprimer avec success.');
            }
        }else
        {
            $this->addFlash('info', "le todos n'est pas encore initialise.");
        }
        return $this->redirectToRoute('app_todos');
    }

    /***/
    #[Route('/reset', name: 'todo.reset')]
    public function resetTodo(Request $request) : RedirectResponse
    {
        $session = $request->getSession();
        $session->remove('todos');
        return $this->redirectToRoute('app_todos');
    }

}
