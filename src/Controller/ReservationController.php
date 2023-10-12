<?php

namespace App\Controller;

use App\Security\Service\ScheduleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(ScheduleService $scheduleService): Response
    {
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'schedules' => $scheduleService->getSchedules()
        ]);
    }
}
