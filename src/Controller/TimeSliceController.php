<?php

namespace App\Controller;

use App\Repository\ScheduleRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReservationRepository;
use phpDocumentor\Reflection\Type;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TimeSliceController extends AbstractController
{
    #[Route('/api/timeSlice', name: 'app_time_slice')]
    public function index(ReservationRepository $reservationRepository, EntityManagerInterface $entityManager, ScheduleRepository $scheduleRepository): JsonResponse
    {

        // Extraction du jour de la semaine à partir d'une date
        $parse = date_parse($_GET['date']);
        $day_of_week = jddayofweek(gregoriantojd($parse['month'],$parse['day'], $parse['year']));

        // Requête pour récupérer les heures de début et fin de service
        $schedule = $scheduleRepository->findOneBy(['day_of_week' => ($day_of_week === 0 ? 6 : $day_of_week-1), 'service_type' => $_GET['service']]);

        // Récupèration des créneaux de la table réservation
        $reservations = $reservationRepository->findCreneauFields($_GET['date'], $_GET['service'], $entityManager);

        foreach ($reservations as $reservation) {
            $key = $reservation['heure'].':'.$reservation['quart_heure'];
            $creneaux[$key] = $reservation;
        }
        $creneaux['service_start'] = $schedule->getServiceStart();
        $creneaux['service_end'] = $schedule->getServiceEnd();

        return $this->json($creneaux, JsonResponse::HTTP_OK, ['Content-Type' => 'application/json;charset=UTF-8']);
    }
}

        /* Equivalent du code éxécuté pour travailler avec un objet
        return new JsonResponse(
            $creneaux,
            Response::HTTP_OK,
            ['Content-Type' => 'application/json;charset=UTF-8'],
            true
        );*/


