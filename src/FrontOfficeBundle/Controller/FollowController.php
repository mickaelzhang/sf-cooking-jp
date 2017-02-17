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
 * Class FollowController
 *
 * @package FrontOfficeBundle\Controller
 * @Route("follow")
 */
class FollowController extends Controller
{
    /**
     * Lists all user's favorites.
     *
     * @Route("/", name="follow_list")
     * @Method("GET")
     */
    public function indexAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $follows = $em->getRepository('AppBundle:UserFollow')->findBy(
            array('follower' => $user->getUserId())
        );

        return $this->render('@frontend/follow/list.html.twig', array(
           'follows' => $follows
        ));

    }

}
