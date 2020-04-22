<?php

namespace BooksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservationbook
 *
 * @ORM\Table(name="reservationbook", indexes={@ORM\Index(name="Fk_etudiant_Reservation", columns={"idEtd"}), @ORM\Index(name="FK_Book", columns={"idBook"})})
 * @ORM\Entity
 */
class Reservationbook
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idReservation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreservation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateD", type="date", nullable=true)
     */
    private $dated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateF", type="date", nullable=true)
     */
    private $datef;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEtd", referencedColumnName="id")
     * })
     */
    private $idetd;

    /**
     * @var \Books
     *
     * @ORM\ManyToOne(targetEntity="Books")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idBook", referencedColumnName="idBook")
     * })
     */
    private $idbook;

    /**
     * @return int
     */
    public function getIdreservation()
    {
        return $this->idreservation;
    }

    /**
     * @param int $idreservation
     */
    public function setIdreservation($idreservation)
    {
        $this->idreservation = $idreservation;
    }

    /**
     * @return \DateTime
     */
    public function getDated()
    {
        return $this->dated;
    }

    /**
     * @param \DateTime $dated
     */
    public function setDated($dated)
    {
        $this->dated = $dated;
    }

    /**
     * @return \DateTime
     */
    public function getDatef()
    {
        return $this->datef;
    }

    /**
     * @param \DateTime $datef
     */
    public function setDatef($datef)
    {
        $this->datef = $datef;
    }

    /**
     * @return \Users
     */
    public function getIdetd()
    {
        return $this->idetd;
    }

    /**
     * @param \Users $idetd
     */
    public function setIdetd($idetd)
    {
        $this->idetd = $idetd;
    }

    /**
     * @return \Books
     */
    public function getIdbook()
    {
        return $this->idbook;
    }

    /**
     * @param \Books $idbook
     */
    public function setIdbook($idbook)
    {
        $this->idbook = $idbook;
    }


}

