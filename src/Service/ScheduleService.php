<?php

namespace App\Service;

use App\Entity\Schedule;
use Doctrine\ORM\EntityManagerInterface;

class ScheduleService
{
    private $schedules = [];

    public function getSchedules()
    {
        return $this->schedules;
    }
    public function __Construct(EntityManagerInterface $entityManager)
    {
        $daysOfWeek = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche' ];
        $repository = $entityManager->getRepository(Schedule::class);

        $test = 'Lundi matin';

        $schedules = $repository->findAll();

        $morning = ['', '', '', '', '', '', ''];
        $afternoon = ['', '', '', '', '', '', ''];

        foreach ($schedules as $schedule) {
            if($schedule->getServiceType() == 'Midi') {
                $morning[$schedule->getDayOfWeek()] = $schedule->getServiceStart()->format('H:i'). ' - ' . $schedule->getServiceEnd()->format('H:i');
            } else {
                $afternoon[$schedule->getDayOfWeek()] =$schedule->getServiceStart()->format('H:i'). ' - ' . $schedule->getServiceEnd()->format('H:i');
            }
        }

        foreach ($daysOfWeek as $index => $day)
        {
            $this->schedules = $day.': '. $morning[$index] . ' - ' . $afternoon[$index];
        }
    }
}