<?php

namespace App\Controller;

use App\Entity\Personnes;
use App\Form\PersonnesType;
use App\Repository\PersonnesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/personnes')]
class PersonnesController extends AbstractController
{
    #[Route('/', name: 'app_personnes_index', methods: ['GET'])]
    public function index(PersonnesRepository $personnesRepository): Response
    {
        return $this->render('personnes/index.html.twig', [
            'personnes' => $personnesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_personnes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PersonnesRepository $personnesRepository): Response
    {
        $personne = new Personnes();
        $form = $this->createForm(PersonnesType::class, $personne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personnesRepository->save($personne, true);

            return $this->redirectToRoute('app_personnes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('personnes/new.html.twig', [
            'personne' => $personne,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_personnes_show', methods: ['GET'])]
    public function show(Personnes $personne): Response
    {
        return $this->render('personnes/show.html.twig', [
            'personne' => $personne,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_personnes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Personnes $personne, PersonnesRepository $personnesRepository): Response
    {
        $form = $this->createForm(PersonnesType::class, $personne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personnesRepository->save($personne, true);

            return $this->redirectToRoute('app_personnes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('personnes/edit.html.twig', [
            'personne' => $personne,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_personnes_delete', methods: ['POST'])]
    public function delete(Request $request, Personnes $personne, PersonnesRepository $personnesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personne->getId(), $request->request->get('_token'))) {
            $personnesRepository->remove($personne, true);
        }

        return $this->redirectToRoute('app_personnes_index', [], Response::HTTP_SEE_OTHER);
    }
}
