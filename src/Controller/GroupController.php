<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Helpers\MenuHelper;

class GroupController extends AbstractController
{
    #[Route('/groups', name: 'groups')]
    public function index(): Response
    {   
        $menu = new MenuHelper();

        return $this->render('group/index.html.twig', [
            'controller_name' => 'GroupController',
            'menu' => $menu->getMenu('Groups')
        ]);
    }
}
