<?php

namespace BooksBundle\Controller;

use BooksBundle\Entity\Books;
use BooksBundle\Entity\Likes;
use EvenementBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Like controller.
 *
 */
class LikesController extends Controller
{
    /**
     * Lists all like entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $likes = $em->getRepository('BooksBundle:Likes')->findAll();

        return $this->render('likes/index.html.twig', array(
            'likes' => $likes,
        ));
    }
    public function AllLikeAction()

    {
        $em = $this->getDoctrine()->getManager();
        //  $user = $this->container->get('security.token_storage')->getToken()->getUser();


        $Likes= $em->getRepository('BooksBundle:Likes')->findAll();
        //  $wishliste = $em->getRepository('BooksBundle:Wishliste')->findBy(array("idetd"=>$user->getId()));

        //$books = $em->getRepository('BooksBundle:Books')->findAll();
        //  $bookscategorie = $em->getRepository('BooksBundle:Books')->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Likes);
        return new JsonResponse($formatted);
    }

    /**
     * Creates a new like entity.
     *
     */
    public function newAction(Request $request)
    {
        $like = new Like();
        $form = $this->createForm('BooksBundle\Form\LikesType', $like);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($like);
            $em->flush();

            return $this->redirectToRoute('likes_show', array('idlike' => $like->getIdlike()));
        }

        return $this->render('likes/new.html.twig', array(
            'like' => $like,
            'form' => $form->createView(),
        ));
    }
    public function newLikeAction(Request $request){
        $likes = new Likes();
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository(Books::class)->findOneBy(array("idbook"=>$request->get("idbook")));


        $user = $em->getRepository(\schoolBundle\Entity\Users::class)->findOneBy(array("id"=>$request->get("idetd")));



        $book->setNbrLike($book->getNbrLike()+1);
        $em->persist($book);
        $em->flush();
        $likes->setIdbook($book);
        $likes->setIdetd($user);

        $em->persist( $likes);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($likes);
        return new JsonResponse($formatted);
    }
    public function deleteLikeJsonAction(Request $request){


        $em = $this->getDoctrine()->getManager();
        $Likes = $em->getRepository(Likes::class)->findOneBy(array("idlike"=>$request->get("idlike")));
        $book = $em->getRepository(Books::class)->findOneBy(array("idbook"=>$Likes->getIdbook()));


        if($book->getNbrLike()>0)
            $book->setNbrLike($book->getNbrLike()-1);
        $em->persist($book);


        $em->remove($Likes);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Likes);
        return new JsonResponse($formatted);
    }
    public function addAction($idbook){

        $likes = new Likes();

        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository(Books::class)->find($idbook);
        $user = $this->container->get('security.token_storage')->getToken()->getUser();


        $book->setNbrLike($book->getNbrLike()+1);
        $em->persist($book);
        $em->flush();
        $likes->setIdbook($book);
        $likes->setIdetd($user);

        $em->persist( $likes);
        $em->flush();
        return $this->redirectToRoute("books_index");


    }

    /**
     * Finds and displays a like entity.
     *
     */
    public function showAction(Likes $like)
    {
        $deleteForm = $this->createDeleteForm($like);

        return $this->render('likes/show.html.twig', array(
            'like' => $like,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing like entity.
     *
     */
    public function editAction(Request $request, Likes $like)
    {
        $deleteForm = $this->createDeleteForm($like);
        $editForm = $this->createForm('BooksBundle\Form\LikesType', $like);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('likes_edit', array('idlike' => $like->getIdlike()));
        }

        return $this->render('likes/edit.html.twig', array(
            'like' => $like,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a like entity.
     *
     */
    public function deleteLikeAction(Request $request, $idlike)
    {

        $em = $this->getDoctrine()->getManager();
        $Likes = $em->getRepository(Likes::class)->find($idlike);
        $book = $em->getRepository(Books::class)->findOneBy(array("idbook"=>$Likes->getIdbook()));


        if($book->getNbrLike()>0)
            $book->setNbrLike($book->getNbrLike()-1);
        $em->persist($book);


        $em->remove($Likes);
        $em->flush();


        return $this->redirectToRoute('books_index');
    }
    public function deleteAction(Request $request, Likes $like)
    {
        $form = $this->createDeleteForm($like);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($like);
            $em->flush();
        }

        return $this->redirectToRoute('likes_index');
    }

    /**
     * Creates a form to delete a like entity.
     *
     * @param Likes $like The like entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Likes $like)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('likes_delete', array('idlike' => $like->getIdlike())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
