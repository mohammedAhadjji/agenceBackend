<?php

namespace App\Entity;

use App\Repository\TeamMemberCantactRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: TeamMemberCantactRepository::class)]
#[ApiResource]
class TeamMemberCantact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read','write'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read','write'])]
    private ?string $cantact = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read','write'])]
    private ?string $icon = null;

    #[Vich\UploadableField(mapping: 'Service', fileNameProperty:'icon')]
    #[Groups(['read','write'])]
    private ?File $file = null;

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

    /**
     * Get the value of file
     */ 
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set the value of file
     *
     * @return  self
     */ 
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }
}
