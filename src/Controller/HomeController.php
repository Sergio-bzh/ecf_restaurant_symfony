<?php

namespace App\Controller;

use App\Service\ScheduleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[
        Route('/', 'app_home'),
        Route('/accueil', 'app_home_alt')
    ]
    //#[Route('/home', name: 'app_home')]
    public function index(ScheduleService $scheduleService): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'schedules' => $scheduleService->getSchedules()
        ]);
    }
}
