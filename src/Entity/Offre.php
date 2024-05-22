<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use App\Repository\OffreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffreRepository::class)]
#[ApiResource]
#[Post(
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']],
)]
#[GetCollection(
    normalizationContext: ['groups' => ['get:read']],
    denormalizationContext: ['groups' => ['get:write']],
)]
#[Get(
    normalizationContext: ['groups' => ['get:read']],
    denormalizationContext: ['groups' => ['get:write']],
)]
#[Delete()]
class Offre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['write','read','get:read', 'get:write'])]
    private ?int $id = null;

    #[Groups(['write','read','get:read', 'get:write'])]
    #[ORM\Column(length: 255)]
    private ?string $Titre = null;

    #[Groups(['write','read','get:read', 'get:write'])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Description = null;

    #[Groups(['write','read','get:read', 'get:write'])]
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_debut = null;

    #[Groups(['write','read','get:read', 'get:write'])]
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_fin = null;

    #[Groups(['write','read','get:read', 'get:write'])]
    #[ORM\Column(nullable: true)]
    private ?int $prix = null;

    #[Groups(['write','read','get:read', 'get:write'])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $planification = null;

    #[Groups(['write','read','get:read', 'get:write'])]
    #[ORM\OneToMany(targetEntity: ImageOffre::class, mappedBy: 'offre', cascade: ["persist", "remove"])]
    private Collection $image;

    #[Groups(['write','read','get:read', 'get:write'])]
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateEperation = null;

    #[Groups(['write','read'])]
    #[ORM\ManyToOne(targetEntity: Destination::class, inversedBy: 'offres', cascade: ["persist", "remove"])]
    private ?Destination $destination = null;

    /**
     * @var Collection<int, Order>
     */
    #[ORM\OneToMany(mappedBy: 'offer', targetEntity: Order::class)]
    private Collection $orders;

    public function __construct()
    {
        $this->image = new ArrayCollection();
        $this->orders = new ArrayCollection();
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

    public function getDestination(): ?Destination
    {
        return $this->destination;
    }

    public function setDestination(?Destination $destination): static
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setOffer($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getOffer() === $this) {
                $order->setOffer(null);
            }
        }

        return $this;
    }
}