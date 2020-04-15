<?php

namespace EvenementBundle\Controller;

use EvenementBundle\Entity\Club;
use EvenementBundle\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Club controller.
 *
 * @Route("club")
 */
class ClubController extends Controller
{
    /**
     * Lists all club entities.
     *
     * @Route("/", name="club_index")
     * @Method({"GET","POST"})
     */
    public function indexAction(Request $request)
    { $em = $this->getDoctrine()->getManager();

        $clubs = $em->getRepository('EvenementBundle:Club')->findAll();
        if($request ->isMethod('post')){
            $varr=$request->get('search');
            $clubs = $em->getRepository('EvenementBundle:Club')->search($varr);
        }



        return $this->render('club/index.html.twig', array(
            'clubs' => $clubs,
        ));
    }
    /**
     * Finds and displays a club Image .
     *
     * @Route("/ListImage", name="club_show_image")
     * @Method("GET")
     */
    public function ListImageAction(Request $request)
    { $em = $this->getDoctrine()->getManager();

        $clubs = $em->getRepository('EvenementBundle:Club')->afficerSpecifique();
        $entities  = $this->get('knp_paginator')->paginate(
            $clubs,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            1/*nbre d'éléments par page*/
        );



        return $this->render('club/listImageClub.html.twig', array(
            'clubs' => $entities,
        ));
    }

    /**
     * Creates a new club entity.
     *
     * @Route("/new", name="club_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $club = new Club();

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $form = $this->createForm('EvenementBundle\Form\ClubType', $club);
        $form->handleRequest($request);
        var_dump($user);

        $club->setIdresponsable($user);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($club);
            $em->flush();

            return $this->redirectToRoute('club_show', array('idclub' => $club->getIdclub()));
        }

        return $this->render('club/new.html.twig', array(
            'club' => $club,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a club entity.
     *
     * @Route("/{idclub}", name="club_show")
     * @Method("GET")
     */
    public function showAction(Club $club)
    {
        $deleteForm = $this->createDeleteForm($club);
        $em = $this->getDoctrine()->getManager();
        $Cl=new  Club();


        $ct=$Cl->getConstants();
        $bd = $em->getRepository('EvenementBundle:Demandeevenement')->budgetEvenementClub($club->getIdclub());

        $clubs = $em->getRepository('EvenementBundle:Club')->nbrEvenementClub($club->getIdclub());
        var_dump($clubs);
        $evenements= $em->getRepository('EvenementBundle:Evenement')->nbrEvenementTotale();

        return $this->render('club/show.html.twig', array(
            'club' => $club,
            'delete_form' => $deleteForm->createView(),'clubs' => $clubs,'evenements'=>$evenements,'bd'=>$bd,'ct'=>$ct
        ));
    }

    /**
     * Displays a form to edit an existing club entity.
     *
     * @Route("/{idclub}/edit", name="club_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Club $club)
    {
        $deleteForm = $this->createDeleteForm($club);
        $editForm = $this->createForm('EvenementBundle\Form\ClubType', $club);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('club_edit', array('idclub' => $club->getIdclub()));
        }

        return $this->render('club/edit.html.twig', array(
            'club' => $club,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a club entity.
     *
     * @Route("/{idclub}", name="club_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Club $club)
    {
        $form = $this->createDeleteForm($club);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($club);
            $em->flush();
        }

        return $this->redirectToRoute('club_index');
    }

    /**
     * Creates a form to delete a club entity.
     *
     * @param Club $club The club entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Club $club)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('club_delete', array('idclub' => $club->getIdclub())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    public function nbrEvenementClubAction()
    {
        $em = $this->getDoctrine()->getManager();
        $bb = $em->getRepository('EvenementBundle:Evenement')->xx();

        $clubs = $em->getRepository('EvenementBundle:Club')->nbrEvenementClub();
        $evenements= $em->getRepository('EvenementBundle:Evenement')->nbrEvenementTotale();

        var_dump($bb);
        return $this->render('club/xx.html.twig', array(
            'clubs' => $clubs,'evenements'=>$evenements
        ));
    }
}
