<?php

namespace EvenementBundle\Controller;

use EvenementBundle\Entity\Rate;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Rate controller.
 *
 * @Route("rate")
 */
class RateController extends Controller
{
    /**
     * Lists all rate entities.
     *
     * @Route("/", name="rate_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rates = $em->getRepository('EvenementBundle:Rate')->findAll();

        return $this->render('rate/index.html.twig', array(
            'rates' => $rates,
        ));
    }

    /**
     * Lists all image detail  club entities.
     *
     * @Route("/club/{idclub}", name="club_detail")
     * @Method({"GET","POST"})
     */
    public function newAction(Request $request,$idclub)
    {
        $rate = new Rate();
        $em = $this->getDoctrine()->getManager();
        $aa = $em->getRepository('EvenementBundle:Club')->find($idclub+0);
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $form = $this->createForm('EvenementBundle\Form\RateType', $rate);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid() ) {
           /// $em = $this->getDoctrine()->getManager();
            ///

    // echo "aaaaaaaaaaaaaaa";
            $rate->setIduser($user);
            $rate->setIdc($aa);
            $rate->setRating($request->get('rating')+0);
            //var_dump($rate->getRating());
            $em->persist($rate);
            $em->flush();

           // return $this->redirectToRoute('rate_show', array('idrating' => $rate->getIdrating()));
        }

        return $this->render('club/rate.html.twig', array(
            'aa' =>$aa,'rate' => $rate,
            'form' => $form->createView(),
        ));
    }
    /**
     * Lists all image detail  club entities.
     *
     * @Route("/{idclub}", name="club_rate")
     * @Method({"GET","POST"})
     */
    public function new2Action(Request $request,$idclub)
    {
        $em = $this->getDoctrine()->getManager();
        $rate = new Rate();

        $aa = $em->getRepository('EvenementBundle:Club')->find($idclub+0);
        var_dump($aa->getIdclub());
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        var_dump($user);
        $form = $this->createForm('EvenementBundle\Form\RateType', $rate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /// $em = $this->getDoctrine()->getManager();
            //var_dump($aa);
            $rate->setIduser($user);
            $rate->setIdc($aa);
            $em->persist($rate);
            $em->flush();

            // return $this->redirectToRoute('rate_show', array('idrating' => $rate->getIdrating()));
        }

        return $this->render('rate/new.html.twig', array(
            'aa' =>$aa,'rate' => $rate,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a rate entity.
     *
     * @Route("/{idrating}", name="rate_show")
     * @Method("GET")
     */
    public function showAction(Rate $rate)
    {
        $deleteForm = $this->createDeleteForm($rate);

        return $this->render('rate/show.html.twig', array(
            'rate' => $rate,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing rate entity.
     *
     * @Route("/{idrating}/edit", name="rate_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Rate $rate)
    {
        $deleteForm = $this->createDeleteForm($rate);
        $editForm = $this->createForm('EvenementBundle\Form\RateType', $rate);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rate_edit', array('idrating' => $rate->getIdrating()));
        }

        return $this->render('rate/edit.html.twig', array(
            'rate' => $rate,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a rate entity.
     *
     * @Route("/{idrating}", name="rate_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Rate $rate)
    {
        $form = $this->createDeleteForm($rate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rate);
            $em->flush();
        }

        return $this->redirectToRoute('rate_index');
    }

    /**
     * Creates a form to delete a rate entity.
     *
     * @param Rate $rate The rate entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Rate $rate)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rate_delete', array('idrating' => $rate->getIdrating())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
