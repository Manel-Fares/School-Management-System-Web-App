<?php

namespace EvenementBundle\Controller;

use EvenementBundle\Entity\Demandeevenement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Demandeevenement controller.
 *
 * @Route("demandeevenement")
 */
class DemandeevenementController extends Controller
{
    /**
     * Lists all demandeevenement entities.
     *
     * @Route("/", name="demandeevenement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $demandeevenements = $em->getRepository('EvenementBundle:Demandeevenement')->findAll();

        return $this->render('demandeevenement/index.html.twig', array(
            'demandeevenements' => $demandeevenements,
        ));
    }

    /**
     * Creates a new demandeevenement entity.
     *
     * @Route("/new", name="demandeevenement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $demandeevenement = new Demandeevenement();
        $form = $this->createForm('EvenementBundle\Form\DemandeevenementType', $demandeevenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($demandeevenement);
            $em->flush();

            return $this->redirectToRoute('demandeevenement_show', array('iddemandeevenement' => $demandeevenement->getIddemandeevenement()));
        }

        return $this->render('demandeevenement/new.html.twig', array(
            'demandeevenement' => $demandeevenement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a demandeevenement entity.
     *
     * @Route("/{iddemandeevenement}", name="demandeevenement_show")
     * @Method("GET")
     */
    public function showAction(Demandeevenement $demandeevenement)
    {
        $deleteForm = $this->createDeleteForm($demandeevenement);

        return $this->render('demandeevenement/show.html.twig', array(
            'demandeevenement' => $demandeevenement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing demandeevenement entity.
     *
     * @Route("/{iddemandeevenement}/edit", name="demandeevenement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Demandeevenement $demandeevenement)
    {
        $deleteForm = $this->createDeleteForm($demandeevenement);
        $editForm = $this->createForm('EvenementBundle\Form\DemandeevenementType', $demandeevenement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('demandeevenement_edit', array('iddemandeevenement' => $demandeevenement->getIddemandeevenement()));
        }

        return $this->render('demandeevenement/edit.html.twig', array(
            'demandeevenement' => $demandeevenement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a demandeevenement entity.
     *
     * @Route("/{iddemandeevenement}", name="demandeevenement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Demandeevenement $demandeevenement)
    {
        $form = $this->createDeleteForm($demandeevenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($demandeevenement);
            $em->flush();
        }

        return $this->redirectToRoute('demandeevenement_index');
    }

    /**
     * Creates a form to delete a demandeevenement entity.
     *
     * @param Demandeevenement $demandeevenement The demandeevenement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Demandeevenement $demandeevenement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('demandeevenement_delete', array('iddemandeevenement' => $demandeevenement->getIddemandeevenement())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
