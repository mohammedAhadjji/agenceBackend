<?php

namespace App\Entity;

use App\Repository\ImageNewsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageNewsRepository::class)]
class ImageNews
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?NEws $nEws = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getNEws(): ?NEws
    {
        return $this->nEws;
    }

    public function setNEws(?NEws $nEws): static
    {
        $this->nEws = $nEws;

        return $this;
    }
}
