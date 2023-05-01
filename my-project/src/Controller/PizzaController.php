<?php

/**
 * Created by Ana
 * Programador: Ana Guixart Esparza
 *
 * Este archivo pertenece a la aplicación realizada por Ana Guixart Esparza.
 * El código fuente de la aplicación incluye un archivo llamado LICENSE
 * con toda la información sobre el copyright y la licencia.
 */

namespace App\Controller;


use App\Entity\Pizza;
use App\Entity\Ingredient;
use App\Service\IngredientService;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use App\Service\PizzaService;




class PizzaController extends AbstractController
{

    private $pizzaService;
    private $ingredientService;

    public function __construct(PizzaService $pizzaService, IngredientService $ingredientService)
    {
        $this->pizzaService = $pizzaService;
        $this->ingredientService = $ingredientService;
    }

    #[Route('/pizzas', name: 'pizzas')]
    public function index(Request $request): Response
    {

        $pizzas = $this->pizzaService->findAllPizzas();

        $pizzaIngredients = array();
        foreach ($pizzas as $pizza) {
            $ingredients = $pizza->getPizzaIngredient();
            $totalPrice = 0;
            $name = $pizza->getNamePizza();
            foreach ($ingredients as $ingredient) {
                $totalPrice += $ingredient->getPrice();
            }
            $pizzaIngredients[$pizza->getId()] = array('name'=> $name,'ingredients' => $ingredients, 'total_price' => $totalPrice);
        }


        //Añado todos los ingredientes
        $allIngredients =$this->ingredientService->findAllIngredients();


        $selectedPizza = null;
        $ingredientForm = null;

        // Crea el formulario
        $form = $this->createFormBuilder()
            ->add('pizza', EntityType::class, [
                'class' => Pizza::class,
                'choice_label' => 'name_pizza',
                'placeholder' => 'Selecciona una pizza',
            ])
            ->add('submit', SubmitType::class, ['label' => 'Seleccionar'])
            ->getForm();

        // Procesa el formulario si se envía
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $selectedPizza = $form->get('pizza')->getData();
            $ingredients = $allIngredients;
            $pizzaPrice = $selectedPizza->getPrice();
            $ingredientForm = $this->createFormBuilder()
                ->add('ingredients', EntityType::class, [
                    'class' => Ingredient::class,
                    'choices' => $ingredients,
                    'choice_label' => function(Ingredient $ingredient) {
                        return $ingredient->getNameIngredient() . ' (' . $ingredient->getPrice() . ' €)';
                    },
                    'expanded' => true,
                    'multiple' => true,
                    'by_reference' => false
                ])
                ->add('add', SubmitType::class, ['label' => 'Añadir'])
                ->add('remove', SubmitType::class, ['label' => 'Eliminar'])
                ->getForm();
        }


        return $this->render('index.html.twig', [
            'pizzas' => $pizzas,
            'selectedPizza' => $selectedPizza,
            'pizzaIngredients' => $pizzaIngredients,
            'allIngredients' => $allIngredients,
            'form' => $form->createView(),
            'ingredientForm' => $ingredientForm ? $ingredientForm->createView() : null, // Crear la vista del formulario solo si está disponible

        ]);
    }

}
