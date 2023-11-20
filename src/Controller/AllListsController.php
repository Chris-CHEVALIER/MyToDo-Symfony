<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AllListsController extends AbstractController
{
    #[Route('/all/lists', name: 'app_all_lists')]
    public function index(): Response
    {
        $lists = ["Courses", "Week-end", "Films à voir", "Séries à voir"];
        return $this->render('all_lists/index.html.twig', [
            'lists' => $lists,
            "title" => "<h1>Ma liste de listes</h1>"
        ]);
    }
}
