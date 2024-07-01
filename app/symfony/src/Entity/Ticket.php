<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    use Traits\DateInfoTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $color = null;

    #[ORM\Column(nullable: true)]
    private ?int $complexity = null;

    #[ORM\ManyToOne(inversedBy: 'tickets')]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'tickets')]
    private ?Sprint $sprint = null;

    #[ORM\ManyToOne(inversedBy: 'devOwner')]
    private ?User $devOwner = null;

    #[ORM\ManyToOne(inversedBy: 'adminOwner')]
    private ?User $adminOwner = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getComplexity(): ?int
    {
        return $this->complexity;
    }

    public function setComplexity(?int $complexity): static
    {
        $this->complexity = $complexity;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getSprint(): ?Sprint
    {
        return $this->sprint;
    }

    public function setSprint(?Sprint $sprint): static
    {
        $this->sprint = $sprint;

        return $this;
    }

    public function getDevOwner(): ?User
    {
        return $this->devOwner;
    }

    public function setDevOwner(?User $devOwner): static
    {
        $this->devOwner = $devOwner;

        return $this;
    }

    public function getAdminOwner(): ?User
    {
        return $this->adminOwner;
    }

    public function setAdminOwner(?User $adminOwner): static
    {
        $this->adminOwner = $adminOwner;

        return $this;
    }
}
