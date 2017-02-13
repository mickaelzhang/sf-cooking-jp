<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class UserController
 *
 * @package AppBundle\Controller
 * @Route("utilisateurs")
 */
class UserController extends Controller
{
    /**
     * List all users
     *
     * @Route("/", name="users_list")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('@frontend/users/list.html.twig', array(
            'users' => $users
        ));
    }
}
