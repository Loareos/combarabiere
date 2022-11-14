<?php

namespace App\Entity;

use App\Repository\BarRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BarRepository::class)]
class Bar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToOne(inversedBy: 'bar', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Menu $menu = null;

    #[ORM\OneToOne(mappedBy: 'bar', cascade: ['persist', 'remove'])]
    private ?BarLocation $barLocation = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }

    public function getBarLocation(): ?BarLocation
    {
        return $this->barLocation;
    }

    public function setBarLocation(BarLocation $barLocation): self
    {
        // set the owning side of the relation if necessary
        if ($barLocation->getBar() !== $this) {
            $barLocation->setBar($this);
        }

        $this->barLocation = $barLocation;

        return $this;
    }
}
