<?php


namespace ForumBundle\Security;

use ForumBundle\Entity\Question;
use schoolBundle\Entity\Users;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;

class QuestionVoter extends Voter
{

    const EDIT      = 'edit';
    const DELETE    = 'delete';

    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    protected function supports($attribute, $subject)
    {

        if (!in_array($attribute, array(self::EDIT, self::DELETE))) {
            return false;
        }

        if (!$subject instanceof Question) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof Users) {
            return false;
        }

        /* Admin can edit / delete all questions. UNLIMITED POWER !! */
        if ($this->decisionManager->decide($token, array('ROLE_PERSONNEL'))) {
            return true;
        }

        /** @var Question $question */
        $question = $subject;

        switch ($attribute) {
            case self::EDIT:
                return $this->canEdit($question, $user);
            case self::DELETE:
                return $this->canDelete($question, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canEdit(Question $question, Users $user)
    {
        return $user === $question->getUser();
    }

    private function canDelete(Question $question, Users $user)
    {
        return $user === $question->getUser();
    }
}