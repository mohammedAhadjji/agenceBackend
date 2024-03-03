<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OffreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffreRepository::class)]
#[ApiResource]
class Offre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Titre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column(nullable: true)]
    private ?int $prix = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $planification = null;

    #[ORM\OneToMany(targetEntity: ImageOffre::class, mappedBy: 'offre')]
    private Collection $image;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateEperation = null;

    #[ORM\ManyToMany(targetEntity: destination::class, inversedBy: 'offres')]
    private Collection $destination;

    public function __construct()
    {
        $this->image = new ArrayCollection();
        $this->destination = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): static
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(?\DateTimeInterface $date_debut): static
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(?\DateTimeInterface $date_fin): static
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(?int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getPlanification(): ?string
    {
        return $this->planification;
    }

    public function setPlanification(?string $planification): static
    {
        $this->planification = $planification;

        return $this;
    }

    /**
     * @return Collection<int, ImageOffre>
     */
    public function getImage(): Collection
    {
        return $this->image;
    }

    public function addImage(ImageOffre $image): static
    {
        if (!$this->image->contains($image)) {
            $this->image->add($image);
            $image->setOffre($this);
        }

        return $this;
    }

    public function removeImage(ImageOffre $image): static
    {
        if ($this->image->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getOffre() === $this) {
                $image->setOffre(null);
            }
        }

        return $this;
    }

    public function getDateEperation(): ?\DateTimeInterface
    {
        return $this->dateEperation;
    }

    public function setDateEperation(?\DateTimeInterface $dateEperation): static
    {
        $this->dateEperation = $dateEperation;

        return $this;
    }

    /**
     * @return Collection<int, Destination>
     */
    public function getDestination(): Collection
    {
        return $this->destination;
    }

    public function addDestination(Destination $destination): static
    {
        if (!$this->destination->contains($destination)) {
            $this->destination->add($destination);
        }

        return $this;
    }

    public function removeDestination(Destination $destination): static
    {
        $this->destination->removeElement($destination);

        return $this;
    }
}
