<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TimeSliceController extends AbstractController
{
    #[Route('/api/timeSlice', name: 'app_time_slice')]
    public function index(): JsonResponse
    {
        $creneaux = [
            "var" => "Truc",
        ];
        /* return new JsonResponse(
            $creneaux,
            Response::HTTP_OK,
            ['Content-Type' => 'application/json;charset=UTF-8'],
            true
        );*/

        return $this->json($creneaux, JsonResponse::HTTP_OK, ['Content-Type' => 'application/json;charset=UTF-8']);
/*
SELECT hour(meal_time) AS heure_repas,  (minute(meal_time) DIV 15) AS quart_heure, reservation_date AS date, SUM(guest_number) AS convives
FROM reservation
JOIN schedule ON day_of_week = WEEKDAY(reservation_date) AND meal_time BETWEEN service_start AND service_end
WHERE day_of_week = WEEKDAY('2023-10-07') AND service_type = 'Midi'
GROUP BY reservation_date, heure_repas, quart_heure
*/

    }
}
