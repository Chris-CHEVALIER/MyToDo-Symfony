<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $lastEmail = $utils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'error' => $error,
            'last_email' => $lastEmail,
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout()
    {
    }
}
