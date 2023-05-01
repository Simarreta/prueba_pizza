<?php

namespace App\Entity;

use App\Repository\PizzaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PizzaRepository::class)]
class Pizza
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name_pizza = null;

    #[ORM\ManyToMany(targetEntity: Ingredient::class, inversedBy: 'pizza_ingredient')]
    private Collection $pizza_ingredient;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    public function __construct()
    {
        $this->pizza_ingredient = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamePizza(): ?string
    {
        return $this->name_pizza;
    }

    public function setNamePizza(string $name_pizza): self
    {
        $this->name_pizza = $name_pizza;

        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getPizzaIngredient(): Collection
    {
        return $this->pizza_ingredient;
    }

    public function addPizzaIngredient(Ingredient $pizzaIngredient): self
    {
        if (!$this->pizza_ingredient->contains($pizzaIngredient)) {
            $this->pizza_ingredient->add($pizzaIngredient);
        }

        return $this;
    }

    public function removePizzaIngredient(Ingredient $pizzaIngredient): self
    {
        $this->pizza_ingredient->removeElement($pizzaIngredient);

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function hasIngredient(Ingredient $ingredient): bool
    {
        return $this->pizza_ingredient->contains($ingredient);
    }
}
