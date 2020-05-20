<?php

namespace BooksBundle\Controller;

use BooksBundle\Entity\Books;
use BooksBundle\Entity\Likes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
