<?php

namespace App\Service;

use App\Entity\Ingredient;
use Doctrine\Persistence\ManagerRegistry;

class IngredientService{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function findAllIngredients()
    {
        return $this->doctrine->getRepository(Ingredient::class)->findAll();
    }
}
