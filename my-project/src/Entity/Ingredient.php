<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\IngredientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name_ingredient = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\ManyToMany(targetEntity: Pizza::class, mappedBy: 'pizza_ingredient')]
    private Collection $pizza_ingredient;

    public function __construct()
    {
        $this->pizza_ingredient = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameIngredient(): ?string
    {
        return $this->name_ingredient;
    }

    public function setNameIngredient(string $name_ingredient): self
    {
        $this->name_ingredient = $name_ingredient;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, Pizza>
     */
    public function getPizzaIngredient(): Collection
    {
        return $this->pizza_ingredient;
    }

    public function addPizzaIngredient(Pizza $pizzaIngredient): self
    {
        if (!$this->pizza_ingredient->contains($pizzaIngredient)) {
            $this->pizza_ingredient->add($pizzaIngredient);
            $pizzaIngredient->addPizzaIngredient($this);
        }

        return $this;
    }

    public function removePizzaIngredient(Pizza $pizzaIngredient): self
    {
        if ($this->pizza_ingredient->removeElement($pizzaIngredient)) {
            $pizzaIngredient->removePizzaIngredient($this);
        }

        return $this;
    }
}
