<?php

namespace FrontOfficeBundle\Controller;

use AppBundle\Entity\User;
use FrontOfficeBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RegistrationController extends Controller
{
    /**
     * @Route("/inscription", name="user_registration")
     * @Security("!has_role('ROLE_USER')")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function registerAction(Request $request)
    {
        // build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // handle the submit on POST
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $file stores the uploaded PDF file
            /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $user->getImage();
            if ($file != null)
            {
                $fileName = $this->get('app_user.image_uploader')->upload($file);

                // Update image property to store image file name instead of content
                $user->setImage($fileName);
            }

            // Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // Save the User
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            '@frontend/security/register.html.twig',
            array('form' => $form->createView())
        );
    }
}
