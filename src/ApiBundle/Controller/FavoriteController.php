<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\UserFavoriteRecipe;

/**
 * Class FavoriteController
 *
 * @package ApiBundle\Controller
 * @Route("favorite")
 */
class FavoriteController extends Controller
{
    /**
     * Add to favorite
     *
     * @Route("/", name="api_favorite_add")
     * @Method("POST")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addToFavoriteAction(Request $request)
    {
        // Make sure the request is from ajax
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(array(
                'status' => 'Not Acceptable',
                'status_code' => 406,
                'message' => 'You can access this only using Ajax!'
            ), 406);
        }

        // Data from request
        $userId = $request->get('u');
        $recipeId = $request->get('r');
        $submittedToken = $request->get('token');

        // Make sure the token send is valid
        // tokenId -> favorite_recipe{recipeId}_user{userId}
        $tokenId = 'favorite_recipe'.$recipeId.'_user'.$userId;

        if (!$this->isCsrfTokenValid($tokenId, $submittedToken)) {
            return new JsonResponse(array(
                'status' => 'Unauthorized',
                'status_code' => 401,
                'message' => 'Invalid Token.'
            ), 401);
        }

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

            return new JsonResponse(array(
                'status' => 'Created',
                'status_code' => 201,
                'message' => 'The user now has this recipe in his favorite.'
            ), 201);
        } else {
            $em->remove($userFavoriteRecipe);
            $em->flush();

            return new JsonResponse(array(
                'status' => 'OK',
                'status_code' => 200,
                'message' => 'The user removed this recipe from his favorite.'
            ), 200);
        }
    }
}
