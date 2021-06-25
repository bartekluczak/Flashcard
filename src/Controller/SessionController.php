<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\FlashCard;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use App\Repository\FlashCardRepository;
use App\Helpers\MenuHelper;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/session')]
class SessionController extends AbstractController
{
    private $menu;

    function __construct()
    {
        $menuHelper = new MenuHelper();
        $this->menu = $menuHelper->getMenu('Nauka');
    }

    #[Route('/showall', name: 'session_index', methods: ['GET'])]
    public function index(SessionRepository $sessionRepository): Response
    {
        return $this->render('session/index.html.twig', [
            'sessions' => $sessionRepository->findAll(),
            'menu' => $this->menu
        ]);
    }

    #[Route('/', name: 'session_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $session = new Session();
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($session);
            $entityManager->flush();

            return $this->redirectToRoute('session', ['id' => $session->getId()]);
        }

        return $this->render('session/new.html.twig', [
            'session' => $session,
            'form' => $form->createView(),
            'menu' => $this->menu
        ]);
    }

    #[Route('/{id}', name: 'session', methods: ['GET'])]
    public function show(FlashCardRepository $flashCardRepository, SessionRepository $sessionRepository, Session $session): Response
    {
        //$flashCardRepository = new FlashCardRepository($ManagerRegistry);

        return $this->render('session/show.html.twig', [
            'session' => $session,
            'flashcard' => $flashCardRepository->find($sessionRepository->getRandomFlashCardId($session->getGroupId())),
            'menu' => $this->menu
        ]);
    }

    #[Route('/{id}/edit', name: 'session_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Session $session): Response
    {
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('session_index');
        }

        return $this->render('session/edit.html.twig', [
            'session' => $session,
            'form' => $form->createView(),
            'menu' => $this->menu
        ]);
    }

    #[Route('/{id}', name: 'session_delete', methods: ['POST'])]
    public function delete(Request $request, Session $session): Response
    {
        if ($this->isCsrfTokenValid('delete' . $session->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($session);
            $entityManager->flush();
        }

        return $this->redirectToRoute('session_index');
    }
}
