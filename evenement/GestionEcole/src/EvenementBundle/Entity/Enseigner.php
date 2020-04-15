<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enseigner
 *
 * @ORM\Table(name="enseigner", indexes={@ORM\Index(name="AAAAAAAAAAAA", columns={"idMatiere"})})
 * @ORM\Entity
 */
class Enseigner
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idEnseignant", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idenseignant;

    /**
     * @var integer
     *
     * @ORM\Column(name="idMatiere", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idmatiere;


}

