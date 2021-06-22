<?php

namespace App\Controller;

use App\Entity\FlashCard;
use App\Form\FlashCardType;
use App\Repository\FlashCardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/flashcard')]
class FlashCardController extends AbstractController
{
    #[Route('/', name: 'flash_card_index', methods: ['GET'])]
    public function index(FlashCardRepository $flashCardRepository): Response
    {
        return $this->render('flash_card/index.html.twig', [
            'flash_cards' => $flashCardRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'flash_card_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $flashCard = new FlashCard();
        $form = $this->createForm(FlashCardType::class, $flashCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($flashCard);
            $entityManager->flush();

            return $this->redirectToRoute('flash_card_index');
        }

        return $this->render('flash_card/new.html.twig', [
            'flash_card' => $flashCard,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'flash_card_show', methods: ['GET'])]
    public function show(FlashCard $flashCard): Response
    {
        return $this->render('flash_card/show.html.twig', [
            'flash_card' => $flashCard,
        ]);
    }

    #[Route('/{id}/edit', name: 'flash_card_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FlashCard $flashCard): Response
    {
        $form = $this->createForm(FlashCardType::class, $flashCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('flash_card_index');
        }

        return $this->render('flash_card/edit.html.twig', [
            'flash_card' => $flashCard,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'flash_card_delete', methods: ['POST'])]
    public function delete(Request $request, FlashCard $flashCard): Response
    {
        if ($this->isCsrfTokenValid('delete'.$flashCard->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($flashCard);
            $entityManager->flush();
        }

        return $this->redirectToRoute('flash_card_index');
    }
}
