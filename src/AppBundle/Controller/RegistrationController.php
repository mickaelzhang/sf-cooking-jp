<?php

namespace AppBundle\Controller;

use AppBundle\Form\UserType;
use AppBundle\Entity\User;
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

            $fileName = $this->get('app_user.image_uploader')->upload($file);

            // Update image property to store image file name instead of content
            $user->setImage($fileName);

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            '@frontend/security/register.html.twig',
            array('form' => $form->createView())
        );
    }
}
