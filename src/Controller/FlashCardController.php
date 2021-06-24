<?php

namespace App\Controller;

use App\Entity\FlashCard;
use App\Form\FlashCardType;
use App\Repository\FlashCardRepository;
use App\Repository\GroupRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/group/{groupId}')]
class FlashCardController extends AbstractController
{ 
    #[Route('/flashcard', name: 'flash_card_index', methods: ['GET'])]
    public function index(FlashCardRepository $flashCardRepository, GroupRepository $GroupRepository, $groupId): Response
    {
        return $this->render('flash_card/index.html.twig', [
            'flash_cards' => $flashCardRepository->findByGroup($groupId),
            'groupId' => $groupId
        ]);
    }

    #[Route('/flashcard/new', name: 'flash_card_new', methods: ['GET', 'POST'])]
    public function new(ManagerRegistry $ManagerRegistry, Request $request, $groupId): Response
    {
        $groupRepository = new GroupRepository($ManagerRegistry);
        $flashCard = new FlashCard();
        $flashCard->setGroupId($groupRepository->find($groupId));
        $form = $this->createForm(FlashCardType::class, $flashCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($flashCard);
            $entityManager->flush();

            return $this->redirectToRoute('flash_card_index', ['groupId' => $groupId]);
        }

        return $this->render('flash_card/new.html.twig', [
            'flash_card' => $flashCard,
            'form' => $form->createView(),
            'groupId' => $groupId
        ]);
    }

    #[Route('/flashcard/{id}/edit', name: 'flash_card_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FlashCard $flashCard, $groupId): Response
    {
        $form = $this->createForm(FlashCardType::class, $flashCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('flash_card_index', ['groupId' => $groupId]);
        }

        return $this->render('flash_card/edit.html.twig', [
            'flash_card' => $flashCard,
            'form' => $form->createView(),
            'groupId' => $groupId
        ]);
    }

    #[Route('/flashcard/{id}/delete', name: 'flash_card_delete', methods: ['POST'])]
    public function delete(Request $request, FlashCard $flashCard,  $groupId): Response
    {
        if ($this->isCsrfTokenValid('delete'.$flashCard->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($flashCard);
            $entityManager->flush();
        }

        return $this->redirectToRoute('flash_card_index', ['groupId' => $groupId]);
    }
}
