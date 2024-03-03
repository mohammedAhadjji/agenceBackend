<?php

namespace App\Entity;

use App\Repository\TeamMemberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamMemberRepository::class)]
#[ApiResource]
class TeamMember
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $specialite = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $details = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\OneToMany(targetEntity: TeamMemberCantact::class, mappedBy: 'teamMember')]
    private Collection $cantact;

    public function __construct()
    {
        $this->cantact = new ArrayCollection();
    }

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

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(?string $specialite): static
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): static
    {
        $this->details = $details;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, TeamMemberCantact>
     */
    public function getCantact(): Collection
    {
        return $this->cantact;
    }

    public function addCantact(TeamMemberCantact $cantact): static
    {
        if (!$this->cantact->contains($cantact)) {
            $this->cantact->add($cantact);
            $cantact->setTeamMember($this);
        }

        return $this;
    }

    public function removeCantact(TeamMemberCantact $cantact): static
    {
        if ($this->cantact->removeElement($cantact)) {
            // set the owning side to null (unless already changed)
            if ($cantact->getTeamMember() === $this) {
                $cantact->setTeamMember(null);
            }
        }

        return $this;
    }
}
