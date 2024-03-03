<?php

namespace App\Entity;

use App\Repository\TeamMemberCantactRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamMemberCantactRepository::class)]
#[ApiResource]
class TeamMemberCantact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $cantact = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $icon = null;

    #[ORM\ManyToOne(inversedBy: 'cantact')]
    private ?TeamMember $teamMember = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCantact(): ?string
    {
        return $this->cantact;
    }

    public function setCantact(string $cantact): static
    {
        $this->cantact = $cantact;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function getTeamMember(): ?TeamMember
    {
        return $this->teamMember;
    }

    public function setTeamMember(?TeamMember $teamMember): static
    {
        $this->teamMember = $teamMember;

        return $this;
    }
}
