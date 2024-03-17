<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Controller\ImageUploaderController;
use App\Repository\TeamMemberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: TeamMemberRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['read']], 
    denormalizationContext: ['groups' => ['write']], 
    types: ['https://schema.org/TeamMember'],
    operations: [
        new GetCollection(),
        new Post(inputFormats: ['multipart' => ['multipart/form-data']])
    ]
)]
class TeamMember
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read','write'])]
    private ?string $name = null;

    #[ApiProperty(types: ['https://schema.org/contentUrl'])]
    #[Groups(['read'])]
    public ?string $contentUrl = null;
    
    #[ORM\Column(length: 255)]
    #[Groups(['read','write'])]
    private ?string $lastName = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read','write'])]
    private ?string $specialite = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['read','write'])]
    private ?string $details = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read','write'])]
    private ?string $image = null;

    #[Vich\UploadableField(mapping: 'TeamMember', fileNameProperty:'image')]
    #[Groups(['read','write'])]
    private ?File $file = null;

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

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}
