<?php

namespace BooksBundle\Controller;

use BooksBundle\Entity\Wishliste;
use BooksBundle\Entity\Books;
use EvenementBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
/**
 * Wishliste controller.
 *
 */
class WishlisteController extends Controller
{
    /**
     * Lists all wishliste entities.
     *
     */
    public function indexAction()
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        // var_dump( $user);
        $wishlistes = $em->getRepository(Wishliste::class)->findBy(array("idetd"=>$user->getId()));


        // $book = $em->getRepository('BooksBundle:Books')->findBy(array("user"=>$user));

        return $this->render('wishliste/index.html.twig', array(
            'wishlistes' =>  $wishlistes,
        ));
    }

    /**
     * Creates a new wishliste entity.
     *
     */
    public function newAction(Request $request)
    {
        $wishliste = new Wishliste();
        $form = $this->createForm('BooksBundle\Form\WishlisteType', $wishliste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($wishliste);
            $em->flush();

            return $this->redirectToRoute('wishliste_show', array('idlist' => $wishliste->getIdlist()));
        }

        return $this->render('wishliste/new.html.twig', array(
            'wishliste' => $wishliste,
            'form' => $form->createView(),
        ));
    }
    public function addAction(Request $request,$idbook){

        $wishlist = new Wishliste();

        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository(Books::class)->find($idbook);
        $user = $this->container->get('security.token_storage')->getToken()->getUser();



        $wishlist->setIdbook($book);
        $wishlist->setIdetd($user);
        $em->persist($wishlist);
        $em->flush();
        return $this->redirectToRoute("books_index");


    }
    public function addJsonAction(Request $request){

        $wishlist = new Wishliste();

        $em = $this->getDoctrine()->getManager();

        $book = $em->getRepository(Books::class)->findOneBy(array("idbook"=>$request->get("idbook")));

        $user = $em->getRepository(\schoolBundle\Entity\Users::class)->findOneBy(array("id"=>$request->get("idetd")));




        $wishlist->setIdbook($book);
        $wishlist->setIdetd($user);
        $em->persist($wishlist);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($wishlist);
        return new JsonResponse($formatted);


    }
    public function deleteJsonAction(Request $request){



        $em = $this->getDoctrine()->getManager();

        $wishlist = $em->getRepository(Wishliste::class)->findOneBy(array("idlist"=>$request->get("idlist")));



        $em->remove($wishlist);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($wishlist);
        return new JsonResponse($formatted);


    }

    /**
     * Finds and displays a wishliste entity.
     *
     */
    public function showAction(Wishliste $wishliste)
    {

        $deleteForm = $this->createDeleteForm($wishliste);

        return $this->render('wishliste/show.html.twig', array(
            'wishliste' => $wishliste,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing wishliste entity.
     *
     */
    public function editAction(Request $request, Wishliste $wishliste)
    {
        $deleteForm = $this->createDeleteForm($wishliste);
        $editForm = $this->createForm('BooksBundle\Form\WishlisteType', $wishliste);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('wishliste_edit', array('idlist' => $wishliste->getIdlist()));
        }

        return $this->render('wishliste/edit.html.twig', array(
            'wishliste' => $wishliste,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    public function AllWishlisteAction()

    {
        $em = $this->getDoctrine()->getManager();

        $wishliste = $em->getRepository('BooksBundle:Wishliste')->findAll();


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($wishliste);
        return new JsonResponse($formatted);
    }
    /**
     * Deletes a wishliste entity.
     *
     */
    public function deleteAction(Request $request, $idbook)
    {

        $em = $this->getDoctrine()->getManager();
        $wishliste = $em->getRepository(Wishliste::class)->find($idbook);


        $em->remove($wishliste);
        $em->flush();


        return $this->redirectToRoute('books_index');
    }

    /**
     * Creates a form to delete a wishliste entity.
     *
     * @param Wishliste $wishliste The wishliste entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Wishliste $wishliste)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('wishliste_delete', array('idlist' => $wishliste->getIdlist())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
