<?php

namespace App\Controller;

use App\Entity\Tache;
use App\Form\TacheType;
use App\Repository\ProjectRepository;
use App\Repository\TacheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TacheController extends AbstractController
{
    #[Route('/tache/{id}', name: 'app_tache_detail', requirements: ['id' => '\d+'])]
    public function index(int $id, TacheRepository $tacheRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $tache = $tacheRepository->find($id);

        $form = $this->createForm(TacheType::class, $tache, [
            'project' => $tache->getIdProject()
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tache);
            $entityManager->flush();

            return $this->redirectToRoute('app_projet_show', ['id' => $tache->getIdProject()->getId()]);
        }

        return $this->render('tache/tache.html.twig', [
            'controller_name' => 'TacheController',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/tache/add/{id}', name: 'app_tache_add', requirements: ['id' => '\d+'])]
    public function add(int $id,Request $request, EntityManagerInterface $entityManager, ProjectRepository $projectRepository): Response
    {
        $project = $projectRepository->find($id);

        $tache = new Tache();
        $tache->setIdProject($project);

        $form = $this->createForm(TacheType::class, $tache, [
            'project' => $project
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tache);
            $entityManager->flush();

            return $this->redirectToRoute('app_projet_show', ['id' => $id]);
        }

        return $this->render('tache/tache-add.html.twig', [
            'form' => $form->createView(),
            'project' => $project
        ]);
    }
}

