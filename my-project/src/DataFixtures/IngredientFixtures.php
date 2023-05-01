<?php

/**
 * Created by Ana
 * Programador: Ana Guixart Esparza
 *
 * Este archivo pertenece a la aplicación realizada por Ana Guixart Esparza.
 * El código fuente de la aplicación incluye un archivo llamado LICENSE
 * con toda la información sobre el copyright y la licencia.
 */



namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Ingredient;

class IngredientFixtures extends Fixture
{

    //Como no tengo base de datos, añados los datos aquí y luego los subo a la bbdd
    // Crear algunos ingredientes
    public static array $ingredientsData = [['name_ingredient' => 'Tomato', 'price' => 0.5],
        ['name_ingredient' => 'Oregano', 'price' => 0.2],
        ['name_ingredient' => 'Cheese', 'price' => 1.0],
        ['name_ingredient' => 'Mushrooms', 'price' => 0.5],
        ['name_ingredient' => 'Bacon', 'price' => 1.0],
        ['name_ingredient' => 'Sausages', 'price' => 1.5],
        ['name_ingredient' => 'Onions', 'price' => 1.0],
        ['name_ingredient' => 'Feta Cheese', 'price' => 1.25],
    ];

    public function load(ObjectManager $manager)
    {

        //Añado a la base de datos
        foreach (self::$ingredientsData as $data) {
            $ingredient = new Ingredient();
            $ingredient->setNameIngredient($data['name_ingredient']);
            $ingredient->setPrice($data['price']);
            $manager->persist($ingredient);
        }

        $manager->flush();
    }
}
