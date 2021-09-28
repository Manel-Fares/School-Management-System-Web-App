<?php

namespace schoolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use schoolBundle\Entity\Users;
use schoolBundle\Entity\Matier;

/**
 * Note
 *
 * @ORM\Table(name="note",  indexes={@ORM\Index(name="FK_ens", columns={"idEnseignant"}), @ORM\Index(name="FK_USER", columns={"idEtudiant"}), @ORM\Index(name="FK_Matiere", columns={"idMatiere"})})
 * @ORM\Entity
 */
class Note
{

    /**
     * @var Users
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Users", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEtudiant", referencedColumnName="id")
     * })
     */
    private $etudiant;

    /**
     * @var Matier
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Matier", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idMatiere", referencedColumnName="id")
     * })
     */
    private $matiere;

    /**
     * @var Users
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Users")
     * @ORM\JoinColumn(name="idEnseignant",referencedColumnName="id")
     *
     */
    private $enseignant;

    /**
     * @var \DateTime
     * @ORM\Column(name="dateNote", type="date", nullable=false)
     * @ORM\GeneratedValue(strategy="NONE")
     * @Assert\NotBlank(message="Please provide a date")
     */
    private $datenote;

    /**
     * @var float
     *
     * @ORM\Column(name="noteCC", type="float", precision=10, scale=0, nullable=true)
     * @Assert\Regex(
     *     pattern="/^[0-9,.]+$/",
     *     message="Only numbers allowed"
     * )
     * @Assert\NotBlank(message="Please provide a grade")
     * @Assert\Length(
     *     min=1,
     *     max=5,
     *     minMessage="Please provide the cc grade",
     *     maxMessage="Invalid Grade, too long "
     * )
     * @Assert\Range(
     *      min = 0,
     *      max = 20,
     *      minMessage = "The grade must be between 0 and 0",
     *      maxMessage = "The grade must be between 0 and 0",
     * )
     */
    private $notecc;

    /**
     * @var float
     *
     * @ORM\Column(name="noteDS", type="float", precision=10, scale=0, nullable=true)
     * @Assert\Regex(
     *     pattern="/^[0-9,.]+$/",
     *     message="Only numbers allowed"
     * )
     * @Assert\NotBlank(message="Please provide a grade")
     * @Assert\Length(
     *     min=1,
     *     max=5,
     *     minMessage="Please provide the ds grade",
     *     maxMessage="Invalid Grade, too long "
     * )
     * @Assert\Range(
     *      min = 0,
     *      max = 20,
     *      minMessage = "The grade must be between 0 and 20",
     *      maxMessage = "The grade must be between 0 and 20",
     * )
     */
    private $noteds;

    /**
     * @var float
     *
     * @ORM\Column(name="noteExam", type="float", precision=10, scale=0, nullable=true)
     * @Assert\Regex(
     *     pattern="/^[0-9,.]+$/",
     *     message="Only numbers allowed"
     * )
     * @Assert\NotBlank(message="Please provide a grade")
     * @Assert\Length(
     *     min=1,
     *     max=5,
     *     minMessage="Please provide the exam grade",
     *     maxMessage="Invalid Grade, too long !! "
     * )
     * @Assert\Range(
     *      min = 0,
     *      max = 20,
     *      minMessage = "The grade must be between 0 and 20",
     *      maxMessage = "The grade must be between 0 and 20",
     * )
     */
    private $noteexam;

    /**
     * @var float
     *
     * @ORM\Column(name="Moyenne", type="float", precision=10, scale=0, nullable=true)
     */
    private $moyenne;


    /**
     * @return \schoolBundle\Entity\Users
     */
    public function getEnseignant()
    {
        return $this->enseignant;
    }

    /**
     * @param \schoolBundle\Entity\Users $enseignant
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

    /**
     * @return \schoolBundle\Entity\Users
     */
    public function getEtudiant()
    {
        return $this->etudiant;
    }

    /**
     * @param \schoolBundle\Entity\Users $etudiant
     */
    public function setEtudiant($etudiant)
    {
        $this->etudiant = $etudiant;
    }

    /**
     * @return \schoolBundle\Entity\Matier
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * @param \schoolBundle\Entity\Matier $matiere
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;
    }


}

