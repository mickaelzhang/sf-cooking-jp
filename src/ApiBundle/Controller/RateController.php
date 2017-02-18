<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\UserRateRecipe;

/**
 * Class RateController
 *
 * @package ApiBundle\Controller
 * @Route("rate")
 */
class RateController extends Controller
{
    /**
     * New comment on recipe
     *
     * @Route("/", name="api_rate_recipe")
     * @Method("POST")
     */
    public function newCommentAction(Request $request) {
        // Make sure the request is from ajax
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(array('message' => 'You can access this only using Ajax!'), 400);
        }

        // Data from request
        $userId = $request->get('u');
        $recipeId = $request->get('r');
        $submittedToken = $request->get('token');

        // Make sure the token send is valid
        // tokenId -> rate_user{userId}_recipe{recipeId}
        $tokenId = 'rate_user'.$userId.'_recipe'.$recipeId;

        if (!$this->isCsrfTokenValid($tokenId, $submittedToken)) {
            return new JsonResponse(array('message' => 'Invalid Token.'), 400);
        }

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:User')->find($userId);
        $recipe = $em->getRepository('AppBundle:Recipe')->find($recipeId);

        $userRating = new UserRateRecipe();
        $userRating->setUser($user);
        $userRating->setRecipe($recipe);

        $em->persist($userRating);
        $em->flush();

        return new JsonResponse(array('message' => 'The user now has this recipe in his favorite.'), 200);
    }
}
