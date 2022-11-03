<?php

namespace App\Entity;

use App\Repository\BeerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(nullable: true)]
    private ?float $alcool = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: TypeOfBeer::class)]
    private Collection $types;

    #[ORM\ManyToOne(inversedBy: 'beers')]
    private ?Brewery $brewery = null;

    public function __construct()
    {
        $this->types = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, TypeOfBeer>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(TypeOfBeer $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
        }

        return $this;
    }

    public function removeType(TypeOfBeer $type): self
    {
        $this->types->removeElement($type);

        return $this;
    }

    public function getBrewery(): ?Brewery
    {
        return $this->brewery;
    }

    public function setBrewery(?Brewery $brewery): self
    {
        $this->brewery = $brewery;

        return $this;
    }
}
