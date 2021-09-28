<?php

namespace SubjectsBundle\Controller;

use SubjectsBundle\Entity\QQuiz;
use SubjectsBundle\Entity\Quiz;
use SubjectsBundle\Form\QQuizType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class qquizController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $questionquizzs = $em->getRepository(QQuiz::class)->findAll();

        return $this->render('Subjects/index.html.twig', array(
            'questionquizzs' => $questionquizzs,
        ));
    }

    public function addAction(Request $request,$id)
    {
        $qq = new QQuiz();
        $form = $this->createForm(QQuizType::class, $qq);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $qq->setQuiz($em->getRepository(Quiz::class)->find($id));
            $em->persist($qq);
            $em->flush();

            return $this->redirectToRoute('QQuiz_affich_ens',array('id'=>$id));
        }

        return $this->render("@Subjects/qquiz/add.html.twig", array(
            'form' => $form->createView()
        ));
    }

    public function affichensAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $qq = $em->getRepository(QQuiz::class)->findByQuiz($id);
        return $this->render('@Subjects/qquiz/listqq.html.twig',array('qquiz'=>$qq));
    }
    public function suppAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $qq=$em->getRepository(QQuiz::class)->find($id);
        $em->remove($qq);
        $em->flush();
        return $this->redirectToRoute('QQuiz_affich_ens');
    }
}