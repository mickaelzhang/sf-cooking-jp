<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class RecipeController
 *
 * @package AppBundle\Controller
 * @Route("recette")
 */
class RecipeController extends Controller
{
    /**
     * Lists all recipe entities.
     *
     * @Route("/", name="recipe_list")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('@frontend/recipe/list.html.twig');
    }

    /**
     * Create a new student entity
     *
     * @Route("/nouveau", name="recipe_new")
     * @Method({"GET", "POST"})
     */
    public function newAction()
    {
        return $this->render('@frontend/recipe/new.html.twig');
    }

    /**
     * Find and display a recipe entity
     *
     * @Route("/{recipeId}", name="recipe_show")
     * @Method("GET")
     */
    public function showAction(Recipe $recipe)
    {
        return $this->render('@frontend/recipe/show.html.twig', array(
            'recipe' => $recipe,
        ));
    }
}
