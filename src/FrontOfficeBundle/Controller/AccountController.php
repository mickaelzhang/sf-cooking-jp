<?php

namespace FrontOfficeBundle\Controller;

use AppBundle\Entity\UserFavoriteRecipe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class AccountController
 *
 * @package FrontOfficeBundle\Controller
 */
class AccountController extends Controller
{
    /**
     * Lists all user's favorites.
     *
     * @Route("/favoris", name="favorite_list")
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     */
    public function favoriteAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $favorites = $em->getRepository('AppBundle:UserFavoriteRecipe')->findBy(
            array('user' => $user->getUserId())
        );

        return $this->render('@frontend/account/favorite_list.html.twig', array(
            'favorites' => $favorites
        ));
    }

    /**
     * User's overview.
     *
     * @Route("/overview", name="user_overview")
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     */
    public function overviewAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userId = $user->getUserId();

        $em = $this->getDoctrine()->getManager();
        $followers = $em->getRepository('AppBundle:UserFollow')->getTotalFollowers($userId);
        $recipesCount = $em->getRepository('AppBundle:Recipe')->getRecipesCountById($userId);
        $generalInfo = $em->getRepository('AppBundle:User')->getGeneralInfo($userId);

        return $this->render('@frontend/account/overview.html.twig', array(
            'followers' => $followers,
            'recipesCount' => $recipesCount,
            'userInfo' => $generalInfo
        ));

    }
}
