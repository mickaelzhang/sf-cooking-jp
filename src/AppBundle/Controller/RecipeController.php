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
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($recipe);
//            $em->flush($recipe);

//            return $this->redirectToRoute('recipe_show', array('slug' => $recipe->getSlug()));
        }

        return $this->render('@frontend/recipe/new.html.twig', array(
            'form' => $form->createView()
        ));
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
