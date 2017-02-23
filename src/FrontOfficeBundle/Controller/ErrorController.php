<?php

namespace FrontOfficeBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ErrorController extends Controller
{
    /**
     * Page 404
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showErrorAction()
    {
        return $this->render('@frontend/404.html.twig');
    }
}
