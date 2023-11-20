<?php

namespace App\Controller;

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
        $session->set("lists", ["Courses", "Week-end", "Films à voir", "Séries à voir"]);
        $this->addFlash("success", "La liste 'Courses' a été créée !");
        return $this->redirectToRoute("read_all");
    }

    #[Route("/delete", name: "delete")]
    public function delete(SessionInterface $session): Response
    {
        $session->set("lists", ["Week-end", "Films à voir", "Séries à voir"]);
        $this->addFlash("danger", "La liste 'Courses' a été supprimée !");
        return $this->redirectToRoute("read_all");
    }

    #[Route("/update", name: "update")]
    public function update(SessionInterface $session): Response
    {
        $updatedList = "Achats";
        if ($session->get("lists")[0] === "Courses") {
            $updatedList = "Courses";
            $session->set("lists", ["Achats", "Week-end", "Films à voir", "Séries à voir"]);
        } else {
            $session->set("lists", ["Courses", "Week-end", "Films à voir", "Séries à voir"]);
        }
        $this->addFlash("warning", "La liste '$updatedList' a été modifiée !");
        return $this->redirectToRoute("read_all");
    }
}
