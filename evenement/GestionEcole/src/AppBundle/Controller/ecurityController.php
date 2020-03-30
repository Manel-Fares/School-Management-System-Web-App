<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ecurityController extends Controller
{
    /**
     * @Route("/authentification")
     */
    public function authentificationAction()
    {
        return $this->render('AppBundle:ecurity:admin_home.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/home")
     */
    public function redirectAction()
    {
        $authChecker=$this->container->get('security.authorization_checker');
        if($authChecker->isGranted('ROLE_ADMIN ')){
        return $this->render('@App/ecurity/user_home.twig');}
        else if($authChecker->isGranted('ROLE_USER ')){
            return $this->render('@App/ecurity/user_home.twig');}
        return $this->render('@App/ecurity/user_home.twig');
    }

}
