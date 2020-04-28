<?php
namespace ForumBundle\Service;

use ForumBundle\Entity\Reponse;
use Doctrine\Common\Persistence\ObjectManager;


class HandleVote
{

    private $em;

    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }

    public function handle(Reponse $answer, $vote) {
        $current_vote = $answer->getVoteReponse();
        $new_vote = $vote == "▲" ? ++$current_vote : --$current_vote ;
        $answer->setVoteReponse($new_vote);
        
        $this->em->persist($answer);
        $this->em->flush();
    }

}