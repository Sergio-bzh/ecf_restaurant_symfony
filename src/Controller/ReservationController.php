<?php

namespace App\Controller;

use App\Entity\Allergie;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\AllergieRepository;
use App\Repository\ReservationRepository;
use App\Repository\RestaurantRepository;
use App\Service\ScheduleService;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(ScheduleService $scheduleService,AllergieRepository $allergieRepository,
        RestaurantRepository $restaurantRepository, ReservationRepository $reservationRepository,
        Request $request, EntityManagerInterface  $em): Response
    {
// Création d'un tableau pour contenir l'ensemble des quarts d'heures de la journée
        $allCreneaux = [];
        $allCreneaux[''] = '';
        for ($hour = 0 ; $hour <= 23; $hour++) {
            $allCreneaux[$hour.':00'] = $hour.':00';
            $allCreneaux[$hour.':15'] = $hour.':15';
            $allCreneaux[$hour.':30'] = $hour.':30';
            $allCreneaux[$hour.':45'] = $hour.':45';
        }

// L'option allCreneaux contient les options qui sont injectées dans le champs "meal_time" du ReservationType.php

        $form = $this->createForm(ReservationType::class,null, ['allCreneaux' => $allCreneaux]);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isSubmitted()) {

                $reservation = new Reservation();
                $reservation->setRestaurant($restaurantRepository->findOneBy(['restaurant_name' => 'Le Quai Antique']));
                $reservation->setClientName($form->get('client_name')->getData());
                $reservation->setPhoneNumber($form->get('phone_number')->getData());
                $reservation->setGuestNumber($form->get('guest_number')->getData());
                $reservation->setReservationDate($form->get('reservation_date')->getData());

                $date = date_create_from_format('H:i', $form->get('meal_time')->getData());
                $reservation->setMealTime($date);

                $reservation->setAllergie($form->get('allergie')->getData());

                foreach ($form->get('allergies')->getData() as $formAllergie){
                    $reservation->addAllergy($formAllergie);
                }
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
