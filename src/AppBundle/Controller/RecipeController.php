<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Recipe;
use AppBundle\Form\RecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

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
        $em = $this->getDoctrine()->getManager();
        $recipes = $em->getRepository('AppBundle:Recipe')->findAll();

        return $this->render('@frontend/recipe/list.html.twig', array(
            'recipes' => $recipes
        ));
    }
    /**
     * Create a new student entity
     *
     * @Route("/nouveau", name="recipe_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);
        $user ='';
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $recipe->setAuthor($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($recipe);
            $em->flush($recipe);

//            return $this->redirectToRoute('recipe_show', array('id' => $recipe->getRecipeId()));
        }

        return $this->render('@frontend/recipe/new.html.twig', array(
            'form' => $form->createView(),
            'recipe' => $recipe
        ));
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
