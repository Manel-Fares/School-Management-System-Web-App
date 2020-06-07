<?php

namespace BooksBundle\Controller;

use BooksBundle\Entity\Reservationbook;
use BooksBundle\Entity\Books;
use EvenementBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
/**
 * Reservationbook controller.
 *
 */
class ReservationbookController extends Controller
{
    /**
     * Lists all reservationbook entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reservationbooks = $em->getRepository('BooksBundle:Reservationbook')->findAll();

        return $this->render('reservationbook/index.html.twig', array(
            'reservationbooks' => $reservationbooks,
        ));
    }
    public function AllBookingAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reservationbooks = $em->getRepository('BooksBundle:Reservationbook')->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($reservationbooks);
        return new JsonResponse($formatted);
    }

    /**
     * Creates a new reservationbook entity.
     *
     */
    public function newAction(Request $request)
    {
        $reservationbook = new Reservationbook();
        $form = $this->createForm('BooksBundle\Form\ReservationbookType', $reservationbook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservationbook);
            $em->flush();

            return $this->redirectToRoute('reservationbook_show', array('idreservation' => $reservationbook->getIdreservation()));
        }

        return $this->render('reservationbook/new.html.twig', array(
            'reservationbook' => $reservationbook,
            'form' => $form->createView(),
        ));
    }
    public function addAction(Request $request,$idbook){
        $book = new Books();
        $Reservation = new Reservationbook();

        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository(Books::class)->find($idbook);
        $user = $this->container->get('security.token_storage')->getToken()->getUser();



        $Reservation->setIdbook($book);
        $Reservation->setIdetd($user);
        $Reservation->setDated(new \DateTime('now'));
        $Reservation->setDatef(new \DateTime('now'));
        $em->persist( $Reservation);
        $em->flush();
        return $this->redirectToRoute("reservationbook_index");


    }
    public function addBookingJSonAction(Request $request){

        $Reservation = new Reservationbook();

        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository(Books::class)->find(array("idbook"=>$request->get("idbook")));
        $user = $em->getRepository(\schoolBundle\Entity\Users::class)->findOneBy(array("id"=>$request->get("idetd")));




        $Reservation->setIdbook($book);
        $Reservation->setIdetd($user);
        $Reservation->setDated(new \DateTime('now'));
        $Reservation->setDatef(new \DateTime('now'));
        $em->persist($Reservation);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Reservation);
        return new JsonResponse($formatted);


    }
    /**
     * Finds and displays a reservationbook entity.
     *
     */
    public function showAction(Reservationbook $reservationbook)
    {
        $deleteForm = $this->createDeleteForm($reservationbook);

        return $this->render('reservationbook/show.html.twig', array(
            'reservationbook' => $reservationbook,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reservationbook entity.
     *
     */
    public function editAction(Request $request, Reservationbook $reservationbook)
    {
        $deleteForm = $this->createDeleteForm($reservationbook);
        $editForm = $this->createForm('BooksBundle\Form\ReservationbookType', $reservationbook);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservationbook_edit', array('idreservation' => $reservationbook->getIdreservation()));
        }

        return $this->render('reservationbook/edit.html.twig', array(
            'reservationbook' => $reservationbook,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    public function deleteReservationAction(Request $request,$idreservation)
    {
        $em = $this->getDoctrine()->getManager();
        $reservationbook=$em->getRepository('BooksBundle:Reservationbook')->find($idreservation);

        $em->remove($reservationbook);
        $em->flush();


        return $this->redirectToRoute('reservationbook_index');
    }
    public function deleteBookingJsonAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $reservationbook=$em->getRepository('BooksBundle:Reservationbook')->findOneBy(array("idreservation"=>$request->get('idBooking')));

        $em->remove($reservationbook);
        $em->flush();


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($reservationbook);
        return new JsonResponse($formatted);
    }
    /**
     * Deletes a reservationbook entity.
     *
     */
    public function deleteAction(Request $request, Reservationbook $reservationbook)
    {
        $form = $this->createDeleteForm($reservationbook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservationbook);
            $em->flush();
        }

        return $this->redirectToRoute('reservationbook_index');
    }

    /**
     * Creates a form to delete a reservationbook entity.
     *
     * @param Reservationbook $reservationbook The reservationbook entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reservationbook $reservationbook)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservationbook_delete', array('idreservation' => $reservationbook->getIdreservation())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
