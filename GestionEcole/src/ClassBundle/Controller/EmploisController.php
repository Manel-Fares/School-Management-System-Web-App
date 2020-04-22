<?php

namespace ClassBundle\Controller;

use ClassBundle\Entity\Emplois;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;

/**
 * Emplois controller.
 *
 */
class EmploisController extends Controller
{
    /**
     * Lists all emplois entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $emplois = $em->getRepository('ClassBundle:Emplois')->findAll();

        return $this->render('emplois/index.html.twig', array(
            'emplois' => $emplois,
        ));
    }

    /**
     * Creates a new emplois entity.
     *
     */
    public function newAction(Request $request)
    {
        $emplois = new Emplois();
        $form = $this->createForm('ClassBundle\Form\EmploisType', $emplois);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('source')->getData();
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();

                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {

                }

                $emplois->setSource($newFilename);

                $em = $this->getDoctrine()->getManager();
                $em->persist($emplois);
                $em->flush();

                return $this->redirectToRoute('emplo_show', array('idemplois' => $emplois->getIdemplois()));
            }
        }
        return $this->render('emplois/new.html.twig', array(
            'emplois' => $emplois,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a emplois entity.
     *
     */
    public function showAction(Emplois $emplois)
    {
        $deleteForm = $this->createDeleteForm($emplois);

        return $this->render('emplois/show.html.twig', array(
            'emplois' => $emplois,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing emplois entity.
     *
     */
    public function editAction(Request $request, Emplois $emplois)
    {
        $deleteForm = $this->createDeleteForm($emplois);
        $editForm = $this->createForm('ClassBundle\Form\EmploisType', $emplois);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('emplo_edit', array('idemplois' => $emplois->getIdemplois()));
        }

        return $this->render('emplois/edit.html.twig', array(
            'emplois' => $emplois,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a emplois entity.
     *
     */
    public function deleteAction(Request $request, Emplois $emplois)
    {
        $form = $this->createDeleteForm($emplois);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($emplois);
            $em->flush();
        }

        return $this->redirectToRoute('emplo_index');
    }

    /**
     * Creates a form to delete a emplois entity.
     *
     * @param Emplois $emplois The emplois entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Emplois $emplois)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('emplo_delete', array('idemplois' => $emplois->getIdemplois())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function deleteCAction($id){
        $em  = $this->getDoctrine()->getManager();
        $class = $em->getRepository(Emplois::class)->find($id);
        $em->remove($class);
        $em->flush();
        return $this->redirectToRoute("emplo_index");
    }
}
