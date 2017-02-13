<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 *
 * @package AppBundle\Controller
 * @Route("profil")
 */
class UserController extends Controller
{
    /**
     * Find and display a user entity
     *
     * @Route("/{userId}", name="user_show")
     * @Method("GET")
     */
    public function showAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $recipes = $em->getRepository('AppBundle:Recipe')->findBy(
            array( 'author' => $user->getUserId() )
        );

        return $this->render('@frontend/user/show.html.twig', array(
            'user' => $user,
            'recipes' => $recipes
        ));
    }

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

        return $this->render('@frontend/user/list.html.twig', array(
            'users' => $users
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user)
    {
        $editForm = $this->createForm('AppBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // encode the new password
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_edit', array('id' => $user->getUserId()));
        }

        return $this->render('@frontend/user/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView()
        ));
    }
}
