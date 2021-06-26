<?php

namespace App\Controller;

use App\Repository\GroupRepository;
use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


class StatisticsController extends AbstractController
{
    #[Route('/statistics', name: 'statistics')]

    public function index(ManagerRegistry $ManagerRegistry): Response
    {
        $sessionRepository = new SessionRepository($ManagerRegistry);
        $allSessionStatistics = $sessionRepository->getAllStatistics();


        return $this->render('statistics/index.html.twig', [
            'controller_name' => 'StatisticsController',
            'allSessionStatistics' => $allSessionStatistics

        ]);
    }
}
