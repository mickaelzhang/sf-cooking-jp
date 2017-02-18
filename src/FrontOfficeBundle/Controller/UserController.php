<?php

namespace FrontOfficeBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class UserController
 *
 * @package AppBundle\Controller
 * @Route("profil")
 */
class UserController extends Controller
{
    /**
     * List users
     *
     * @Route("/populaire", name="users_list")
     * @Method("GET")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('@frontend/user/list.html.twig', array(
            'users' => $users
        ));
    }

    /**
     * Find and display a user entity
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     */
    public function showAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $recipes = $em->getRepository('AppBundle:Recipe')->findBy(
            array( 'author' => $user->getUserId() )
        );
        $followers = $em->getRepository('AppBundle:UserFollow')->findBy(
            array( 'userFollowed' => $user->getUserId())
        );
        $favorites = $em->getRepository('AppBundle:UserFavoriteRecipe')->findBy(
            array( 'user' => $user->getUserId())
        );

        $connectedUser = $this->get('security.token_storage')->getToken()->getUser();

        // Generate Token for Follow Ajax
        $tokenId = 'follow_follower'.$connectedUser->getUserId().'_followed'.$user->getUserId();
        $token = $this->get('security.csrf.token_manager')->refreshToken($tokenId);

        return $this->render('@frontend/user/show.html.twig', array(
            'user' => $user,
            'recipes' => $recipes,
            'followToken' => $token,
            'followers' => $followers,
            'favorites' => $favorites,
        ));
    }
}
