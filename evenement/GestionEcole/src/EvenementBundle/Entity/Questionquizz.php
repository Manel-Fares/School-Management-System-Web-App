<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Questionquizz
 *
 * @ORM\Table(name="questionquizz", indexes={@ORM\Index(name="quiz", columns={"quiz"})})
 * @ORM\Entity
 */
class Questionquizz
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255, nullable=false)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="rep1", type="string", length=255, nullable=false)
     */
    private $rep1;

    /**
     * @var string
     *
     * @ORM\Column(name="rep2", type="string", length=255, nullable=false)
     */
    private $rep2;

    /**
     * @var string
     *
     * @ORM\Column(name="rep3", type="string", length=255, nullable=false)
     */
    private $rep3;

    /**
     * @var string
     *
     * @ORM\Column(name="rep", type="string", length=255, nullable=false)
     */
    private $rep;

    /**
     * @var integer
     *
     * @ORM\Column(name="quiz", type="integer", nullable=true)
     */
    private $quiz = 'NULL';


}

