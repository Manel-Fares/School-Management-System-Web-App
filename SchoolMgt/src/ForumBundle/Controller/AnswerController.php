<?php

namespace ForumBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use ForumBundle\Entity\Reponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use ForumBundle\Service\HandleVote;
use ForumBundle\Service\VoteChecker;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
class AnswerController extends Controller
{
    /**
     * @Route("/answer/{id}/edit", name="edit_answer")
     * @Method({"GET", "POST"})
     * @ParamConverter("answer", class="ForumBundle:Reponse")
     */
    public function editAnswerAction(Request $request, Reponse $answer)
    {$em=$this->getDoctrine()->getManager();
        $edit_answer_form = $this->createForm('ForumBundle\Form\ReponseType', $answer);
        $edit_answer_form->handleRequest($request);

        if ($edit_answer_form->isSubmitted() && $edit_answer_form->isValid()) {
            $em->flush();

            $this->addFlash('success', 'Answer edited');
            return $this->redirectToRoute('view_question', array('id' => $answer->getIdQuestion()->getIdQuestion()));
        }

        return $this->render('ForumBundle::answer/edit_answer.html.twig', [
            'answer'            => $answer,
            'edit_answer_form'  => $edit_answer_form->createView(),
        ]);
    }

    /**
     * @Route("/answer/{id}/delete", name="delete_answer")

     * @ParamConverter("answer", class="ForumBundle:Reponse")
     */
    public function deleteAnswerAction( $id, Reponse $answer)
    {$em=$this->getDoctrine()->getManager();
        $rep = $this->getDoctrine()->getRepository('ForumBundle:Reponse');
        $answer = $rep->find($id);

        $question_id = $answer->getIdQuestion()->getIdQuestion();

        $em->remove($answer);
        $em->flush();

        $this->addFlash('success', 'Answer deleted');

        return $this->redirectToRoute('view_question', [
            'id' => $question_id,
        ]);
    }

    /**
     * @Route("/answer/{id}/vote/{vote}", name="answer_vote", requirements={"vote": "▲|▼"})
     * @Security("has_role('ROLE_ETUDIANT') or has_role('ROLE_ENSEIGNIANT') or has_role('ROLE_PERSONNEL')")
     * @ParamConverter("answer", class="ForumBundle:Reponse")
     */
    public function voteAction(Reponse $answer,$vote,$id)
    {

        $em =$this->getDoctrine()->getManager();
        $voteHandler=new HandleVote($em) ;
        $checker=new VoteChecker() ;
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        if ($checker->check($answer, $user)) {
            $voteHandler->handle($answer, $vote);
        } else {
            $this->addFlash(
                'error',
                'You can\'t vote for your own answer'
            );
        }

        return $this->redirectToRoute('view_question', [
            'id' => $answer->getIdQuestion()->getIdQuestion(),
        ]);
    }


}
