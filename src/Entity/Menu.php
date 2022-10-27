<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(mappedBy: 'menu', cascade: ['persist', 'remove'])]
    private ?Bar $bar = null;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: Pricing::class, orphanRemoval: true)]
    private Collection $pricings;

    public function __construct()
    {
        $this->pricings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBar(): ?Bar
    {
        return $this->bar;
    }

    public function setBar(Bar $bar): self
    {
        // set the owning side of the relation if necessary
        if ($bar->getMenu() !== $this) {
            $bar->setMenu($this);
        }

        $this->bar = $bar;

        return $this;
    }

    /**
     * @return Collection<int, Pricing>
     */
    public function getPricings(): Collection
    {
        return $this->pricings;
    }

    public function addPricing(Pricing $pricing): self
    {
        if (!$this->pricings->contains($pricing)) {
            $this->pricings->add($pricing);
            $pricing->setMenu($this);
        }

        return $this;
    }

    public function removePricing(Pricing $pricing): self
    {
        if ($this->pricings->removeElement($pricing)) {
            // set the owning side to null (unless already changed)
            if ($pricing->getMenu() === $this) {
                $pricing->setMenu(null);
            }
        }

        return $this;
    }
}
