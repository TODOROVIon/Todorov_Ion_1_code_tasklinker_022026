<?php

namespace App\Controller;

use App\Form\TacheType;
use App\Repository\TacheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TacheController extends AbstractController
{
    #[Route('/tache/{id}', name: 'app_tache_detail')]
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
}
