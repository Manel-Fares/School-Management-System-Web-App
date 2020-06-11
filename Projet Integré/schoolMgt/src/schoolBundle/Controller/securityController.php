<?php

namespace schoolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class securityController extends Controller
{
    public function addAction($username,$nom,$prenom,$cin,$email,$sexe,$password,$role)
    {
        $userManger= $this->container->get('fos_user.user_manager');
        $user = $userManger->createUser();
        $user->setEmail($email);
        $user->setUsername($username);
        $user->setCinuser($cin);
        $user->setRoles(array($role));
        $user->setEmail($email);
        $user->setPlainPassword($password);
        $user->setNomuser($nom);
        $user->setSexeuser($sexe);
        $user->setPrenomuser($prenom);
        $userManger->updateUser($user);
        $user->setEnabled(true);

       /* $em = $this->getDoctrine()->getManager();
        $em->persist($note);
        $em->flush();*/


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);
    }


    public function redirectAction()
    {
        $authChecker = $this->container->get('security.authorization_checker');
        if($authChecker->isGranted('ROLE_ADMINISTRATEUR')) {
            return $this->render('UserBundle:User:profileAdmin.html.twig');

        }else if ($authChecker->isGranted('ROLE_ETUDIANT')){
            return $this->render('UserBundle:User:profileEtudiant.html.twig');

        }
        else if ($authChecker->isGranted('ROLE_ENSEIGNANT')){
            return $this->render('UserBundle:User:profileEnseignant.html.twig');

        }else if ($authChecker->isGranted('ROLE_PERSONNEL')){
            return $this->render('UserBundle:User:profilePersonnel.html.twig');
        }

        return $this->render('@FOSUser/Security/login.html.twig', array(
            // ...
        ));
    }

}
