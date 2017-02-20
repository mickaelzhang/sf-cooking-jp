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
     * @Route("/", name="users_list")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('@frontend/user/list.html.twig', array(
            'users' => $users
        ));
    }

    /**
     * Lists populars users.
     *
     * @Route("/populaires", name="populars_list")
     * @Method("GET")
     */
    public function popularListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $populars = $em->getRepository('AppBundle:UserFollow')->getPopularsProfiles(0);

        foreach($populars as $key => $popular) {
            $populars[$key]['recipes'] = $em->getRepository('AppBundle:Recipe')->findBy(
                array( 'author' => $popular['userId'])
            );
        }

        return $this->render('@frontend/user/featured_users.html.twig', array(
            'populars' => $populars
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
        $auth_checker = $this->get('security.authorization_checker')->isGranted('ROLE_USER');

        $em = $this->getDoctrine()->getManager();

        $recipes = $em->getRepository('AppBundle:Recipe')->findBy(
            array( 'author' => $user->getUserId()),
            null,
            3
        );

        $followers = $em->getRepository('AppBundle:UserFollow')->findBy(
            array( 'userFollowed' => $user->getUserId())
        );
        $favorites = $em->getRepository('AppBundle:UserFavoriteRecipe')->findBy(
            array( 'user' => $user->getUserId()),
            null,
            3
        );

        $token = null;
        if ($auth_checker) {
            $connectedUser = $this->get('security.token_storage')->getToken()->getUser();

            // Generate Token for Follow Ajax
            $tokenId = 'follow_follower'.$connectedUser->getUserId().'_followed'.$user->getUserId();
            $token = $this->get('security.csrf.token_manager')->refreshToken($tokenId);
        }

        return $this->render('@frontend/user/show.html.twig', array(
            'user' => $user,
            'recipes' => $recipes,
            'followToken' => $token,
            'followers' => $followers,
            'favorites' => $favorites,
        ));
    }
}
