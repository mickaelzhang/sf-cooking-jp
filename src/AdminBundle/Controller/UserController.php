<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;

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
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('@admin/user/list.html.twig', array(
            'users' => $users,
        ));
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
            'recipes' => $recipes,
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/editer", name="admin_user_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function editAction(Request $request, User $user)
    {
        // image field expect a file
        $user->setImage(
            new File($this->getParameter('image_user_directory').'/'.$user->getImage())
        );

        $editForm = $this->createForm('AdminBundle\Form\UserAdminType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $file = $user->getImage();

            $fileName = $this->get('app_user.image_uploader')->upload($file);

            // Update image property to store image file name instead of content
            $user->setImage($fileName);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_user_edit', array('id' => $user->getUserId()));
        }

        return $this->render('@admin/user/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView()
        ));
    }
}
