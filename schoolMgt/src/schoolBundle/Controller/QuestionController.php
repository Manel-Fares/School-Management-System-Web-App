<?php

namespace ToturatBundle\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\Paginator;
use ToturatBundle\Entity\Question;
use ToturatBundle\Entity\Answer;
use ToturatBundle\Form\QuestionType;
use ToturatBundle\Form\AnswerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class QuestionController extends Controller
{
    

    /**
     * @Route("/question/{id}", name="view_question")
     * @ParamConverter("question", class="ToturatBundle:Question")
     */
    public function viewQuestionAction(Question $question, Request $request, ObjectManager $em)
    {

        $form = $this->createForm(AnswerType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
                $this->addFlash('error', 'You must be connected to answer');
                return $this->redirectToRoute('view_question', ['id' => $question->getId()]);
            } else {

                $answer = $form->getData();
                $answer->setUser($this->getUser());
                $time =  new \DateTime();
                $answer->setCreatedAt($time);
                $answer->setQuestion($question);
                $em->persist($answer);
                $em->flush();

                $this->addFlash('success', 'Your answer has been submitted');

                return $this->redirectToRoute('view_question', [
                    'id' => $question->getId(),
                ]);
            }
        }

        return $this->render('ToturatBundle::question/view_question.html.twig', [
            'question'      => $question,
            'form'          => $form->createView(),
        ]);
    }

    /**
     * @Route("/add/question", name="add_question")
     * @Security("has_role('ROLE_USER')")
     */
    public function addQuestionAction(Request $request, EntityManagerInterface $em)
    {
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

        return $this->render('ToturatBundle::question/add_question.html.twig', [
            'add_question_form' => $add_question_form->createView(),
        ]);
    }

    

    /**
     * @Route("/question/{id}/delete", name="delete_question")
     * @Security("is_granted('delete', question)")
     * @ParamConverter("question", class="ToturatBundle:Question")
     */
    public function deleteQuestionAction(ObjectManager $em, $id, Question $question)
    {

        $rep = $this->getDoctrine()->getRepository('ToturatBundle:Question');
        $question = $rep->find($id);

        $em->remove($question);
        $em->flush();

        $this->addFlash('success', 'Question deleted');
        return $this->redirectToRoute('view_questions');
    }
}
