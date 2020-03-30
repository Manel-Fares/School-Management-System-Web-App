<?php

namespace EvenementBundle\Controller;

use EvenementBundle\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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

        $evenements = $em->getRepository('EvenementBundle:Evenement')->findAll();

        return $this->render('evenement/index.html.twig', array(
            'evenements' => $evenements,
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

        $evenements = $em->getRepository('EvenementBundle:Evenement')->findAll();
        $entities  = $this->get('knp_paginator')->paginate(
            $evenements,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
       4
        );

        return $this->render('evenement/listImageEvenement.html.twig', array(
            'evenements' => $entities,
        ));
    }
    /**
     * Lists all image detail  evenement entities.
     *
     * @Route("/detailevenement/{idevenement}", name="evenement_detail")
     * @Method("GET")
     */
    public function ListImageDetailAction(Request $request,$idevenement)
    { $em = $this->getDoctrine()->getManager();

        $evs = $em->getRepository('EvenementBundle:Evenement')->find($idevenement+0);


        return $this->render('evenement/listImageEvenementxx.html.twig', array(
            'evenement' => $evs,
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
    {
        $evenement = new Evenement();
        $form = $this->createForm('EvenementBundle\Form\EvenementType', $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
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
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evenement_edit', array('idevenement' => $evenement->getIdevenement()));
        }

        return $this->render('evenement/edit.html.twig', array(
            'evenement' => $evenement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a evenement entity.
     *
     * @Route("/{idevenement}", name="evenement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Evenement $evenement)
    {
        $form = $this->createDeleteForm($evenement);
        $form->handleRequest($request);

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
