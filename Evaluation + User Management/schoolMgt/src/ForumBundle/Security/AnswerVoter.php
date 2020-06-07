<?php

namespace ForumBundle\Security;

use ForumBundle\Entity\Reponse;
use schoolBundle\Entity\Users;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;

class AnswerVoter extends Voter
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

        if (!$subject instanceof Reponse) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof Users ) {
            return false;
        }

        /* Admin can edit / delete all answers. UNLIMITED POWER !! */
        if ($this->decisionManager->decide($token, array('ROLE_PERSONNEL'))) {
            return true;
        }

        /** @var Reponse $Reponses */
        $Reponses = $subject;

        switch ($attribute) {
            case self::EDIT:
                return $this->canEdit($Reponses, $user);
            case self::DELETE:
                return $this->canDelete($Reponses, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canEdit(Reponse $answer, Users $user)
    {
        return $user === $answer->getUser();
    }

    private function canDelete(Reponse $answer, Users $user)
    {
        return $user === $answer->getUser();
    }
}