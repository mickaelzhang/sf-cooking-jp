<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class UserController
 *
 * @package AdminBundle\Controller
 * @Route("utilisateurs")
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="admin_user_list")
     */
    public function indexAction()
    {
        return $this->render('@admin/user/list.html.twig');
    }

    /**
     * Find and display a user entity
     *
     * @Route("/{id}", name="admin_user_show")
     * @Method("GET")
     */
    public function showAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $recipes = $em->getRepository('AppBundle:Recipe')->findBy(
            array( 'author' => $user->getUserId() )
        );

        return $this->render('@admin/user/show.html.twig', array(
            'user' => $user,
            'recipes' => $recipes
        ));
    }
}
