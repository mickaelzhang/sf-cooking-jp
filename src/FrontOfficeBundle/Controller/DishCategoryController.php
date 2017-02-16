<?php

namespace FrontOfficeBundle\Controller;

use AppBundle\Entity\DishCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DishCategoryController
 *
 * @package FrontOfficeBundle\Controller
 * @Route("categorie")
 */
class DishCategoryController extends Controller
{
    /**
     * List all recipes that has this dishCategory
     *
     * @Route("/{categoryId}", name="dish_category_list")
     * @Method("GET")
     * @return Response
     */
    public function listAction(DishCategory $dishCategory, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categoriesId = $em->getRepository('AppBundle:DishCategory')->getChildCategoryId($dishCategory->getCategoryId());

        return $this->render('@frontend/dish_category/list.html.twig', array(
            'recipes' => $categoriesId,
        ));
    }
}
