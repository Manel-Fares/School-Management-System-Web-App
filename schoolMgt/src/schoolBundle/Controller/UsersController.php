<?php

namespace schoolBundle\Controller;

use schoolBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * User controller.
 *
 */
class UsersController extends Controller
{
    /**
     * Lists all user entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('schoolBundle:Users')->findAll();

        return $this->render('users/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     */


    public function showAction(Users $user)
    {

        return $this->render('users/show.html.twig', array(
            'user' => $user,
        ));
    }
}
