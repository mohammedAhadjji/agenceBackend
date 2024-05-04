<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['get:read']],
    denormalizationContext: ['groups' => ['post:write']]
)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['get:read', 'post:write'])]
    private ?string $fullName = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['get:read', 'post:write'])]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['get:read', 'post:write'])]
    private ?string $phoneNumber = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['get:read', 'post:write'])]
    private ?string $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['get:read', 'post:write'])]
    private ?string $ville = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['get:read', 'post:write'])]
    private ?string $pays = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['get:read', 'post:write'])]
    private ?string $clientId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(?string $fullName): static
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    public function setClientId(?string $clientId): static
    {
        $this->clientId = $clientId;

        return $this;
    }
}
