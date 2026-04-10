<?php

namespace App\Controller;

use App\Form\UserType;
use App\Repository\StatusRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UsersController extends AbstractController
{
    #[Route('/list', name: 'app_equipe')]
    public function index(UsersRepository $usersRepository, StatusRepository $statusRepository): Response
    {
        $users = $usersRepository->findAll();
        $status = $statusRepository->findAll();

        return $this->render('users/list.html.twig', [
            'controller_name' => 'UsersController',
            'users' => $users,
            'status' => $status,
        ]);
    }

    #[Route('/show/{id}', name: 'app_users_show', requirements: ['id' => '\d+'])]
    public function show(int $id, UsersRepository $usersRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $usersRepository->find($id);

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_equipe');
        }

        return $this->render('users/user.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/users/delete/{id}', name: 'app_users_delete')]
    public function delete(UsersRepository $usersRepository, EntityManagerInterface $entityManager, int $id): Response
    {
        $user = $usersRepository->find($id);

        foreach ($user->getTaches() as $tache) {
            $tache->setIdUser(null);
        }

        foreach ($user->getProjects() as $project) {
            $user->removeProject($project);
        }

        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_equipe');
    }
}
