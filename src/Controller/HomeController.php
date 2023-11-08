<?php

namespace App\Controller;

use App\Entity\Schedule;
use App\Repository\ScheduleRepository;
use App\Service\ScheduleService;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
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
    public function index(ScheduleService $scheduleService, EntityManagerInterface $entityManager): Response
    {

//        $schedule = $scheduleRepo->find(1);
        $schedule = $entityManager->getRepository(Schedule::class)->find(1);
        echo '1 ====================>, <br>';
        $newServiceStart = $schedule->getServiceStart();
        echo '2 ====================>';
//        dd($newServiceStart);
        $transform = $newServiceStart->format('H:i');
//        var_dump(date (strtotime($transform)));
//        dd($transform);
//        $newSetServiceStart = $schedule->setServiceStart(DateTime::createFromFormat('H:i', strtotime($transform)));
        $schedule->setServiceStart($newServiceStart->modify(' + 5 hour'));
        dd($schedule);
//        var_dump('============>'. $newServiceStart->modify(' + 5 hour'));
        $entityManager->persist($schedule);
//        dd($truc);
        $entityManager->flush();

//        var_dump($newSetServiceStart);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'schedules' => $scheduleService->getSchedules()
        ]);
    }
}
