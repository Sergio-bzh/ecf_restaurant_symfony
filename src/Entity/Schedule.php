<?php

namespace App\Entity;

use App\Repository\ScheduleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScheduleRepository::class)]
class Schedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'schedules')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Restaurant $restaurant = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $service_start = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $service_end = null;

    #[ORM\Column]
    private ?int $day_of_week = null;

    #[ORM\Column(length: 50)]
    private ?string $service_type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRestaurant(): ?Restaurant
    {
        return $this->restaurant;
    }

    public function setRestaurant(?Restaurant $restaurant): static
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    public function getServiceStart(): ?\DateTimeInterface
    {
        return $this->service_start;
    }

    public function setServiceStart(\DateTimeInterface $service_start): static
    {
        $this->service_start = $service_start;

        return $this;
    }

    public function getServiceEnd(): ?\DateTimeInterface
    {
        return $this->service_end;
    }

    public function setServiceEnd(\DateTimeInterface $service_end): static
    {
        $this->service_end = $service_end;

        return $this;
    }

    public function getDayOfWeek(): ?int
    {
        return $this->day_of_week;
    }

    public function setDayOfWeek(int $day_of_week): static
    {
        $this->day_of_week = $day_of_week;

        return $this;
    }

    public function getServiceType(): ?string
    {
        return $this->service_type;
    }

    public function setServiceType(string $service_type): static
    {
        $this->service_type = $service_type;

        return $this;
    }
}
