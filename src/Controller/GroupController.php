<?php

namespace App\Controller;

use App\Entity\Group;
use App\Form\GroupType;
use App\Repository\GroupRepository;
use App\Helpers\MenuHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/group')]
class GroupController extends AbstractController
{
    private $menu;
    
    function __construct() {
        $menuHelper = new MenuHelper();
        $this->menu = $menuHelper->getMenu('Grupy');
      }

    #[Route('/', name: 'group_index', methods: ['GET'])]
    public function index(GroupRepository $groupRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        return $this->render('group/index.html.twig', [
            'groups' => $groupRepository->findAll(),
            'menu' => $this->menu
        ]);
    }

    #[Route('/new', name: 'group_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $menu = new MenuHelper(); 

        $group = new Group();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $group->setUserId($user);
        $form = $this->createForm(GroupType::class, $group);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($group);
            $entityManager->flush();

            return $this->redirectToRoute('group_index');
        }

        return $this->render('group/new.html.twig', [
            'group' => $group,
            'form' => $form->createView(),
            'menu' => $this->menu
        ]);
    }

    #[Route('/{id}', name: 'group_show', methods: ['GET'])]
    public function show(Group $group): Response
    {
        return $this->render('group/show.html.twig', [
            'group' => $group,
            'menu' => $this->menu
        ]);
    }

    #[Route('/{id}/edit', name: 'group_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Group $group): Response
    {
        $form = $this->createForm(GroupType::class, $group);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('group_index');
        }

        return $this->render('group/edit.html.twig', [
            'group' => $group,
            'form' => $form->createView(),
            'menu' => $this->menu
        ]);
    }

    #[Route('/{id}', name: 'group_delete', methods: ['POST'])]
    public function delete(Request $request, Group $group): Response
    {
        if ($this->isCsrfTokenValid('delete'.$group->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($group);
            $entityManager->flush();
        }

        return $this->redirectToRoute('group_index');
    }
}
