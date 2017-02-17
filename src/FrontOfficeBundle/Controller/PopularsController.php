<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class PopularsController
 *
 * @package FrontOfficeBundle\Controller
 * @Route("populaires")
 */
class PopularsController extends Controller
{
    /**
     * Lists all user's favorites.
     *
     * @Route("/", name="populars_list")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $populars = $em->getRepository('AppBundle:UserFollow')->getPopularsProfiles(0);

        return $this->render('@frontend/populars/list.html.twig', array(
            'populars' => $populars,
        ));
    }
}
