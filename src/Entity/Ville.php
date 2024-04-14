<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: VilleRepository::class)]
#[ApiResource]
#[Post(
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']],
)]
#[GetCollection()]
#[Get()]
class Ville
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['post:read','get:read', 'get:write','write','read'])]
    private ?string $name = null;
     
    #[Ignore]
    #[Groups(['get:read', 'get:write','write','read'])]
    #[ORM\OneToMany(targetEntity: Destination::class, mappedBy: 'ville')]
    private Collection $destinations;

    #[Groups(['post:read','get:read', 'get:write','write','read'])]
    #[ORM\OneToMany(mappedBy: 'ville', targetEntity: ImageVille::class, cascade: ["persist", "remove"])]
    private Collection $images;

    public function __construct()
    {
        $this->destinations = new ArrayCollection();
        $this->images = new ArrayCollection();
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

    /**
     * @return Collection<int, Destination>
     */
    public function getDestinations(): Collection
    {
        return $this->destinations;
    }

    public function addDestination(Destination $destination): static
    {
        if (!$this->destinations->contains($destination)) {
            $this->destinations->add($destination);
            $destination->setVille($this);
        }

        return $this;
    }

    public function removeDestination(Destination $destination): static
    {
        if ($this->destinations->removeElement($destination)) {
            // set the owning side to null (unless already changed)
            if ($destination->getVille() === $this) {
                $destination->setVille(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ImageVille>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(ImageVille $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] =$image;
            $image->setVille($this);
        }

        return $this;
    }
    

    
    public function removeImage(ImageVille $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getVille() === $this) {
                $image->setVille(null);
            }
        }

        return $this;
    }
}
