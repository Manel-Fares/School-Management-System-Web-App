<?php

namespace SubjectsBundle\Controller;

use ClassBundle\Entity\Enseigner;
use schoolBundle\Entity\Matier;
use schoolBundle\Entity\Users;
use SubjectsBundle\Form\EnseignerType;
use SubjectsBundle\Form\MatierType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class subjectController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $matiers = $em->getRepository('schoolBundle:Matier')->findAll();

        return $this->render('Subjects/index.html.twig', array(
            'matiers' => $matiers,
        ));
    }

    public function addAction(Request $request)
    {
        $matier = new Matier();
        $form = $this->createForm(MatierType::class, $matier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($matier);
            $em->flush();
            $ens = new Enseigner();
            $array=$em->getRepository(Matier::class)->findByNom($matier->getNom());
            $lastkey=key(array_slice($array,-1,1,true));
            $ens->setIdmatiere($array[$lastkey]);
            $ens->setIdenseignant($em->getRepository(Users::class)->find($this->getUser()->getID()));
            $em->persist($ens);
            $em->flush();
            return $this->redirectToRoute('Matier_affich_admin');
        }

        return $this->render("@Subjects/matier/add.html.twig", array(
            'form' => $form->createView()
        ));
    }

    public function affecterAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $matier = $em->getRepository('schoolBundle:Matier')->find($id);
        $ens = new Enseigner();
        $form = $this->createForm(EnseignerType::class, $ens);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ens);
            $em->flush();
            return $this->redirectToRoute('Matier_affich_admin');
        }
        return $this->render("@Subjects/matier/enseigner.html.twig", array(
            'form' => $form->createView()
        ));
    }

    public function affichadminAction(){
        $em = $this->getDoctrine()->getManager();
        $matier = $em->getRepository(Matier::class)->findAll();
        return $this->render('@Subjects/matier/listmadmin.html.twig',array('matier'=>$matier));
    }

    public function afficherensAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT ec
             FROM ClassBundle\Entity\Enseigner ec           
             WHERE ec.idmatiere = :m'
        )->setParameter('m',$id );
        $m = $query->getResult();
        //var_dump($e);
        $teachers =array();
        foreach ($m as $item => $value){
            array_push($teachers,$em->getRepository(Users::class)->find($value->getIdenseignant()));
        }
        $matier = $em->getRepository(Matier::class)->find($id);
        return $this->render('@Subjects/matier/listmens.html.twig',array('teachers'=>$teachers,'matier'=>$matier));
    }

    public function affichresAction(){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT ec
             FROM ClassBundle\Entity\Enseigner ec           
             WHERE ec.idenseignant = :e'
        )->setParameter('e',$this->getUser()->getID() );

        $e = $query->getResult();
        //var_dump($e);
        $matier =array();
        foreach ($e as $item => $value){
            array_push($matier,$em->getRepository("schoolBundle:Matier")->find($value->getidMatiere()));
        }
        $res = array();
        foreach ($matier as $item => $value){
            array_push($res, $em->getRepository(Users::class)->find($value->getResponsable()));
        }
        // var_dump($res);
        return $this->render('@Subjects/matier/listmres.html.twig',array('matier'=>$matier,'res'=>$res,'id'=> $this->getUser()->getID()));
    }

    public function deleteensegnerAction($idm,$ide)
    {
        $em = $this->getDoctrine()->getManager();
        $enseigner=$em->getRepository(Enseigner::class)->findOneBy(['idmatiere'=>$idm,'idenseignant'=>$ide]);
        $em->remove($enseigner);
        $em->flush();
        return $this->redirectToRoute('Matier_teachers',array('id'=>$idm));
    }

    public function affichAction(){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT c
             FROM ClassBundle\Entity\Classeenseignantmatiere c,schoolBundle\Entity\Users u          
             WHERE u.id = :e
             AND u.classeetd = c.idClass'
        )->setParameter('e',$this->getUser()->getID() );

        $e = $query->getResult();
        $matier =array();
        foreach ($e as $item){
            array_push($matier, $em->getRepository("schoolBundle:Matier")->find($item->getIdMatiere()));
        }
        return $this->render('@Subjects/matier/listm.html.twig',array('matier'=>$matier));
    }
    public function suppmAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $matier=$em->getRepository(Matier::class)->find($id);
        $em->remove($matier);
        $em->flush();
        return $this->redirectToRoute('Matier_affich_admin');
    }
    public function updateAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $matier=$em->getRepository(Matier::class)->find($id);

        $form=$this->createForm(MatierType::class,$matier);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $nom = $form['nom']->getData();
            $coef = $form['coef']->getData();
            $responsable = $form['responsable']->getData();

            $matier->setNom($nom);
            $matier->setCoef($coef);
            $matier->setResponsable($responsable);
            $em->persist($matier);
            $em->flush();
            return $this->redirectToRoute('Matier_affich_admin');
        }
        return $this->render('@Subjects/matier/updatem.html.twig', array(
            "form"=> $form->createView()
        ));
    }
}
