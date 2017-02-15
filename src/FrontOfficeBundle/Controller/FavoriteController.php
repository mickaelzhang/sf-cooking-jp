<?php

namespace FrontOfficeBundle\Controller;

use AppBundle\Entity\UserFavoriteRecipe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class FavoriteController
 *
 * @package FrontOfficeBundle\Controller
 * @Route("favoris")
 */
class FavoriteController extends Controller
{
    /**
     * Lists all user's favorites.
     *
     * @Route("/", name="favorite_list")
     * @Method("GET")
     */
    public function indexAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $favorites = $em->getRepository('AppBundle:UserFavoriteRecipe')->findBy(
            array('user' => $user->getUserId())
        );

        return $this->render('@frontend/favorites/list.html.twig', array(
           'favorites' => $favorites
        ));

    }

    /**
     * Add to favorite
     *
     * @Route("/", name="favorite_add")
     * @Method("POST")
     */
    public function ajaxAddToFavoriteAction(Request $request) {
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(array('message' => 'You can access this only using Ajax!'), 400);
        }

        $userId = $request->get('u');
        $recipeId = $request->get('r');

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:User')->find($userId);
        $recipe = $em->getRepository('AppBundle:Recipe')->find($recipeId);

        $userFavoriteRecipe = $em->getRepository('AppBundle:UserFavoriteRecipe')->findOneBy(
            array(
                'user' => $userId,
                'recipe' => $recipeId
            )
        );

        if ($userFavoriteRecipe == null) {
            $userFavoriteRecipe = new UserFavoriteRecipe();
            $userFavoriteRecipe->setUser($user);
            $userFavoriteRecipe->setRecipe($recipe);

            $em->persist($userFavoriteRecipe);
            $em->flush();
        } else {
            $em->remove($userFavoriteRecipe);
            $em->flush();
        }

        return new Response('Ok');
    }
}
