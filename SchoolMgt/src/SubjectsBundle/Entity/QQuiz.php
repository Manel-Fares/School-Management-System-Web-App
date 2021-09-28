<?php

namespace SubjectsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QQuiz
 *
 * @ORM\Table(name="questionquiz")
 * @ORM\Entity(repositoryClass="SubjectsBundle\Repository\QQuizRepository")
 */
class QQuiz
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="ans1", type="string", length=255)
     */
    private $ans1;

    /**
     * @var string
     *
     * @ORM\Column(name="ans2", type="string", length=255)
     */
    private $ans2;

    /**
     * @var string
     *
     * @ORM\Column(name="ans3", type="string", length=255)
     */
    private $ans3;

    /**
     * @var string
     *
     * @ORM\Column(name="cans", type="string", length=255)
     */
    private $cans;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Quiz"
     * )
     * @ORM\JoinColumn(
     *      name="quiz",
     *      referencedColumnName="id",
     *      onDelete="CASCADE",
     *      nullable=false
     * )
     */
    private $quiz;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param string $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }
    /**
     * Set ans1
     *
     * @param string $ans1
     *
     * @return QQuiz
     */
    public function setAns1($ans1)
    {
        $this->ans1 = $ans1;

        return $this;
    }

    /**
     * Get ans1
     *
     * @return string
     */
    public function getAns1()
    {
        return $this->ans1;
    }

    /**
     * Set ans2
     *
     * @param string $ans2
     *
     * @return QQuiz
     */
    public function setAns2($ans2)
    {
        $this->ans2 = $ans2;

        return $this;
    }

    /**
     * Get ans2
     *
     * @return string
     */
    public function getAns2()
    {
        return $this->ans2;
    }

    /**
     * Set ans3
     *
     * @param string $ans3
     *
     * @return QQuiz
     */
    public function setAns3($ans3)
    {
        $this->ans3 = $ans3;

        return $this;
    }

    /**
     * Get ans3
     *
     * @return string
     */
    public function getAns3()
    {
        return $this->ans3;
    }

    /**
     * Set cans
     *
     * @param string $cans
     *
     * @return QQuiz
     */
    public function setCans($cans)
    {
        $this->cans = $cans;

        return $this;
    }

    /**
     * Get cans
     *
     * @return string
     */
    public function getCans()
    {
        return $this->cans;
    }

    /**
     * Set quiz
     *
     * @param integer $quiz
     *
     * @return QQuiz
     */
    public function setQuiz($quiz)
    {
        $this->quiz = $quiz;

        return $this;
    }

    /**
     * Get quiz
     *
     * @return int
     */
    public function getQuiz()
    {
        return $this->quiz;
    }
}

