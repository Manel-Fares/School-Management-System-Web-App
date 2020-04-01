<?php

namespace schoolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class securityController extends Controller
{
    public function addAction()
    {
        $userManger= $this->container->get('fos_user.user_manager');
        $user = $userManger->createUser();
        $user->setUsername('lotfi');
        $user->setRoles(array('ROLE_ENSEIGNIANT'));
        $user->setEmail('lotfi@gmail.com');
        $user->setPlainPassword('lotfi');
        $userManger->updateUser($user);
        $user->setEnabled(true);


        return $this->forward('schoolBundle:security:redirect');
    }


    public function redirectAction()
    {
        $authChecker = $this->container->get('security.authorization_checker');
        if($authChecker->isGranted('ROLE_ENSEIGNANT')) {
            return $this->redirectToRoute('note_affiche_enseignant');

        }else if ($authChecker->isGranted('ROLE_ETUDIANT')){
            return $this->redirectToRoute('note_affiche_etudiant');
        }
        return $this->render('@FOSUser/Security/login.html.twig', array(
            // ...
        ));
    }

}
