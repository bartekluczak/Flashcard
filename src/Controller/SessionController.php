<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\FlashCard;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use App\Repository\FlashCardRepository;
use App\Helpers\MenuHelper;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

#[Route('/session')]
class SessionController extends AbstractController
{
    private $menu;

    function __construct()
    {
        $menuHelper = new MenuHelper();
        $this->menu = $menuHelper->getMenu('Nauka');
    }

    #[Route('/', name: 'session_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $session = new Session();
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session->setCorrectCount(0);
            $session->setIncorrectCount(0);
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

    #[Route('/{id}', name: 'session', methods: ['GET', 'POST'])]
    public function show(Request $request, FlashCardRepository $flashCardRepository, SessionRepository $sessionRepository, Session $session): Response
    {
        $flascard = $flashCardRepository->find($sessionRepository->getRandomFlashCardId($session->getGroupId()));

        $defaultData = ['flashcard' => $flascard->getContent(), 'checkId' => $flascard->getId()];
        $flashcardShow = $this->createFormBuilder($defaultData)
            ->add('flashcard', TextType::class, [
                'disabled' => true
            ])
            ->add('answer', TextType::class)
            ->add('send', SubmitType::class)
            ->add('checkId', HiddenType::class)
            ->getForm();
        $flashcardShow->handleRequest($request);

        if ($flashcardShow->isSubmitted() && $flashcardShow->isValid())
        {

            $lastFlashcardId = $flashcardShow["checkId"]->getData();
            $lastFlashcard = $flashCardRepository->find($lastFlashcardId);
            $lastFlashcardTranslation = strtolower($lastFlashcard->getTranslation());
            
            $answer = strtolower($flashcardShow["answer"]->getData());

            if($answer == $lastFlashcardTranslation)
            {
                $session->increaseCorrectCount();
            }
            else
            {
                $session->increaseIncorrectCount();
            }


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($session);
            $entityManager->flush();
            return $this->redirectToRoute('session', ['id' => $session->getId()]);
        }

        return $this->render('session/show.html.twig', [
            'session' => $session,
            'flashcard' => $flascard,
            'flashcardShow' => $flashcardShow->createView(),
            'menu' => $this->menu
        ]);
    }
}
