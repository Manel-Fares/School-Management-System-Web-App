<?php

namespace ForumBundle\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\Paginator;
use ForumBundle\Entity\Question;
use ForumBundle\Entity\Reponse;
use ForumBundle\Form\QuestionType;
use ForumBundle\Form\ReponseType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class QuestionController extends Controller
{
    /**
     * @Route("/questions/", name="view_questions")
     */
    public function viewQuestionsAction(Request $request)
    { $em=$this->getDoctrine()->getManager();

        $paginator = $this->get('knp_paginator');
        $dql = "SELECT q FROM ForumBundle:Question q ORDER BY q.created_at DESC";
        $query =$em->createQuery($dql);

        $search=$request->get('search');

        if($request->isMethod('post'))
        {
            $dql="SELECT q FROM ForumBundle:Question q WHERE  q.title like :key or q.body like :key ORDER BY q.created_at DESC ";
            $query=$em->createQuery($dql)->setParameter('key','%'.$search.'%');

        }
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('ForumBundle::question/view_questions.html.twig',[
            'pagination'  => $pagination,
        ]);
    }

    /**
     * @Route("/question/{id}", name="view_question")
     * @ParamConverter("question", class="ForumBundle:Question")
     */
    public function viewQuestionAction(Question $question, Request $request)
    { $em=$this->getDoctrine()->getManager();
        $filter=array("red","green","blue");
        $form = $this->createForm(ReponseType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
                $this->addFlash('error', 'You must be connected to answer');
                return $this->redirectToRoute('view_question', ['id' => $question->getIdQuestion()]);
            } else {

                $answer = $form->getData();
                $answer->setUser($this->getUser());
                $time =  new \DateTime();
                $answer->setCreatedAt($time);
                $answer->setIdQuestion($question);
                $em->persist($answer);
                $em->flush();

                $this->addFlash('success', 'Your answer has been submitted');

                return $this->redirectToRoute('view_question', [
                    'id' => $question->getIdQuestion(),
                ]);
            }
        }



            if ($question->getBody()) {

                foreach ($filter as $var){
                    $question->setBody(str_replace($var, "*****", $question->getBody()));
                }
            }
        foreach ($question->getAnswers() as $i){
            if ($i->getBody()) {

                foreach ($filter as $var){
                    $i->setBody(str_replace($var, "*****", $i->getBody()));
                }}
        }
        return $this->render('ForumBundle::question/view_question.html.twig', [
            'question'      => $question,
            'form'          => $form->createView(),
        ]);
    }

    /**
     * @Route("/add/question", name="add_question")
     * @Security("has_role('ROLE_ETUDIANT') or has_role('ROLE_ENSEIGNIANT')")
     */
    public function addQuestionAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $add_question_form = $this->createForm(QuestionType::class);
        $add_question_form->handleRequest($request);

        if ($add_question_form->isSubmitted() && $add_question_form->isValid()) {
            $time =  new \DateTime();

            $question = $add_question_form->getData();
            $question->setUser($this->getUser());
            $question->setCreatedAt($time);
            $em->persist($question);
            $em->flush();

            $this->addFlash('success', 'Your question has been submitted');

            return $this->redirectToRoute('view_questions');
        }

        return $this->render('ForumBundle::question/add_question.html.twig', [
            'add_question_form' => $add_question_form->createView(),
        ]);
    }

    /**
     * @Route("/question/{id}/edit", name="edit_question")
     * @Method({"GET", "POST"})

     * @ParamConverter("question", class="ForumBundle:Question")
     */
    public function editQuestionAction(Request $request, Question $question)
    {$em=$this->getDoctrine()->getManager();
        $edit_question_form = $this->createForm('ForumBundle\Form\QuestionType', $question);
        $edit_question_form->handleRequest($request);

        if ($edit_question_form->isSubmitted() && $edit_question_form->isValid()) {
            $em->flush();

            $this->addFlash('success', 'Question edited');
            return $this->redirectToRoute('view_question', array('id' => $question->getIdQuestion()));
        }

        return $this->render('ForumBundle::question/edit_question.html.twig', [
            'question'              => $question,
            'edit_question_form'    => $edit_question_form->createView(),
        ]);
    }

    /**
     * @Route("/question/{id}/delete", name="delete_question")
     * @Security("has_role('ROLE_PERSONNEL')")
     * @ParamConverter("question", class="ForumBundle:Question")
     */
    public function deleteQuestionAction( $id, Question $question)
    {
        $em=$this->getDoctrine()->getManager();
        $rep = $this->getDoctrine()->getRepository('ForumBundle:Question');
        $question = $rep->find($id);

        $em->remove($question);
        $em->flush();

        $this->addFlash('success', 'Question deleted');
        return $this->redirectToRoute('view_questions');
    }

}
