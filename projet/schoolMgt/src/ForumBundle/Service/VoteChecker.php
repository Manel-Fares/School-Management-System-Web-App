<?php
namespace ForumBundle\Service;

use ForumBundle\Entity\Reponse;
use FOS\UserBundle\Model\UserInterface;

class VoteChecker 
{

    public function check(Reponse $answer, UserInterface $user)
    {
        return $answer->getUser() != $user;
    }

}