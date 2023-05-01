<?php

/**
 * Created by Ana
 * Programador: Ana Guixart Esparza
 *
 * Este archivo pertenece a la aplicación realizada por Ana Guixart Esparza.
 * El código fuente de la aplicación incluye un archivo llamado LICENSE
 * con toda la información sobre el copyright y la licencia.
 */

// src/DataFixtures/PizzaFixtures.php



namespace App\DataFixtures;

use App\Entity\Pizza;
use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;



class PizzaFixtures extends Fixture
{
    //Como no tengo base de datos, añados los datos aquí y luego los subo a la bbdd
    // Crear algunas pizzas
    public function load(ObjectManager $manager)
    {

        $ingredientsData = IngredientFixtures::$ingredientsData;

        $ingredients = [];
        foreach ($ingredientsData as $data) {
            $ingredient = $manager->getRepository(Ingredient::class)->findOneBy(['name_ingredient' => $data['name_ingredient']]);
            if (!$ingredient) {
                $ingredient = new Ingredient();
                $ingredient->setNameIngredient($data['name_ingredient']);
                $ingredient->setPrice($data['price']);
                $manager->persist($ingredient);
            }
            $ingredients[$data['name_ingredient']] = $ingredient;
        }

        //Añado a la base de datos
        $pizza1 = new Pizza();
        $pizza1->setNamePizza('Pizza Margherita');
        $pizza1->addPizzaIngredient($ingredients['Tomato']);
        $pizza1->addPizzaIngredient($ingredients['Bacon']);
        $pizza1->addPizzaIngredient($ingredients['Cheese']);
        $manager->persist($pizza1);

        $pizza2 = new Pizza();
        $pizza2->setNamePizza('Pizza Meat');
        $pizza2->addPizzaIngredient($ingredients['Tomato']);
        $pizza2->addPizzaIngredient($ingredients['Bacon']);
        $pizza2->addPizzaIngredient($ingredients['Sausages']);
        $pizza2->addPizzaIngredient($ingredients['Cheese']);
        $manager->persist($pizza2);


        $pizza2 = new Pizza();
        $pizza2->setNamePizza('Pizza Cheesy');
        $pizza2->addPizzaIngredient($ingredients['Tomato']);
        $pizza2->addPizzaIngredient($ingredients['Cheese']);
        $pizza2->addPizzaIngredient($ingredients['Feta Cheese']);
        $manager->persist($pizza2);

        $manager->flush();
    }
}
