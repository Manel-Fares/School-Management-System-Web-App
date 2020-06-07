<?php

namespace ClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use schoolBundle\Entity\Classe;
/**
 * Emplois
 *
 * @ORM\Table(name="emplois", indexes={@ORM\Index(name="IDX_461274B9B58EDEC1", columns={"nameclas"})})
 * @ORM\Entity
 */
class Emplois
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IdEmplois", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idemplois;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Heure", type="time", nullable=false)
     */
    private $heure;

    /**
     * @var string
     *
     * @ORM\Column(name="Source", type="string", length=255, nullable=false)
     */
    private $source;

    /**
     * @var Classe
     *
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Classe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nameclas", referencedColumnName="Id")
     * })
     */
    private $nameclas;

    /**
     * @return int
     */
    public function getIdemplois()
    {
        return $this->idemplois;
    }

    /**
     * @param int $idemplois
     */
    public function setIdemplois($idemplois)
    {
        $this->idemplois = $idemplois;
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
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * @param \DateTime $heure
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return Classe
     */
    public function getNameclas()
    {
        return $this->nameclas;
    }

    /**
     * @param Classe $nameclas
     */
    public function setNameclas($nameclas)
    {
        $this->nameclas = $nameclas;
    }


}

