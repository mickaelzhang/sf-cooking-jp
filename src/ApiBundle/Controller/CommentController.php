<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\UserCommentOnRecipe;

/**
 * Class CommentController
 *
 * @package ApiBundle\Controller
 * @Route("comment")
 */
class CommentController extends Controller
{
    /**
     * New comment on recipe
     *
     * @Route("/", name="api_new_comment")
     * @Method("POST")
     */
    public function newCommentAction(Request $request) {
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
        // tokenId -> comment_user{userId}_recipe{recipeId}
        $tokenId = 'comment_user'.$userId.'_recipe'.$recipeId;

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

        $userComment = new UserCommentOnRecipe();
        $userComment->setUser($user);
        $userComment->setRecipe($recipe);

        $em->persist($userComment);
        $em->flush();

        return new JsonResponse(array(
            'status' => 'Created',
            'status_code' => 201,
            'message' => 'Comment successfully posted'
        ), 201);
    }
}
