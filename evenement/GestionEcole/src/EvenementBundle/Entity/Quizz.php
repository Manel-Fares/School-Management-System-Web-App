<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Quizz
 *
 * @ORM\Table(name="quizz", indexes={@ORM\Index(name="chapitre", columns={"chapitre"})})
 * @ORM\Entity
 */
class Quizz
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
     * @var integer
     *
     * @ORM\Column(name="chapitre", type="integer", nullable=false)
     */
    private $chapitre;


}

