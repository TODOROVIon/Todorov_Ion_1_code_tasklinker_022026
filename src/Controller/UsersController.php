<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UsersController extends AbstractController
{
    #[Route('/list', name: 'app_equipe')]
    public function index(UsersRepository $usersRepository): Response
    {
        $users = $usersRepository->findAll();

        return $this->render('users/users.html.twig', [
            'controller_name' => 'UsersController',
            'users' => $users,
        ]);
    }
}
