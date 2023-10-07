<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Restaurant $restaurant = null;

    #[ORM\Column(length: 50)]
    private ?string $client_name = null;

    #[ORM\Column(length: 13)]
    private ?string $phone_number = null;

    #[ORM\Column]
    private ?int $guest_number = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $reservation_date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $meal_time = null;

    #[ORM\Column]
    private ?bool $allergie = null;

//    #[ORM\ManyToMany(targetEntity: Allergie::class, mappedBy: 'reservations')]
//    private Collection $allergies;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Allergie::class, inversedBy: 'reservations')]
    private Collection $allergies;

    public function __construct()
    {
        $this->allergies = new ArrayCollection();
    }

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

    public function getClientName(): ?string
    {
        return $this->client_name;
    }

    public function setClientName(string $client_name): static
    {
        $this->client_name = $client_name;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): static
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getGuestNumber(): ?int
    {
        return $this->guest_number;
    }

    public function setGuestNumber(int $guest_number): static
    {
        $this->guest_number = $guest_number;

        return $this;
    }

    public function getReservationDate(): ?\DateTimeInterface
    {
        return $this->reservation_date;
    }

    public function setReservationDate(\DateTimeInterface $reservation_date): static
    {
        $this->reservation_date = $reservation_date;

        return $this;
    }

    public function getMealTime(): ?\DateTimeInterface
    {
        return $this->meal_time;
    }

    public function setMealTime(\DateTimeInterface $meal_time): static
    {
        $this->meal_time = $meal_time;

        return $this;
    }

    public function isAllergie(): ?bool
    {
        return $this->allergie;
    }

    public function setAllergie(bool $allergie): static
    {
        $this->allergie = $allergie;

        return $this;
    }

//    /**
//     * @return Collection<int, Allergie>
//     */
/*    public function getAllergies(): Collection
    {
        return $this->allergies;
    }

    public function addAllergy(Allergie $allergy): static
    {
        if (!$this->allergies->contains($allergy)) {
            $this->allergies->add($allergy);
            $allergy->addReservation($this);
        }

        return $this;
    }

    public function removeAllergy(Allergie $allergy): static
    {
        if ($this->allergies->removeElement($allergy)) {
            $allergy->removeReservation($this);
        }

        return $this;
    }
*/
    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Allergie>
     */
    public function getAllergies(): Collection
    {
        return $this->allergies;
    }

    public function addAllergy(Allergie $allergy): static
    {
        if (!$this->allergies->contains($allergy)) {
            $this->allergies->add($allergy);
        }

        return $this;
    }

    public function removeAllergy(Allergie $allergy): static
    {
        $this->allergies->removeElement($allergy);

        return $this;
    }
}
