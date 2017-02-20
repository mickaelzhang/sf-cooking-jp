<?php

namespace FrontOfficeBundle\Controller;

use FrontOfficeBundle\Form\SearchBarType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class SearchController extends Controller
{
    /**
     * Render search bar
     */
    public function searchBarAction(Request $request)
    {
        $form = $this->createForm(SearchBarType::class, null, array(
            'action' => $this->generateUrl('search_result'),
            'method' => 'GET',
        ));

        $form->handleRequest($request);

        return $this->render('frontend/components/search_bar.html.twig', array(
            'searchBar' => $form->createView()
        ));
    }

    /**
     * @Route("/search", name="search_result")
     * @Method({"GET", "POST"})
     */
    public function searchResultAction(Request $request)
    {
        $form = $this->createForm(SearchBarType::class, null, array(
            'action' => $this->generateUrl('search_result'),
            'method' => 'GET',
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();

            if ($data['entityChoice'] == 'user') {
                $users = $em->getRepository('AppBundle:User')->searchUserByUsername($data['searchInput']);

                return $this->render('@frontend/user/list.html.twig', array(
                    'users' => $users
                ));
            } elseif ($data['entityChoice'] == 'recipe') {
                $recipes = $em->getRepository('AppBundle:Recipe')->searchRecipeByName($data['searchInput']);

                return $this->render('@frontend/recipe/list.html.twig', array(
                    'recipes' => $recipes
                ));
            }
        }
    }
}
