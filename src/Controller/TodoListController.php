<?php

namespace App\Controller;

use App\Entity\TodoList;
use App\Form\TodoListType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class TodoListController extends AbstractController
{
    #[Route("/", name: "read_all")]
    public function readAll(SessionInterface $session): Response
    {
        return $this->render("list/home.html.twig", ["lists" =>  $session->get("lists")]);
    }

    #[Route("/read", name: "read")]
    public function read(SessionInterface $session): Response
    {
        $list = $session->get("lists")[0];
        if (!$list) {
            throw $this->createNotFoundException();
        }
        return $this->render("list/read.html.twig", ["list" => $list]);
    }

    #[Route("/create", name: "create")]
    public function create(Request $request): Response
    {
        $todoList = new TodoList();
        $form = $this->createForm(TodoListType::class, $todoList);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dump($todoList); // À enregistrer en BDD
            $this->addFlash("success", "La liste '{$todoList->getName()}' a été créée !");
            return $this->redirectToRoute("read_all");
        }
        return $this->render("list/form.html.twig", [
            "form" => $form->createView(),
            "type" => "create",
        ]);
    }

    #[Route("/delete", name: "delete")]
    public function delete(SessionInterface $session): Response
    {
        $lists = $session->get("lists");
        $removedList = array_shift($lists);
        $session->set("lists", $lists);
        $this->addFlash("danger", "La liste '{$removedList->getName()}' a été supprimée !");
        return $this->redirectToRoute("read_all");
    }

    #[Route("/update/{id}", name: "update")]
    public function update(TodoList $todoList, Request $request): Response
    {
        $form = $this->createForm(TodoListType::class, $todoList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($todoList); // À mettre à jour en BDD
            $this->addFlash("warning", "La liste '{$todoList->getName()}' a été modifiée !");
            return $this->redirectToRoute("read_all");
        }

        return $this->render("list/form.html.twig", [
            "form" => $form->createView(),
            "todo_list" => $todoList,
            "type" => "update",
        ]);
    }
}
