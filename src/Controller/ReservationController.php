<?php

namespace App\Controller;

use App\Entity\Allergie;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\AllergieRepository;
use App\Repository\ReservationRepository;
use App\Repository\RestaurantRepository;
use App\Security\Service\ScheduleService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(ScheduleService $scheduleService,AllergieRepository $allergieRepository ,RestaurantRepository $restaurantRepository ,ReservationRepository $reservationRepository, Request $request, EntityManagerInterface  $em): Response
    {
        $form = $this->createForm(ReservationType::class);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted()) {
                $reservation = new Reservation();
                $reservation->setRestaurant($restaurantRepository->findOneBy(['restaurant_name' => 'Le Quai Antique']));
                $reservation->setClientName($form->get('client_name')->getData());
                $reservation->setPhoneNumber($form->get('phone_number')->getData());
                $reservation->setGuestNumber($form->get('guest_number')->getData());
                $reservation->setReservationDate($form->get('reservation_date')->getData());
                $reservation->setMealTime($form->get('meal_time')->getData());
                $reservation->setAllergie($form->get('allergie')->getData());
                //dd($form->get('allergies'));
                //dd($form);
                foreach ($form->get('allergies')->getData() as $formAllergie){
                    //$allergie = new Allergie();
                    //$allergie->setTitle($formAllergie);
                    $reservation->addAllergy($formAllergie);
                }
                //$reservationRepository->add($reservation);
                $em->persist($reservation);
                $em->flush();
                //return $this->redirectToRoute(‘comment_list’);
            }
        }

        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'schedules' => $scheduleService->getSchedules(),
            'form' => $form
        ]);
    }
}
