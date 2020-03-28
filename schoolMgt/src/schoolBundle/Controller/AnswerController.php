<?php

namespace ToturatBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use ToturatBundle\Entity\Answer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use ToturatBundle\Service\HandleVote;
use ToturatBundle\Service\VoteChecker;

class
AnswerController extends Controller
{
    

    /**
     * @Route("/answer/{id}/delete", name="delete_answer")
     * @Security("is_granted('delete', answer)")
     * @ParamConverter("answer", class="ToturatBundle:Answer")
     */
    public function deleteAnswerAction(ObjectManager $em, $id, Answer $answer)
    {
        $rep = $this->getDoctrine()->getRepository('ToturatBundle:Answer');
        $answer = $rep->find($id);

        $question_id = $answer->getQuestion()->getId();

        $em->remove($answer);
        $em->flush();

        $this->addFlash('success', 'Answer deleted');

        return $this->redirectToRoute('view_question', [
            'id' => $question_id,
        ]);
    }

    


}
