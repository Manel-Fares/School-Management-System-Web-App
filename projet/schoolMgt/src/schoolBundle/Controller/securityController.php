<?php

namespace schoolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class securityController extends Controller
{
    public function addAction()
    {
        $userManger= $this->container->get('fos_user.user_manager');
        $user = $userManger->createUser();
        $user->setUsername('Anis');
        $user->setRoles(array('ROLE_Personnel'));
        $user->setEmail('Anis@gmail.com');
        $user->setPlainPassword('anis');
        $userManger->updateUser($user);
        $user->setEnabled(true);


        return $this->forward('schoolBundle:security:redirect');
    }


    public function redirectAction()
    {
        $authChecker = $this->container->get('security.authorization_checker');
        if($authChecker->isGranted('ROLE_ADMINISTRATEUR')) {
            return $this->render('UserBundle:User:profileAdmin.html.twig');

        }else if ($authChecker->isGranted('ROLE_ETUDIANT')){
            return $this->render('UserBundle:User:profileEtudiant.html.twig');

        }
        else if ($authChecker->isGranted('ROLE_ENSEIGNIANT')){
            return $this->render('UserBundle:User:profileEnseignant.html.twig');

        }else if ($authChecker->isGranted('ROLE_PERSONNEL')){
            return $this->render('UserBundle:User:profilePersonnel.html.twig');
        }

        return $this->render('@FOSUser/Security/login.html.twig', array(
            // ...
        ));
    }

}
