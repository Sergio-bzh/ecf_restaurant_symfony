<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Service\ScheduleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(ScheduleService $scheduleService, UserRepository $userRepository, Request $request, EntityManagerInterface $em): Response
    {

        $form = $this->createForm(UserType::class, null);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isSubmitted()) {

                $user = new User();
                $user->setUser($form->get('email')->getData());
                $user->setUser($form->get('password')->getData());
                $user->setUser($form->get('last_name')->getData());
                $user->setUser($form->get('first_name')->getData());
                $user->setUser($form->get('phone_number')->getData());
                $user->setUser($form->get('allergies')->getData());
//                $user->setUser($form->get('guest_number')->getData());

                $user->setAllergie($form->get('allergie')->getData());

//                foreach ($form->get('allergies')->getData() as $formAllergie){
//                    $reservation->addAllergy($formAllergie);
//                }
//                $em->persist($reservation);
//                $em->flush();
                //return $this->redirectToRoute(‘comment_list’);
            }
        }


        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'schedules' => $scheduleService->getSchedules(),
            'form' => $form
        ]);
    }
}
