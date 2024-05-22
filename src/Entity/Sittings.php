<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SittingsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: SittingsRepository::class)]
#[ApiResource]
class Sittings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[Vich\UploadableField(mapping: 'Logo', fileNameProperty:'logo')]
    private ?File $file = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $favicon = null;

    #[Vich\UploadableField(mapping: 'Logo', fileNameProperty:'favicon')]
    private ?File $file2 = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $footerCopyright = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $footerphone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $topbarEmail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $topbarPhoneNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sendForEmail = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getFavicon(): ?string
    {
        return $this->favicon;
    }

    public function setFavicon(?string $favicon): static
    {
        $this->favicon = $favicon;

        return $this;
    }

    public function getFooterCopyright(): ?string
    {
        return $this->footerCopyright;
    }

    public function setFooterCopyright(?string $footerCopyright): static
    {
        $this->footerCopyright = $footerCopyright;

        return $this;
    }

    public function getFooterphone(): ?string
    {
        return $this->footerphone;
    }

    public function setFooterphone(?string $footerphone): static
    {
        $this->footerphone = $footerphone;

        return $this;
    }

    public function getTopbarEmail(): ?string
    {
        return $this->topbarEmail;
    }

    public function setTopbarEmail(?string $topbarEmail): static
    {
        $this->topbarEmail = $topbarEmail;

        return $this;
    }

    public function getTopbarPhoneNumber(): ?string
    {
        return $this->topbarPhoneNumber;
    }

    public function setTopbarPhoneNumber(?string $topbarPhoneNumber): static
    {
        $this->topbarPhoneNumber = $topbarPhoneNumber;

        return $this;
    }

    public function getSendForEmail(): ?string
    {
        return $this->sendForEmail;
    }

    public function setSendForEmail(?string $sendForEmail): static
    {
        $this->sendForEmail = $sendForEmail;

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
     * Get the value of file2
     */ 
    public function getFile2()
    {
        return $this->file2;
    }

    /**
     * Set the value of file2
     *
     * @return  self
     */ 
    public function setFile2($file2)
    {
        $this->file2 = $file2;

        return $this;
    }
}
