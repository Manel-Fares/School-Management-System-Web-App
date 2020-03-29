<?php

namespace schoolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class securityController extends Controller
{
    public function addAction()
    {
        $userManger= $this->container->get('fos_user.user_manager');
        $user = $userManger->createUser();
        $user->setUsername('John');
        $user->setRoles(array('ROLE_ADMIN'));
        $user->setEmail('john@gmail.com');
        $user->setPlainPassword('userPassword');
        $userManger->updateUser($user);
        $user->setEnabled(true);


        return $this->forward('schoolBundle:security:redirect');
    }


    public function redirectAction()
    {
        $authChecker = $this->container->get('security.authorization_checker');
        if($authChecker->isGranted('ROLE_ADMIN')) {
            return $this->render('@school/security/admin_home.html.twig');
        }else if ($authChecker->isGranted('ROLE_USER')){
            return $this->render('@school/security/user_home.html.twig');
        }
        return $this->render('@FOSUser/Security/login.html.twig', array(
            // ...
        ));
    }

}
