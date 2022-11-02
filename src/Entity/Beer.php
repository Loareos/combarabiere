<?php

namespace App\Entity;

use App\Repository\BeerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BeerRepository::class)]
class Beer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $brewery = null;

    #[ORM\Column(nullable: true)]
    private ?float $alcool = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

/*    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeOfBeer $type = null;
*/
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $country = null;

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

    public function getBrewery(): ?string
    {
        return $this->brewery;
    }

    public function setBrewery(?string $brewery): self
    {
        $this->brewery = $brewery;

        return $this;
    }

    public function getAlcool(): ?float
    {
        return $this->alcool;
    }

    public function setAlcool(?float $alcool): self
    {
        $this->alcool = $alcool;

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
/*
    public function getType(): ?TypeOfBeer
    {
        return $this->type;
    }

    public function setType(?TypeOfBeer $type): self
    {
        $this->type = $type;

        return $this;
    }
*/
    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }
}
