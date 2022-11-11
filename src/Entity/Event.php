<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $companyName;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $platform;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $siteNane;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $adsSet;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $creativeName;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $time;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    public function setPlatform(string $platform): self
    {
        $this->platform = $platform;

        return $this;
    }

    public function getSiteNane(): ?string
    {
        return $this->siteNane;
    }

    public function setSiteNane(string $siteNane): self
    {
        $this->siteNane = $siteNane;

        return $this;
    }

    public function getAdsSet(): ?string
    {
        return $this->adsSet;
    }

    public function setAdsSet(string $adsSet): self
    {
        $this->adsSet = $adsSet;

        return $this;
    }

    public function getCreativeName(): ?string
    {
        return $this->creativeName;
    }

    public function setCreativeName(string $creativeName): self
    {
        $this->creativeName = $creativeName;

        return $this;
    }
}
