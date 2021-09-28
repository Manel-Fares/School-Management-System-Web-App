<?php

namespace SubjectsBundle\Controller;

use SubjectsBundle\Entity\Chapters;
use SubjectsBundle\Entity\Quiz;
use SubjectsBundle\Form\QuizType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class quizController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $quizzs = $em->getRepository('Subjects:Quiz')->findAll();

        return $this->render('Subjects/index.html.twig', array(
            'quizzs' => $quizzs,
        ));
    }
    public function addAction(Request $request,$id)
    {
        $quiz = new Quiz();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $quiz->setChapitre($em->getRepository(Chapters::class)->find($id));
            //    var_dump($quiz->getChapitre());
            //    die();
            $em->persist($quiz);
            $em->flush();
            return $this->redirectToRoute('Quiz_affich',array('id'=>$id));
        }
        return $this->render("@Subjects/quiz/add.html.twig", array(
            'form' => $form->createView()

        ));
    }

    public function affichAction($id){
        $em = $this->getDoctrine()->getManager();
        $quiz = $em->getRepository(Quiz::class)->findByChapitre($id);
        return $this->render('@Subjects/quiz/listq.html.twig',array('quiz'=>$quiz));
    }

    public function affichadminAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $quiz = $em->getRepository(Quiz::class)->findByChapitre($id);
        return $this->render('@Subjects/quiz/listqadmin.html.twig',array('quiz'=>$quiz));
    }

    public function affichensAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $quiz = $em->getRepository(Quiz::class)->findByChapitre($id);
        return $this->render('@Subjects/quiz/listq.html.twig',array('quiz'=>$quiz));
    }
    public function suppAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $quiz=$em->getRepository(Quiz::class)->find($id);
        $em->remove($quiz);
        $em->flush();
        return $this->redirectToRoute('Quiz_affich');
    }
}
