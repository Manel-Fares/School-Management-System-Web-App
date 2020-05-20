<?php

namespace ClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use schoolBundle\Entity\Matier;
use schoolBundle\Entity\Users;

/**
 * Absence
 *
 * @ORM\Table(name="absence", indexes={@ORM\Index(name="id_matier", columns={"id_matiere"}), @ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity(repositoryClass="ClassBundle\Repository\AbsenceRepository")
 */
class Absence
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
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="TimeDeb", type="time", nullable=false)
     */
    private $timedeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="TimeFin", type="time", nullable=false)
     */
    private $timefin;

    /**
     * @var Matier
     *
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Matier", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_matiere", referencedColumnName="id")
     * })
     */
    private $idMatiere;

    /**
     * @var Users
     *
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Users", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return \DateTime
     */
    public function getTimedeb()
    {
        return $this->timedeb;
    }

    /**
     * @param \DateTime $timedeb
     */
    public function setTimedeb($timedeb)
    {
        $this->timedeb = $timedeb;
    }

    /**
     * @return \DateTime
     */
    public function getTimefin()
    {
        return $this->timefin;
    }

    /**
     * @param \DateTime $timefin
     */
    public function setTimefin($timefin)
    {
        $this->timefin = $timefin;
    }

    /**
     * @return Matier
     */
    public function getIdMatiere()
    {
        return $this->idMatiere;
    }

    /**
     * @param Matier $idMatiere
     */
    public function setIdMatiere($idMatiere)
    {
        $this->idMatiere = $idMatiere;
    }

    /**
     * @return Users
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param Users $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }



}

