<?php

namespace UserBundle\Controller;

use schoolBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function afficherAction()
    {
        $u=$this->getDoctrine()->getRepository(Users::class)->findAll();

        return $this->render('UserBundle:User:afficher.html.twig', array(
            'users'=>$u,
        ));
    }

    public function profileAction()
    {

        $u=$this->getDoctrine()->getRepository(Users::class)->findBy(
            ['id' => $this->getUser()->getId()]
        );
        dump($u);
        return $this->render('UserBundle:User:profile.html.twig', array(
            'user'=>$u,
        ));
    }

}
