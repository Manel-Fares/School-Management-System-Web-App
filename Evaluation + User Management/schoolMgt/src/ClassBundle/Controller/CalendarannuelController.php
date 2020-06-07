<?php

namespace ClassBundle\Controller;

use ClassBundle\Entity\Calendarannuel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Calendarannuel controller.
 *
 */
class CalendarannuelController extends Controller
{
    /**
     * Lists all calendarannuel entities.
     *
     */
    public function loadAction(Request $request)
    {
        $startDate = new \DateTime($request->get('start'));
        $endDate = new \DateTime($request->get('end'));
        $filters = $request->get('filters', []);

        try {
            $content = $this
                ->get('anca_rebeca_full_calendar.service.calendar')
                ->getData($startDate, $endDate, $filters);
            $status = empty($content) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK;
        } catch (\Exception $exception) {
            $content = json_encode(array('error' => $exception->getMessage()));
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($content);
        $response->setStatusCode($status);

        return $response;
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $calendarannuels = $em->getRepository('ClassBundle:Calendarannuel')->findAll();

        return $this->render('calendarannuel/index.html.twig', array(
            'calendarannuels' => $calendarannuels,
        ));
    }

    /**
     * Creates a new calendarannuel entity.
     *
     */
    public function newAction(Request $request)
    {
        $calendarannuel = new Calendarannuel();
        $form = $this->createForm('ClassBundle\Form\CalendarannuelType', $calendarannuel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($calendarannuel);
            $em->flush();

            return $this->redirectToRoute('calend_show', array('id' => $calendarannuel->getId()));
        }

        return $this->render('calendarannuel/new.html.twig', array(
            'calendarannuel' => $calendarannuel,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a calendarannuel entity.
     *
     */
    public function showAction(Calendarannuel $calendarannuel)
    {
        $deleteForm = $this->createDeleteForm($calendarannuel);

        return $this->render('calendarannuel/show.html.twig', array(
            'calendarannuel' => $calendarannuel,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing calendarannuel entity.
     *
     */
    public function editAction(Request $request, Calendarannuel $calendarannuel)
    {
        $deleteForm = $this->createDeleteForm($calendarannuel);
        $editForm = $this->createForm('ClassBundle\Form\CalendarannuelType', $calendarannuel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('calend_edit', array('id' => $calendarannuel->getId()));
        }

        return $this->render('calendarannuel/edit.html.twig', array(
            'calendarannuel' => $calendarannuel,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a calendarannuel entity.
     *
     */
    public function deleteAction(Request $request, Calendarannuel $calendarannuel)
    {
        $form = $this->createDeleteForm($calendarannuel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($calendarannuel);
            $em->flush();
        }

        return $this->redirectToRoute('calend_index');
    }

    /**
     * Creates a form to delete a calendarannuel entity.
     *
     * @param Calendarannuel $calendarannuel The calendarannuel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Calendarannuel $calendarannuel)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('calend_delete', array('id' => $calendarannuel->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
