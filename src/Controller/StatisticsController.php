<?php

namespace App\Controller;

use App\DTO\AllSessionStatistics;
use App\Repository\GroupRepository;
use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Helpers\MenuHelper;

class StatisticsController extends AbstractController
{
    private $menu;

    function __construct()
    {
        $menuHelper = new MenuHelper();
        $this->menu = $menuHelper->getMenu('Statystyki');
    }

    #[Route('/statistics', name: 'statistics')]
    public function index(ManagerRegistry $ManagerRegistry): Response
    {
        $sessionRepository = new SessionRepository($ManagerRegistry);
        $allSessionStatistics = $sessionRepository->getAllStatistics();

        $allAnswers = $allSessionStatistics->getCorrectCount() + $allSessionStatistics->getIncorrectCount();
        $percentCorrectAnswers = ($allSessionStatistics->getCorrectCount() / $allAnswers) * 100;

        return $this->render('statistics/index.html.twig', [
            'controller_name' => 'StatisticsController',
            'allSessionStatistics' => $allSessionStatistics,
            'allAnswers' => $allAnswers,
            'percentCorrectAnswers' => $percentCorrectAnswers,
            'menu' => $this->menu,

        ]);
    }
}
