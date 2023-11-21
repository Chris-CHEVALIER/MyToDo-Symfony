<?php

namespace App\Controller;

use App\Entity\TodoList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
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
    public function create(SessionInterface $session): Response
    {
        $list1 = new TodoList(1, "Courses", "Liste de courses", ["Beurre", "Jus d'orange", "Riz", "Sucre"]);
        $list2 = new TodoList(2, "Séries", "Les séries à voir", ["Breaking Bad", "Friends"]);
        $list3 = new TodoList(3, "Films", "Les films à voir", ["Django", "Avatar", "Interstellar"]);
        $session->set("lists", [$list1, $list2, $list3]);
        $this->addFlash("success", "La liste '{$list1->getName()}' a été créée !");
        return $this->redirectToRoute("read_all");
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

    #[Route("/update", name: "update")]
    public function update(SessionInterface $session): Response
    {
        $lists = $session->get("lists");
        $lists[0]->setName($lists[0]->getName() === "Courses" ? "Achats" : "Courses");
        $session->set("lists", $lists);
        $this->addFlash("warning", "La liste '{$lists[0]->getName()}' a été a été modifiée !");
        return $this->redirectToRoute("read_all");
    }
}
