<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use App\Repository\TacheRepository;
use App\Repository\StatusRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProjetController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProjectRepository $projectRepository): Response
    {
        $project = $projectRepository->findAll();

        return $this->render('projet/projects.html.twig', [
            'controller_name' => 'ProjetController',
            'projects' => $project,
        ]);
    }

    #[Route('/projet/{id}', name: 'app_projet')]
    public function show(ProjectRepository $projectRepository,TagRepository $tagRepository, TacheRepository $tacheRepository,StatusRepository $statusRepository, int $id): Response
    {
        $project = $projectRepository->find($id);

        $taches = $tacheRepository->findBy(['idProject' => $project]);
        $statuses = $statusRepository->findAll();
        $tag = $tagRepository->findAll();

        return $this->render('projet/project.html.twig', [
            'controller_name' => 'ProjetController',
            'project' => $project,
            'taches' => $taches,
            'statuses' => $statuses,
            'tags' => $tag,
        ]);
    }
}
