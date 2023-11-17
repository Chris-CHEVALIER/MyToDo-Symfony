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
        return $this->render("list/home.html.twig", ["listName" =>  $session->get("list")]);
    }

    #[Route("/read", name: "read")]
    public function read(SessionInterface $session): Response
    {
        $listName = $session->get("list");
        if (!$listName) {
            throw $this->createNotFoundException();
        }
        return $this->render("list/read.html.twig", ["name" => $listName]);
    }

    #[Route("/create", name: "create")]
    public function create(SessionInterface $session): Response
    {
        $session->set("list", "Courses");
        $this->addFlash("success", "La liste a été créée !");
        return $this->redirectToRoute("read_all");
    }

    #[Route("/delete", name: "delete")]
    public function delete(SessionInterface $session): Response
    {
        $session->remove("list");
        $this->addFlash("danger", "La liste a été supprimée !");
        return $this->redirectToRoute("read_all");
    }
}
