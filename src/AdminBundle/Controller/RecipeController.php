<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RecipeController
 *
 * @package AdminBundle\Controller
 * @Route("recettes")
 */
class RecipeController extends Controller
{
    /**
     * @Route("/", name="admin_recipe_list")
     */
    public function indexAction()
    {
        return $this->render('@admin/recipe/list.html.twig');
    }

    /**
     * Find and display a recipe entity
     *
     * @Route("/{recipeId}", name="admin_recipe_show")
     */
    public function showAction(Recipe $recipe, Request $request)
    {
        return $this->render('@admin/recipe/show.html.twig', array(
            'recipe' => $recipe,
        ));
    }
}
