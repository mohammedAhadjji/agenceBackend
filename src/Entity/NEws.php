<?php

namespace App\Entity;

use App\Repository\NEwsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NEwsRepository::class)]
class NEws
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'nEws')]
    private ?Categories $categorie = null;

    /**
     * @var Collection<int, ImageNews>
     */
    #[ORM\OneToMany(mappedBy: 'nEws', targetEntity: ImageNews::class)]
    private Collection $images;

    /**
     * @var Collection<int, Commentaires>
     */
    #[ORM\OneToMany(mappedBy: 'nEws', targetEntity: Commentaires::class)]
    private Collection $commentairs;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->commentairs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getCategorie(): ?Categories
    {
        return $this->categorie;
    }

    public function setCategorie(?Categories $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, ImageNews>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(ImageNews $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setNEws($this);
        }

        return $this;
    }

    public function removeImage(ImageNews $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getNEws() === $this) {
                $image->setNEws(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commentaires>
     */
    public function getCommentairs(): Collection
    {
        return $this->commentairs;
    }

    public function addCommentair(Commentaires $commentair): static
    {
        if (!$this->commentairs->contains($commentair)) {
            $this->commentairs->add($commentair);
            $commentair->setNEws($this);
        }

        return $this;
    }

    public function removeCommentair(Commentaires $commentair): static
    {
        if ($this->commentairs->removeElement($commentair)) {
            // set the owning side to null (unless already changed)
            if ($commentair->getNEws() === $this) {
                $commentair->setNEws(null);
            }
        }

        return $this;
    }
}
