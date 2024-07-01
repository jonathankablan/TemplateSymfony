<?php

namespace App\Entity;

use App\Enum\RoleEnum;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use Traits\DateInfoTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    #[ORM\Column]
    private ?bool $enable = null;

    #[ORM\Column]
    protected string $role = RoleEnum::ROLE_USER;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstName = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $number = null;

    /**
     * @var Collection<int, Sprint>
     */
    #[ORM\OneToMany(targetEntity: Sprint::class, mappedBy: 'user')]
    private Collection $sprints;

    /**
     * @var Collection<int, Ticket>
     */
    #[ORM\OneToMany(targetEntity: Ticket::class, mappedBy: 'devOwner')]
    private Collection $devOwner;

    /**
     * @var Collection<int, Ticket>
     */
    #[ORM\OneToMany(targetEntity: Ticket::class, mappedBy: 'adminOwner')]
    private Collection $adminOwner;

    public function __construct()
    {
        $this->sprints = new ArrayCollection();
        $this->devOwner = new ArrayCollection();
        $this->adminOwner = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
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

    public function isEnable(): ?bool
    {
        return $this->enable;
    }

    public function setEnable(bool $enable): static
    {
        $this->enable = $enable;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles[] = $this->role;

        return array_unique($roles);
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): static
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return Collection<int, Sprint>
     */
    public function getSprints(): Collection
    {
        return $this->sprints;
    }

    public function addSprint(Sprint $sprint): static
    {
        if (!$this->sprints->contains($sprint)) {
            $this->sprints->add($sprint);
            $sprint->setUser($this);
        }

        return $this;
    }

    public function removeSprint(Sprint $sprint): static
    {
        if ($this->sprints->removeElement($sprint)) {
            // set the owning side to null (unless already changed)
            if ($sprint->getUser() === $this) {
                $sprint->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ticket>
     */
    public function getDevOwner(): Collection
    {
        return $this->devOwner;
    }

    public function addDevOwner(Ticket $devOwner): static
    {
        if (!$this->devOwner->contains($devOwner)) {
            $this->devOwner->add($devOwner);
            $devOwner->setDevOwner($this);
        }

        return $this;
    }

    public function removeDevOwner(Ticket $devOwner): static
    {
        if ($this->devOwner->removeElement($devOwner)) {
            // set the owning side to null (unless already changed)
            if ($devOwner->getDevOwner() === $this) {
                $devOwner->setDevOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ticket>
     */
    public function getAdminOwner(): Collection
    {
        return $this->adminOwner;
    }

    public function addAdminOwner(Ticket $adminOwner): static
    {
        if (!$this->adminOwner->contains($adminOwner)) {
            $this->adminOwner->add($adminOwner);
            $adminOwner->setAdminOwner($this);
        }

        return $this;
    }

    public function removeAdminOwner(Ticket $adminOwner): static
    {
        if ($this->adminOwner->removeElement($adminOwner)) {
            // set the owning side to null (unless already changed)
            if ($adminOwner->getAdminOwner() === $this) {
                $adminOwner->setAdminOwner(null);
            }
        }

        return $this;
    }
}
