<?php

namespace App\Entity;

use App\Repository\TypeOfBeerRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeOfBeerRepository::class)]
class TypeOfBeer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $wording = null;

    #[ORM\ManyToMany(targetEntity: Beer::class)]
    private Collection $beers;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWording(): ?string
    {
        return $this->wording;
    }

    public function setWording(string $wording): self
    {
        $this->wording = $wording;

        return $this;
    }

    /**
     * @return Collection<int, Beer>
     */
    public function getBeers(): Collection
    {
        return $this->beers;
    }


}
