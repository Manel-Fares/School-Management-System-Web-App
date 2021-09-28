<?php

namespace ClassBundle\Controller;

use ClassBundle\Entity\Events;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Event controller.
 *
 */
class EventsController extends Controller
{
    /**
     * Lists all event entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('ClassBundle:Events')->findAll();

        return $this->render('events/index.html.twig', array(
            'events' => $events,
        ));
    }

    /**
     * Finds and displays a event entity.
     *
     */

    public function LoadAction()
    {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('ClassBundle:Events')->findAll();
        return $this->render('events/updatesAjax.html.twig', array(
            'events' => $events,
        ));
    }

    public function AddAction(Request $request)
    {
        $title= $request->get('title');
        $start= $request->get('start');
        $end= $request->get('end');
        $events= new Events();
        $events->setTitle($title);
        $events->setStartEvent(new \DateTime($start));
        $events->setEndEvent(new \DateTime($end));
        $em = $this->getDoctrine()->getManager();
        $em->persist($events);
        $em->flush();
        return $this->render('events/updatesAjax.html.twig', array(
            'events' => $events,
        ));
    }
    public function UpdateAction(Request $request)
    {
        $id= $request->get('id');
        $events= $this->getDoctrine()->getManager()->getRepository('ClassBundle:Events')->find($id+0);
        $title= $request->get('title');
        $start= $request->get('start');
        $end= $request->get('end');
        $events->setTitle($title);
        $events->setStartEvent(new \DateTime($start));
        $events->setEndEvent(new \DateTime($end));
        $em = $this->getDoctrine()->getManager();
        $em->persist($events);
        $em->flush();
        return $this->render('events/updatesAjax.html.twig', array(
            'events' => $events,
        ));
    }
    public function DeleteAction(Request $request)
    {
        $id= $request->get('id');
        $events= $this->getDoctrine()->getManager()->getRepository('ClassBundle:Events')->find($id+0);
        $em = $this->getDoctrine()->getManager();
        $em->remove($events);
        $em->flush();
        return $this->render('events/updatesAjax.html.twig', array(
            'events' => $events,
        ));
    }

}
