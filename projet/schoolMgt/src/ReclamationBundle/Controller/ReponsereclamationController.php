<?php

namespace ReclamationBundle\Controller;

use ReclamationBundle\Entity\Reponsereclamation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Reponsereclamation controller.
 *
 */
class ReponsereclamationController extends Controller
{
    /**
     * Lists all reponsereclamation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reponsereclamations = $em->getRepository('ReclamationBundle:Reponsereclamation')->findAll();

        return $this->render('reponsereclamation/index.html.twig', array(
            'reponsereclamations' => $reponsereclamations,
        ));
    }

    /**
     * Creates a new reponsereclamation entity.
     *
     */
    public function newAction(Request $request)
    {
        $reponsereclamation = new Reponsereclamation();
        $form = $this->createForm('ReclamationBundle\Form\ReponsereclamationType', $reponsereclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reponsereclamation);
            $em->flush();

            return $this->redirectToRoute('reponsereclamation_show', array('idrep' => $reponsereclamation->getIdrep()));
        }

        return $this->render('reponsereclamation/new.html.twig', array(
            'reponsereclamation' => $reponsereclamation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reponsereclamation entity.
     *
     */
    public function showAction(Reponsereclamation $reponsereclamation)
    {
        $deleteForm = $this->createDeleteForm($reponsereclamation);

        return $this->render('reponsereclamation/show.html.twig', array(
            'reponsereclamation' => $reponsereclamation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reponsereclamation entity.
     *
     */
    public function editAction(Request $request, Reponsereclamation $reponsereclamation)
    {
        $deleteForm = $this->createDeleteForm($reponsereclamation);
        $editForm = $this->createForm('ReclamationBundle\Form\ReponsereclamationType', $reponsereclamation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reponsereclamation_edit', array('idrep' => $reponsereclamation->getIdrep()));
        }

        return $this->render('reponsereclamation/edit.html.twig', array(
            'reponsereclamation' => $reponsereclamation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reponsereclamation entity.
     *
     */
    public function deleteAction(Request $request, Reponsereclamation $reponsereclamation)
    {
        $form = $this->createDeleteForm($reponsereclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reponsereclamation);
            $em->flush();
        }

        return $this->redirectToRoute('reponsereclamation_index');
    }

    /**
     * Creates a form to delete a reponsereclamation entity.
     *
     * @param Reponsereclamation $reponsereclamation The reponsereclamation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reponsereclamation $reponsereclamation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reponsereclamation_delete', array('idrep' => $reponsereclamation->getIdrep())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
