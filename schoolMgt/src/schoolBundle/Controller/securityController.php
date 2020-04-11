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
        if($authChecker->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('note_affiche_enseignant');

        }else if ($authChecker->isGranted('ROLE_ETUDIANT')){
            return $this->redirectToRoute('note_affiche_etudiant');

        }
        else if ($authChecker->isGranted('ROLE_ENSEIGNIANT')){
            return $this->redirectToRoute('note_affiche_enseignant');

        }else if ($authChecker->isGranted('ROLE_PERSONNEL')){
            return $this->redirectToRoute('resultat__management');
        }

        return $this->render('@FOSUser/Security/login.html.twig', array(
            // ...
        ));
    }

}
