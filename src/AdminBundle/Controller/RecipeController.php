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
        $em = $this->getDoctrine()->getManager();
        $recipes = $em->getRepository('AppBundle:Recipe')->findAll();

        return $this->render('@admin/recipe/list.html.twig', array(
            'recipes' => $recipes,
        ));
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

    /**
     * Displays a form to edit an existing recipe entity.
     *
     * @Route("/{id}/editer", name="admin_recipe_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Recipe $recipe
     * @return Response
     */
    public function editAction(Request $request, Recipe $recipe)
    {
        $editForm = $this->createForm('AdminBundle\Form\RecipeAdminType', $recipe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_recipe_edit', array('id' => $recipe->getRecipeId()));
        }

        return $this->render('@admin/recipe/edit.html.twig', array(
            'user' => $recipe,
            'edit_form' => $editForm->createView()
        ));
    }
}
