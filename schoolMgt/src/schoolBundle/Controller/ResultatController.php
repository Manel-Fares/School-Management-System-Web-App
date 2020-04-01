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


    public function resutlatEtudiantAction()
    {
        $matiere =array();
        $enseignant =array();

        $em=$this->getDoctrine()->getManager();

        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT n.notecc,
             n.noteds,
             n.moyenne,
             n.noteexam,
             m.nom,
             m.coef,
             u.nomuser,
             u.prenomuser
             FROM schoolBundle:Note n
             LEFT JOIN schoolBundle:Matier m
             WITH n.matiere = m.id
             LEFT JOIN schoolBundle:Users u
             WITH u.id = n.enseignant             
             WHERE n.etudiant = :etudiant'
        )->setParameter('etudiant',1 );

        $note = $query->getResult();

        $query2 = $entityManager->createQuery(
            'SELECT r.resultat
             FROM schoolBundle:Resultat r            
             WHERE r.etudiant = :etudiant'
        )->setParameter('etudiant',1 );

        $res = $query2->getResult();
        dump($res);
        return $this->render('@school/Resultat/affichageResultatEtudiant.html.twig',
            array('note'=>$note,'resultat'=>$res));
    }

}
