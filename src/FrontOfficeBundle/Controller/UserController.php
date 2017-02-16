<?php

namespace FrontOfficeBundle\Controller;

use AppBundle\Entity\User;
use FrontOfficeBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;

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

        $connectedUser = $this->get('security.token_storage')->getToken()->getUser();

        // Generate Token for Follow Ajax
        $tokenId = 'follow_follower'.$connectedUser->getUserId().'_followed'.$user->getUserId();
        $token = $this->get('security.csrf.token_manager')->refreshToken($tokenId);

        return $this->render('@frontend/user/show.html.twig', array(
            'user' => $user,
            'recipes' => $recipes,
            'followToken' => $token
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/editer", name="user_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function editAction(Request $request, User $user)
    {
        $loggedInUser = $this->get('security.token_storage')->getToken()->getUser();

        // If it's not the user own profile, throw error
        if ($loggedInUser != $user) {
            throw $this->createAccessDeniedException();
        }

        // image field expect a file
        $user->setImage(
            new File($this->getParameter('image_user_directory').'/'.$user->getImage())
        );

        $editForm = $this->createForm(UserType::class, $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // encode the new password
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $file = $user->getImage();

            $fileName = $this->get('app_user.image_uploader')->upload($file);

            // Update image property to store image file name instead of content
            $user->setImage($fileName);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_edit', array('id' => $user->getUserId()));
        }

        return $this->render('@frontend/user/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView()
        ));
    }
}
