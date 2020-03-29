<?php

namespace schoolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Note
 *
 * @ORM\Table(name="note", indexes={@ORM\Index(name="idEtudiant", columns={"idEtudiant"}),@ORM\Index(name="idEnseignant", columns={"idEnseignant"}), @ORM\Index(name="idMatiere", columns={"idMatiere"})})
 * @ORM\Entity
 */
class Note
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(name="idEtudiant", type="integer", nullable=false)
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Users")
     * @ORM\JoinColumn(name="idEtudiant",referencedColumnName="id")
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $etudiant;

    /**
     * @var integer
     * @ORM\Column(name="idMatiere", type="integer", nullable=false)
     *
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Matier")
     * @ORM\JoinColumn(name="idMatiere",referencedColumnName="id")
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $matiere;

    /**
     * @var integer
     * @ORM\Column(name="idEnseignant", type="integer", nullable=true)
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Users")
     * @ORM\JoinColumn(name="idEnseignant",referencedColumnName="id")
     *
     */
    private $enseignant;

    /**
     * @var \DateTime
     * @ORM\Column(name="dateNote", type="date", nullable=false)
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

    /**
     * @return int
     */
    public function getEtudiant()
    {
        return $this->etudiant;
    }

    /**
     * @param int $etudiant
     */
    public function setEtudiant($etudiant)
    {
        $this->etudiant = $etudiant;
    }

    /**
     * @return string
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * @param string $matiere
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;
    }

    /**
     * @return int
     */
    public function getEnseignant()
    {
        return $this->enseignant;
    }

    /**
     * @param int $enseignant
     */
    public function setEnseignant($enseignant)
    {
        $this->enseignant = $enseignant;
    }

    /**
     * @return \DateTime
     */
    public function getDatenote()
    {
        return $this->datenote;
    }

    /**
     * @param \DateTime $datenote
     */
    public function setDatenote($datenote)
    {
        $this->datenote = $datenote;
    }

    /**
     * @return float
     */
    public function getNotecc()
    {
        return $this->notecc;
    }

    /**
     * @param float $notecc
     */
    public function setNotecc($notecc)
    {
        $this->notecc = $notecc;
    }

    /**
     * @return float
     */
    public function getNoteds()
    {
        return $this->noteds;
    }

    /**
     * @param float $noteds
     */
    public function setNoteds($noteds)
    {
        $this->noteds = $noteds;
    }

    /**
     * @return float
     */
    public function getNoteexam()
    {
        return $this->noteexam;
    }

    /**
     * @param float $noteexam
     */
    public function setNoteexam($noteexam)
    {
        $this->noteexam = $noteexam;
    }

    /**
     * @return float
     */
    public function getMoyenne()
    {
        return $this->moyenne;
    }

    /**
     * @param float $moyenne
     */
    public function setMoyenne($moyenne)
    {
        $this->moyenne = $moyenne;
    }


}

