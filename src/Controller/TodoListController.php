<?php

namespace App\Controller;

use App\Entity\TodoList;
use App\Form\TodoListType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoListController extends AbstractController
{
    #[Route("/", name: "read_all")]
    public function readAll(ManagerRegistry $doctrine): Response
    {
        $todoListRepository = $doctrine->getRepository(TodoList::class);
        $todoLists = $todoListRepository->findAll();
        return $this->render("list/home.html.twig", ["lists" =>  $todoLists]);
    }

    #[Route("/read/{id}", name: "read")]
    public function read(TodoList $todoList): Response
    {
        if (!$todoList) {
            throw $this->createNotFoundException();
        }
        return $this->render("list/read.html.twig", ["list" => $todoList]);
    }

    #[Route("/create", name: "create")]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $todoList = new TodoList();
        $form = $this->createForm(TodoListType::class, $todoList);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //dump($todoList);
            $em = $doctrine->getManager();
            $em->persist($todoList);
            $em->flush();
            $this->addFlash("success", "La liste '{$todoList->getName()}' a été créée !");
            return $this->redirectToRoute("read_all");
        }
        return $this->render("list/form.html.twig", [
            "form" => $form->createView(),
            "type" => "create",
        ]);
    }

    #[Route("/delete/{id}", name: "delete")]
    public function delete(TodoList $todoList, ManagerRegistry $doctrine): Response
    {
        $this->addFlash("danger", "La liste '{$todoList->getName()}' a été supprimée !");
        $em = $doctrine->getManager();
        $em->remove($todoList);
        $em->flush();
        return $this->redirectToRoute("read_all");
    }

    #[Route("/update/{id}", name: "update")]
    public function update(TodoList $todoList, Request $request, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(TodoListType::class, $todoList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dump($todoList); // À mettre à jour en BDD
            $doctrine->getManager()->flush();
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
