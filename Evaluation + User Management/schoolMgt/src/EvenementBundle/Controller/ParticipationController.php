<?php

namespace EvenementBundle\Controller;

use EvenementBundle\Entity\Evenement;
use EvenementBundle\Entity\Participation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Participation controller.
 *
 * @Route("participation")
 */
class ParticipationController extends Controller
{
    /**
     * Lists all participation entities.
     *
     * @Route("/", name="participation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
     //   $club=$em->getRepository('EvenementBundle:Evenement')->find(2);
//var_dump($club);
        $participations = $em->getRepository('EvenementBundle:Participation')->findAll();

        $p = $em->getRepository('EvenementBundle:Participation')->partEvclb($club->getidEvenement());
var_dump($p);
        return $this->render('participation/index.html.twig', array(
            'participations' => $participations,
        ));
    }

    /**
     * Creates a new participation entity.
     *
     * @Route("/new/{idevenement}", name="participation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request,Evenement $evenement)
    {
        $em = $this->getDoctrine()->getManager();
        // var_dump($evenements);
            $p = $em->getRepository('EvenementBundle:Participation')->partEvclb($evenement->getIdevenement());
            foreach ($p as $r){
                $evenements=$r;
                // array_push($aa,$r);
            }
        $participation = new Participation();
        $form = $this->createForm('EvenementBundle\Form\ParticipationType', $participation);
        $form->handleRequest($request);
        $participation = new Participation();
        var_dump($evenement);
        $evs = $em->getRepository('EvenementBundle:Evenement')->find($evenement->getIdevenement());
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $participation = new Participation();
        //var_dump($request);
        if($request->isMethod('POST'))
        {
            $participation->setIduser($user);
            $participation->setIdevenement($evs);
            $em->persist($participation);
            $em->flush();

            return $this->redirectToRoute('evenement_image');
        }



        return $this->render('participation/show.html.twig', array(
            'evenement' => $evenement, 'ev' => $evenements,
        ));
    }

    /**
     * Finds and displays a participation entity.
     *
     * @Route("/{idparticipation}", name="participation_show")
     * @Method("GET")
     */
    public function showAction(Participation $participation)
    {
        $deleteForm = $this->createDeleteForm($participation);

        return $this->render('participation/show.html.twig', array(
            'participation' => $participation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing participation entity.
     *
     * @Route("/{idparticipation}/edit", name="participation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Participation $participation)
    {
        $deleteForm = $this->createDeleteForm($participation);
        $editForm = $this->createForm('EvenementBundle\Form\ParticipationType', $participation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('participation_edit', array('idparticipation' => $participation->getIdparticipation()));
        }

        return $this->render('participation/edit.html.twig', array(
            'participation' => $participation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a participation entity.
     *
     * @Route("/{idparticipation}", name="participation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Participation $participation)
    {
        $form = $this->createDeleteForm($participation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($participation);
            $em->flush();
        }

        return $this->redirectToRoute('participation_index');
    }

    /**
     * Creates a form to delete a participation entity.
     *
     * @param Participation $participation The participation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Participation $participation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('participation_delete', array('idparticipation' => $participation->getIdparticipation())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
