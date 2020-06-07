<?php

namespace ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Reponse
 *
 * @ORM\Table(name="reponse", indexes={@ORM\Index(name="id_question", columns={"id_question"})})
 * @ORM\Entity(repositoryClass="ForumBundle\Repository\ReponseRepository")
 *
 */
class Reponse
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_reponse", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReponse;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="string", length=100, nullable=false)
     */
    private $body;

    /**
     * @var integer
     *
     * @ORM\Column(name="vote_reponse", type="integer", nullable=true)
     */
    private $voteReponse =0;
    /**
     * @var bool
     *
     * @ORM\Column(name="valid", type="boolean", options={"default":false})
     */
    private $valid = false;
    /**

     * @ORM\ManyToOne(targetEntity="ForumBundle\Entity\Question", inversedBy="answers")
     * @ORM\JoinColumn(name="id_question", referencedColumnName="id_question")
     */
    private $idQuestion;

    /**
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Users", inversedBy="answers")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var DateTime
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    public  $created_at;

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param DateTime $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return int
     */
    public function getIdReponse()
    {
        return $this->idReponse;
    }

    /**
     * @param int $idReponse
     */
    public function setIdReponse($idReponse)
    {
        $this->idReponse = $idReponse;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return int
     */
    public function getVoteReponse()
    {
        return $this->voteReponse;
    }

    /**
     * @param int $voteReponse
     */
    public function setVoteReponse($voteReponse)
    {
        $this->voteReponse = $voteReponse;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->valid;
    }

    /**
     * @param bool $valid
     */
    public function setValid($valid)
    {
        $this->valid = $valid;
    }

    /**
     * @return int
     */
    public function getIdQuestion()
    {
        return $this->idQuestion;
    }

    /**
     * @param int $idQuestion
     */
    public function setIdQuestion($idQuestion)
    {
        $this->idQuestion = $idQuestion;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }



}

