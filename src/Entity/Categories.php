<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'fils')]
    private ?self $parent = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class)]
    private Collection $fils;

    /**
     * @var Collection<int, NEws>
     */
    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: NEws::class)]
    private Collection $nEws;

    public function __construct()
    {
        $this->fils = new ArrayCollection();
        $this->nEws = new ArrayCollection();
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

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getFils(): Collection
    {
        return $this->fils;
    }

    public function addFil(self $fil): static
    {
        if (!$this->fils->contains($fil)) {
            $this->fils->add($fil);
            $fil->setParent($this);
        }

        return $this;
    }

    public function removeFil(self $fil): static
    {
        if ($this->fils->removeElement($fil)) {
            // set the owning side to null (unless already changed)
            if ($fil->getParent() === $this) {
                $fil->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, NEws>
     */
    public function getNEws(): Collection
    {
        return $this->nEws;
    }

    public function addNEw(NEws $nEw): static
    {
        if (!$this->nEws->contains($nEw)) {
            $this->nEws->add($nEw);
            $nEw->setCategorie($this);
        }

        return $this;
    }

    public function removeNEw(NEws $nEw): static
    {
        if ($this->nEws->removeElement($nEw)) {
            // set the owning side to null (unless already changed)
            if ($nEw->getCategorie() === $this) {
                $nEw->setCategorie(null);
            }
        }

        return $this;
    }
}
