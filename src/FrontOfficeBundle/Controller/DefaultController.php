<?php

namespace FrontOfficeBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $recipes = $em->getRepository('AppBundle:Recipe')->lastVerifiedRecipes();
        $favorites = $em->getRepository('AppBundle:UserFavoriteRecipe')->mostPopular(2);

        return $this->render('@frontend/home.html.twig', array(
            'recipes' => $recipes,
            'favorites' => $favorites
        ));
    }

    public function listDishCategoryAction()
    {
        $em = $this->getDoctrine()->getManager();
        $dishCategories = $em->getRepository('AppBundle:DishCategory')->findBy(
            array( 'parent' => null )
        );

        return $this->render('@frontend_layouts/dish_category.html.twig', array(
            'dishCategories' => $dishCategories
        ));
    }

    public function listDishCategoryImagesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $dishCategories = $em->getRepository('AppBundle:DishCategory')->findBy(
            array( 'parent' => null )
        );

        return $this->render('@frontend_layouts/dish_categories_list_images.html.twig', array(
            'dishCategories' => $dishCategories
        ));
    }
}
