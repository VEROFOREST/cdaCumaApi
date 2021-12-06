<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ShareRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ShareRepository::class)
 * @ApiResource(collectionOperations={
 *         "post",
 *         "get"={
 *             "normalization_context"={"groups"={"share:read"}}
 *         }
 *     }
 * )
 */
class Share
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"share:read","user:read"})
     */
    private $quantity;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"share:read","user:read"})
     */
    private $isResponsibleUser;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"share:read","user:read"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="shares")
     * 
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Equipment::class, inversedBy="shares")
     * @Groups({"share:read"})
     */
    private $equipment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getIsResponsibleUser(): ?bool
    {
        return $this->isResponsibleUser;
    }

    public function setIsResponsibleUser(?bool $isResponsibleUser): self
    {
        $this->isResponsibleUser = $isResponsibleUser;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getEquipment(): ?Equipment
    {
        return $this->equipment;
    }

    public function setEquipment(?Equipment $equipment): self
    {
        $this->equipment = $equipment;

        return $this;
    }
}
