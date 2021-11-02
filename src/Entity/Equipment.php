<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EquipmentRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=EquipmentRepository::class)
 * @ApiResource(attributes= {"security" : "is_granted('ROLE_USER')"},
 *              collectionOperations= {"get",    
 *                                     "post" : {"security" : "is_granted('ROLE_ADMIN')"}},
 *              itemOperations= {"get", 
 *                               "put" : {"security" : "is_granted('ROLE_ADMIN')"}}
 * )
 */
class Equipment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="integer")
     */
    private $equipmentYear;

    /**
     * @ORM\Column(type="integer")
     */
    private $purchaseYear;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="equipment")
     */
    private $reservations;

    /**
     * @ORM\OneToMany(targetEntity=Share::class, mappedBy="equipment")
     */
    private $shares;

    /**
     * @ORM\ManyToOne(targetEntity=RentalType::class, inversedBy="equipment")
     */
    private $rentalType;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->shares = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getEquipmentYear(): ?int
    {
        return $this->equipmentYear;
    }

    public function setEquipmentYear(int $equipmentYear): self
    {
        $this->equipmentYear = $equipmentYear;

        return $this;
    }

    public function getPurchaseYear(): ?int
    {
        return $this->purchaseYear;
    }

    public function setPurchaseYear(int $purchaseYear): self
    {
        $this->purchaseYear = $purchaseYear;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setEquipment($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getEquipment() === $this) {
                $reservation->setEquipment(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Share[]
     */
    public function getShares(): Collection
    {
        return $this->shares;
    }

    public function addShare(Share $share): self
    {
        if (!$this->shares->contains($share)) {
            $this->shares[] = $share;
            $share->setEquipment($this);
        }

        return $this;
    }

    public function removeShare(Share $share): self
    {
        if ($this->shares->removeElement($share)) {
            // set the owning side to null (unless already changed)
            if ($share->getEquipment() === $this) {
                $share->setEquipment(null);
            }
        }

        return $this;
    }

    public function getRentalType(): ?RentalType
    {
        return $this->rentalType;
    }

    public function setRentalType(?RentalType $rentalType): self
    {
        $this->rentalType = $rentalType;

        return $this;
    }
}
