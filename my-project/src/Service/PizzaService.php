<?php

namespace App\Service;

use App\Entity\Pizza;
use Doctrine\Persistence\ManagerRegistry;

class PizzaService
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function findAllPizzas()
    {
        return $this->doctrine->getRepository(Pizza::class)->findAll();
    }
}
