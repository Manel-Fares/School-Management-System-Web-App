<?php

namespace schoolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Note
 *
 * @ORM\Table(name="note", indexes={@ORM\Index(name="idEnseignant", columns={"idEnseignant"}), @ORM\Index(name="idMatiere", columns={"idMatiere"})})
 * @ORM\Entity
 */
class Note
{
    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Users")
     * @ORM\Column(name="idEtudiant", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $etudiant;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Matier")
     * @ORM\Column(name="idMatiere", type="string", length=50, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $matiere;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Users")
     * @ORM\Column(name="idEnseignant", type="integer", nullable=true)
     */
    private $enseignant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNote", type="date", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $datenote;

    /**
     * @var float
     *
     * @ORM\Column(name="noteCC", type="float", precision=10, scale=0, nullable=true)
     */
    private $notecc;

    /**
     * @var float
     *
     * @ORM\Column(name="noteDS", type="float", precision=10, scale=0, nullable=true)
     */
    private $noteds;

    /**
     * @var float
     *
     * @ORM\Column(name="noteExam", type="float", precision=10, scale=0, nullable=true)
     */
    private $noteexam;

    /**
     * @var float
     *
     * @ORM\Column(name="Moyenne", type="float", precision=10, scale=0, nullable=true)
     */
    private $moyenne;


}

