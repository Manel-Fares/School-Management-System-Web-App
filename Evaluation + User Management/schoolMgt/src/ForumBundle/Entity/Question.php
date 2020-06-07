<?php

namespace ForumBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Question
 *
 * @ORM\Table(name="question", indexes={@ORM\Index(name="user", columns={"user_id"}), @ORM\Index(name="tag", columns={"tag_id"})})
 * @ORM\Entity
 */
class Question
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_question", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idQuestion;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="string", length=100, nullable=false)
     */
    private $body;





    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=200, nullable=false)
     */
    private $title;


    /**
     * @ORM\OneToMany(targetEntity="ForumBundle\Entity\Reponse", mappedBy="idQuestion", cascade={"remove"})
     */
    private $answers;
    /**
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Users", inversedBy="answers")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="ForumBundle\Entity\Tag")
     * @ORM\JoinColumn(name="tag_id", referencedColumnName="id_tag")
     */
    private $tag=null;
    /**
     * @var boolean
     * @ORM\Column(name="open", type="boolean")
     */
    private $open=true;
    /**
     * @var DateTime
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    public $created_at;
    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->tag =null;
    }
    public function addAnswer(Reponse $answer)
    {
        $this->answers[] = $answer;

        return $this;
    }


    public function removeAnswer(Reponse $answer)
    {
        $this->answers->removeElement($answer);
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
    public function getVoteQuestion()
    {
        return $this->voteQuestion;
    }

    /**
     * @param int $voteQuestion
     */
    public function setVoteQuestion($voteQuestion)
    {
        $this->voteQuestion = $voteQuestion;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return ArrayCollection
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @param ArrayCollection $answers
     */
    public function setAnswers($answers)
    {
        $this->answers = $answers;
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

    /**
     * @return ArrayCollection
     */
    public function getTag()
    {
        return $this->tag;
    }


    public function setTag($tags)
    {
        foreach ($tags as $tag) {
            $this->add($tag);
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function isOpen()
    {
        return $this->open;
    }

    /**
     * @param bool $open
     */
    public function setOpen($open)
    {
        $this->open = $open;
    }


}

