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
        $favorites = $em->getRepository('AppBundle:UserFavoriteRecipe')->mostPopular(3);

        return $this->render('@frontend/home.html.twig', array(
            'recipes' => $recipes,
            'favorites' => $favorites
        ));
    }
}
