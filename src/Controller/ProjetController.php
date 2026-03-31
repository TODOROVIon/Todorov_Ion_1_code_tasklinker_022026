<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProjetController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProjectRepository $projectRepository): Response
    {
        $project = $projectRepository->findAll();

        return $this->render('projet/index.html.twig', [
            'controller_name' => 'ProjetController',
            'projects' => $project,
        ]);
    }
}
