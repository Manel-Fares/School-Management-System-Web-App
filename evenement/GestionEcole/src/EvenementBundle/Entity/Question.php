<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question", indexes={@ORM\Index(name="id_personne", columns={"id_personne"}), @ORM\Index(name="id_tag", columns={"id_tag"})})
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
     * @var integer
     *
     * @ORM\Column(name="vote_question", type="integer", nullable=true)
     */
    private $voteQuestion = 'NULL';

    /**
     * @var integer
     *
     * @ORM\Column(name="id_tag", type="integer", nullable=true)
     */
    private $idTag = 'NULL';

    /**
     * @var integer
     *
     * @ORM\Column(name="id_personne", type="integer", nullable=true)
     */
    private $idPersonne = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=200, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="tag_name", type="string", length=200, nullable=false)
     */
    private $tagName;


}

