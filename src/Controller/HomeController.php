<?php

namespace App\Controller;

use App\Entity\Schedule;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    //#[Route('/home', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $daysOfWeek = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche' ];
        $repository = $entityManager->getRepository(Schedule::class);

        $test = 'Lundi matin';

        $shedules = $repository->findAll();

        $morning = ['', '', '', '', '', '', ''];
        $afternoon = ['', '', '', '', '', '', ''];

        foreach ($shedules as $shedule) {
            if($shedule->getServiceType() == 'Midi') {
                $morning = $shedule->getServiceStart()->format('H:i'). ' - ' . $shedule->getServiceEnd()->format('H:i');
            } else {
                $afternoon =$shedule->getServiceStart()->format('H:i'). ' - ' . $shedule->getServiceEnd()->format('H:i');
            }
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
