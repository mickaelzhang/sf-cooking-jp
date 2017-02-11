<?php

namespace AppBundle\Controller;

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
     * @Route("/", name="recipe_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('@frontend/recipe/index.html.twig');
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
     * @Route("/{slug}", name="recipe_show")
     * @Method("GET")
     */
    public function showAction()
    {
        return $this->render('@frontend/recipe/show.html.twig');
    }
}
