<?php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\DestinationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DestinationRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['get:read']],
    denormalizationContext: ['groups' => ['post:write']]
)]
class Destination
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get:read', 'post:write'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['get:read', 'post:write'])]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'destinations')]
    #[Groups(['get:read', 'post:write'])]
    private ?Pays $pays = null;

    #[ORM\ManyToOne(inversedBy: 'destinations')]
    #[Groups(['get:read', 'post:write'])]
    private ?Ville $ville = null;

    #[Groups(['get:read', 'post:write'])]
    #[ORM\OneToMany(targetEntity: Offre::class, mappedBy: 'destination', cascade: ["persist", "remove"])]
    private Collection $offers;

    #[Groups(['get:read', 'post:write'])]
    #[ORM\OneToMany(targetEntity: ImageDestination::class, mappedBy: 'destination', cascade: ["persist", "remove"])]
    private Collection $images;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
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

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, Offre>
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function addOffer(Offre $offer): self
    {
        if (!$this->offers->contains($offer)) {
            $this->offers->add($offer);
            $offer->setDestination($this);
        }

        return $this;
    }

    public function removeOffer(Offre $offer): self
    {
        if ($this->offers->removeElement($offer)) {
            // set the owning side to null (unless already changed)
            if ($offer->getDestination() === $this) {
                $offer->setDestination(null);
            }
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

    public function addImage(ImageDestination $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setDestination($this);
        }

        return $this;
    }

    public function removeImage(ImageDestination $image): self
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
