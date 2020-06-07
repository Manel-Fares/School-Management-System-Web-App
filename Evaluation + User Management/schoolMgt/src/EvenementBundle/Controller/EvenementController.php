<?php

namespace EvenementBundle\Controller;

use Doctrine\ORM\EntityRepository;
use EvenementBundle\Entity\Club;
use EvenementBundle\Entity\Evenement;
use EvenementBundle\Entity\Participation;
use EvenementBundle\Entity\Rate;
use schoolBundle\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Evenement controller.
 *
 * @Route("evenement")
 */
class EvenementController extends Controller
{
    /**
     * Lists all evenement entities.
     *
     * @Route("/", name="evenement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $club=$em->getRepository('EvenementBundle:Club')->find(1);
        var_dump($club);
        $evenements = $em->getRepository('EvenementBundle:Evenement')->findAll();

        return $this->render('evenement/index.html.twig', array(
            'evenements' => $evenements,
        ));
    }

    /**
     * Lists all evenement cl entities.
     *
     * @Route("/afficherEvenementClub", name="EvenementClub")
     * @Method("GET")
     */
    public function afficherEvenementClubAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        // var_dump($user);

        $club=$em->getRepository('EvenementBundle:Club')->findOneBy(array('idresponsable'=>$user->getId()));
        $evenement = $em->getRepository('EvenementBundle:Evenement')->afficerSpecifiqueClub($club->getidClub());
        for($i=0;$i<count($evenement);$i++){
            //   var_dump($evenements[$i]['idevenement']);
            $p = $em->getRepository('EvenementBundle:Participation')->partEvclb($evenement[$i]['idevenement']);
            foreach ($p as $r){
                $evenements[$i]=$r;
                // array_push($aa,$r);
            }}
        var_dump($evenements);
        //var_dump($club);
       // $evenements = $em->getRepository('EvenementBundle:Evenement')->afficerSpecifiqueClub($club);
       var_dump($evenements);

        return $this->render('evenement/EvenementClub.html.twig', array(
            'evenements' => $evenements
        ));
    }
    /**
     * Lists all image  evenement entities.
     *
     * @Route("/image", name="evenement_image")
     * @Method("GET")
     */
    public function ListImageAction(Request $request)
    { $em = $this->getDoctrine()->getManager();

        $evenement = $em->getRepository('EvenementBundle:Evenement')->afficerSpecifique();
        // var_dump($evenements);
        for($i=0;$i<count($evenement);$i++){
            //   var_dump($evenements[$i]['idevenement']);
            $p = $em->getRepository('EvenementBundle:Participation')->partEvclb($evenement[$i]['idevenement']);
            foreach ($p as $r){
                $evenements[$i]=$r;
                // array_push($aa,$r);
            }}
     //   var_dump($evenements);
      //  $p = $em->getRepository('EvenementBundle:Participation')->partEvclb();
        $entities  = $this->get('knp_paginator')->paginate(
            $evenements,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
       12
        );




        return $this->render('evenement/listImageEvenement.html.twig', array(
            'evenements' => $entities,
        ));
    }
    /**
     * Lists all image detail  evenement entities.
     *
     * @Route("/detailevenement/{idevenement}", name="evenement_detail")
     * @Method({"GET", "POST"})
     */
    public function ListImageDetailAction(Request $request,$idevenement)
    { $em = $this->getDoctrine()->getManager();

        $evs = $em->getRepository('EvenementBundle:Evenement')->find($idevenement+0);
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $club=$em->getRepository('EvenementBundle:Club')->findOneBy(array('idresponsable'=>$user));
       // $p = $em->getRepository('EvenementBundle:Participation')->partEvclb($club->getidEvenement());
        var_dump($club);
        $participation = new Participation();
        //var_dump($request);
        if($request->isMethod('POST'))
        {
            $em = $this->getDoctrine()->getManager();
            $participation->setIduser($user);
            $participation->setIdevenement($evs);
            $em->persist($participation);
            $em->flush();

            return $this->redirectToRoute('evenement_image');
        }
       /* $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rate->setIduser($user);
            $rate->setIdclub($club);
            $em = $this->getDoctrine()->getManager();
            $em->persist($rate);
            $em->flush();

            return $this->redirectToRoute('evenement_image');
        }*/

        return $this->render('evenement/listImageEvenementxx.html.twig', array(
            'evenement' => $evs
        ));
    }
    /**
     * Lists all  Proche  evenement entities.
     *
     * @Route("/EvenementProche", name="evenement_Proche")
     * @Method("GET")
     */
    public function EvenementProAction(Request $request)
    { $em = $this->getDoctrine()->getManager();
        //$evenements=null;
        $ev = $em->getRepository('EvenementBundle:Evenement')->EvenementProch();
            //  var_dump($ev);
            //for ($i = 0; $i < sizeof($ev); $i++) {
            //$evenements = $em->getRepository('EvenementBundle:Evenement')->find(12);
        $entities  = $this->get('knp_paginator')->paginate(
            $ev,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            4
        );


        // }
        var_dump($ev);
        //bara hani ok

        return $this->render('evenement/procheEvenement.html.twig', array(
            'evenements' => $entities,
        ));
    }
    /**
     * Creates a new evenement entity.
     *
     * @Route("/new", name="evenement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {            $em = $this->getDoctrine()->getManager();

        $evenement = new Evenement();
        $c=new Club();
        $form = $this->createForm('EvenementBundle\Form\EvenementType', $evenement);

        $form->handleRequest($request);
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $club=$em->getRepository('EvenementBundle:Club')->findOneBy(array('idresponsable'=>$user));

        if ($form->isSubmitted() && $form->isValid()) {
           $evenement->setIdclub($club);
            $evenement->UploadProfilePicture();
            $em->persist($evenement);
            $em->flush();

            return $this->redirectToRoute('evenement_show', array('idevenement' => $evenement->getIdevenement()));
        }

        return $this->render('evenement/new.html.twig', array(
            'evenement' => $evenement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a evenement entity.
     *
     * @Route("/{idevenement}", name="evenement_show")
     * @Method("GET")
     */
    public function showAction(Evenement $evenement)
    {
        $deleteForm = $this->createDeleteForm($evenement);

        return $this->render('evenement/show.html.twig', array(
            'evenement' => $evenement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing evenement entity.
     *
     * @Route("/{idevenement}/edit", name="evenement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Evenement $evenement)
    {
        $deleteForm = $this->createDeleteForm($evenement);
        $editForm = $this->createForm('EvenementBundle\Form\EvenementType', $evenement);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $evenement->UploadProfilePicture();

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evenement_edit', array('idevenement' => $evenement->getIdevenement()));
        }


        $user = $this->getUser();
       //// if ($user->hasRole('ROLE_ADMIN')) {
        return $this->render('evenement/edit.html.twig', array(
            'evenement' => $evenement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));//}
        /*else {

            return $this->render('evenement/edit2.html.twig', array(
                'evenement' => $evenement,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));}*/
    }

    /**
     * Deletes a evenement entity.
     *
     * @Route("/{idevenement}/delete", name="evenement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Evenement $evenement)
    {
        $form = $this->createDeleteForm($evenement);
        $form->handleRequest($request);
var_dump($evenement);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($evenement);
            $em->flush();
        }

        return $this->redirectToRoute('evenement_index');
    }

    /**
     * Creates a form to delete a evenement entity.
     *
     * @param Evenement $evenement The evenement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Evenement $evenement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('evenement_delete', array('idevenement' => $evenement->getIdevenement())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }



}
