<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\DestinationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DestinationRepository::class)]
#[ApiResource]
#[Post(
    normalizationContext: ['groups' => ['post:read']],
    denormalizationContext: ['groups' => ['post:write']],
)]
#[Get(
    normalizationContext: ['groups' => ['get:read']],
    denormalizationContext: ['groups' => ['get:write']],
)]
#[GetCollection( normalizationContext: ['groups' => ['get:read']],
denormalizationContext: ['groups' => ['get:write']],)]
class Destination
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['post:read', 'post:write','get:read', 'get:write','read'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['post:read', 'post:write','get:read', 'get:write','read'])]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'destinations')]
    #[Groups([ 'post:write','get:read', 'get:write'])]
    private ?Pays $pays = null;

    
    #[ORM\ManyToOne(inversedBy: 'destinations')]
    #[Groups([ 'post:write','get:read', 'get:write'])]
    private ?Ville $ville = null;

    #[Groups([ 'post:write','get:read', 'get:write'])]
    #[Ignore]
    #[ORM\ManyToMany(targetEntity: Offre::class, mappedBy: 'destination')]
    private Collection $offres;
    #[Ignore]
    #[Groups([ 'post:write','get:read', 'get:write'])]
    #[ORM\OneToMany(targetEntity: ImageDestination::class, mappedBy: 'destination')]
    private Collection $images;

    public function __construct()
    {
        $this->offres = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

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

    public function getPays(): ?pays
    {
        return $this->pays;
    }

    public function setPays(?pays $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, Offre>
     */
    public function getOffres(): Collection
    {
        return $this->offres;
    }

    public function addOffre(Offre $offre): static
    {
        if (!$this->offres->contains($offre)) {
            $this->offres->add($offre);
            $offre->addDestination($this);
        }

        return $this;
    }

    public function removeOffre(Offre $offre): static
    {
        if ($this->offres->removeElement($offre)) {
            $offre->removeDestination($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ImageDestination>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(ImageDestination $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setDestination($this);
        }

        return $this;
    }

    public function removeImage(ImageDestination $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getDestination() === $this) {
                $image->setDestination(null);
            }
        }

        return $this;
    }
}
