<?php

namespace evaluationsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('evaluationsBundle:Default:index.html.twig');
    }
}
