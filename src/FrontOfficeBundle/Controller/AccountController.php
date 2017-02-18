<?php

namespace FrontOfficeBundle\Controller;

use AppBundle\Entity\UserFavoriteRecipe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use FrontOfficeBundle\Form\UserType;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class AccountController
 * Action specific and private to a user are here
 *
 * @package FrontOfficeBundle\Controller
 */
class AccountController extends Controller
{
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
     * Displays a form to edit an existing user entity.
     *
     * @Route("/parametres", name="user_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     * @param Request $request
     * @return Response
     */
    public function editAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

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

    /**
     * List connected user's following list
     *
     * @Route("/follow", name="follow_list")
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
