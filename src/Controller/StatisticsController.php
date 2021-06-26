<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatisticsController extends AbstractController
{
    #[Route('/statistics', name: 'statistics')]
    public function index(StatisticsRepository $statsRepo): Response
    {
        $statistics-> $statsRepo(findAll);

        $catCorr = [];
        $catIncorr = [];
        return $this->render('statistics/index.html.twig', [
            'controller_name' => 'StatisticsController',
        ]);
    }
}
