<?php

namespace ReclamationBundle\Controller;

use EvenementBundle\Entity\Users;
use ReclamationBundle\Entity\Reclamation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Reclamation controller.
 *
 */
class ReclamationController extends Controller
{
    /**
     * Lists all reclamation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $reclamations = $em->getRepository('ReclamationBundle:Reclamation')->findBy(array("idetd"=>$user->getId()));

        return $this->render('reclamation/index.html.twig', array(
            'reclamations' => $reclamations,
        ));
    }
    public function allAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        /* $query = $em->createQuery(
             'SELECT r
              FROM ReclamationBundle:Reclamation r
              WHERE r.idetd = :id
              '

         )->setParameters(array(
                 'id'=>$user->getId()
                 )
         );

         $reclamations = $query->getResult();*/
        $reclamations = $em->getRepository('ReclamationBundle:Reclamation')->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($reclamations);
        return new JsonResponse($formatted);
    }
    public function backindexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reclamations = $em->getRepository('ReclamationBundle:Reclamation')->findAll();

        return $this->render('reclamation/backindex.html.twig', array(
            'reclamations' => $reclamations,
        ));
    }
    /**
     * Creates a new reclamation entity.
     *
     */
    public function newAction(Request $request)
    { $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $reclamation = new Reclamation();

        $form = $this->createForm('ReclamationBundle\Form\ReclamationType', $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $reclamation->setStatutreclamation("en cours");
            $reclamation->setDatecreation(new \DateTime('now'));
            $reclamation->setIdetd($user);
            $em->persist($reclamation);
            $em->flush();

            return $this->redirectToRoute('reclamation_index');
        }

        /*
                if($request->isMethod('POST')) {
                    $reclamation->setSujetreclamation($request->get('titre'));
                    $reclamation->setDescriptionreclamation($request->get('description'));
                    $reclamation->setStatutreclamation("en cours");
                    $reclamation->setDatecreation(new \DateTime('now'));
                    $reclamation->setIdetd($user);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($reclamation);
                    $em->flush();

                    return $this->redirectToRoute('reclamation_index');

                }*/
        /*  return $this->render('reclamation/new.html.twig', array(
              'reclamation' => $reclamation,

          ));*/
        return $this->render('reclamation/new.html.twig', array(
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ));
    }
    public function newmobileAction(Request $request){
        $reclamation = new Reclamation();
        $em = $this->getDoctrine()->getManager();
        $reclamation->setStatutreclamation("Pending");
        $reclamation->setDatecreation(new \DateTime('now'));
        $reclamation->setSujetreclamation($request->get("sujetreclamation"));
        $reclamation->setDescriptionreclamation($request->get("descriptionreclamation"));
        $user = $em->getRepository(\schoolBundle\Entity\Users::class)->findOneBy(array("id"=>$request->get("idetd")));
        $reclamation->setIdetd($user);
        $em->persist($reclamation);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($reclamation);
        return new JsonResponse($formatted);


    }
    /**
     * Finds and displays a reclamation entity.
     *
     */
    public function showAction(Reclamation $reclamation)
    {
        $deleteForm = $this->createDeleteForm($reclamation);

        return $this->render('reclamation/show.html.twig', array(
            'reclamation' => $reclamation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reclamation entity.
     *
     */
    public function editAction(Request $request, Reclamation $reclamation)
    {
        $deleteForm = $this->createDeleteForm($reclamation);
        $editForm = $this->createForm('ReclamationBundle\Form\ReclamationType', $reclamation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reclamation_edit', array('idreclamation' => $reclamation->getIdreclamation()));
        }

        return $this->render('reclamation/edit.html.twig', array(
            'reclamation' => $reclamation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reclamation entity.
     *
     */
    public function deleteAction($idreclamation)
    {

        $em  = $this->getDoctrine()->getManager();
        $reclamation = $em->getRepository(Reclamation::class)->find($idreclamation);
        $em->remove($reclamation);
        $em->flush();

        return $this->redirectToRoute('reclamation_index');
    }

    /**
     * Creates a form to delete a reclamation entity.
     *
     * @param Reclamation $reclamation The reclamation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reclamation $reclamation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reclamation_delete', array('idreclamation' => $reclamation->getIdreclamation())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
    public function sendEmailAction($idreclamation, \Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('sofien.argoubi@esprit.tn')
            ->setTo('argoubisofien07@gmail.com')
            ->setBody('You should see me from the profiler!')
        ;

        $mailer->send($message);
        return $this->redirectToRoute('reclamation_backindex');
        // ...
    }
    public function editStatusAction(Request $request, $idreclamation)
    {
        $em = $this->getDoctrine()->getManager();

        $reclamations = $em->getRepository('ReclamationBundle:Reclamation')->find($idreclamation);

        $reclamations->setStatutreclamation("Traité");
        $em->persist($reclamations);
        $em->flush();

        return $this->redirectToRoute('reclamation_backindex');

    }
}
