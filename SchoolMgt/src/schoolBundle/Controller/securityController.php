<?php

namespace schoolBundle\Controller;

use schoolBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class securityController extends Controller
{
    public function addAction($username,$nom,$prenom,$cin,$email,$sexe,$password,$role,$pic,$tel)
    {
     //   $userManger= $this->container->get('fos_user.user_manager');
        $user = new Users();
      //  $user = $userManger->createUser();
        $user->setEmail($email);
        $user->setUsername($username);
        $user->setCinuser($cin);
        $user->setRoles(array($role));
        $user->setEmail($email);
        $user->setPlainPassword($password);
        $user->setNomuser($nom);
        $user->setSexeuser($sexe);
        $user->setNumteluser($tel);
        /*  $userManger->updateUser($user);*/
        $user->setPrenomuser($prenom);
        $picture = "uploads/".$pic;
        $user->setPicuser($picture);

        $user->setEnabled(true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT u
             FROM schoolBundle:Users u
             WHERE u.username = :username'

        )->setParameter('username',$username);
        $u= $query->getResult();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($u);
        return new JsonResponse($formatted);
    }


    public function redirectAction()
    {
        $authChecker = $this->container->get('security.authorization_checker');
        if($authChecker->isGranted('ROLE_ADMINISTRATEUR')) {
            return $this->render('UserBundle:User:profileAdmin.html.twig');

        }else if ($authChecker->isGranted('ROLE_ETUDIANT')){
            $em = $this->getDoctrine()->getManager();
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $clubs = $em->getRepository('EvenementBundle:Club')->findBy(array('idresponsable'=>$user));
            if($clubs!=null)
            {$tt=1;}
            else
            {  $tt=0;}
            var_dump($tt);
            return $this->render('UserBundle:User:profileEtudiant.html.twig', array(
                'clubs'=>$tt
            ));
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
