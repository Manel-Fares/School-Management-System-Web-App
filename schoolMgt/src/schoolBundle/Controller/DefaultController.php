<?php

namespace schoolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('schoolBundle:Default:index.html.twig');
    }
}
