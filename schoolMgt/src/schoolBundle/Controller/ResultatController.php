<?php

namespace schoolBundle\Controller;

use schoolBundle\Entity\Resultat;
use schoolBundle\Form\ResultatType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Resultat controller.
 *
 */
class ResultatController extends Controller
{


    public function indexAction(){
        $resultat= $this->getDoctrine()->getRepository(Resultat::class)->findAll();
        return $this->render("@school/Resultat/read.html.twig",array("resultat"=>$resultat));
    }


}
