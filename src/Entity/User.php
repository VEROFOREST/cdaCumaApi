<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ApiResource(collectionOperations={
 *         "post",
 *         "get"={
 *             "normalization_context"={"groups"={"user_read"}}
 *         }
 *     }
 * )
 */

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"user_read"})
     *
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({"user_read"})
     *
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read","reservation_read"})
     *
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read","reservation_read"})
     *
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read"})
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read"})
     *
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read"})
     *
     */
    private $phone;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="user")
     * @Groups({"user_read"})
     */

    private $reservations;

    /**
     * @ORM\OneToMany(targetEntity=Share::class, mappedBy="user")
     * @Groups({"user_read"})
     *
     */
    private $shares;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->shares = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        // $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }
    /**
     *@Groups({"user_read"})
     * 
     */
   
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = strtoupper($lastName);

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = strtoupper($city);

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = sprintf($phone);

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt( \DateTime $createdAt): self
    {
        $this->createdAt = $createdAt->format("d-m-Y h:i:s a");

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTime $updatedAt): self
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
            $reservation->setUser($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getUser() === $this) {
                $reservation->setUser(null);
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
            $share->setUser($this);
        }

        return $this;
    }

    public function removeShare(Share $share): self
    {
        if ($this->shares->removeElement($share)) {
            // set the owning side to null (unless already changed)
            if ($share->getUser() === $this) {
                $share->setUser(null);
            }
        }

        return $this;
    }
}
