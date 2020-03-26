<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demandeevenement
 *
 * @ORM\Table(name="demandeevenement", indexes={@ORM\Index(name="qsdqsdqd", columns={"idClub"})})
 * @ORM\Entity
 */
class Demandeevenement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idDemandeEvenement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddemandeevenement;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateDebut", type="date", nullable=false)
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateFin", type="date", nullable=false)
     */
    private $datefin;

    /**
     * @var string
     *
     * @ORM\Column(name="Etat", type="string", length=250, nullable=false)
     */
    private $etat;

    /**
     * @var integer
     *
     * @ORM\Column(name="idClub", type="integer", nullable=false)
     */
    private $idclub;

    /**
     * @var float
     *
     * @ORM\Column(name="Budget", type="float", precision=10, scale=0, nullable=false)
     */
    private $budget;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=250, nullable=false)
     */
    private $image;

    /**
     * @return int
     */
    public function getIddemandeevenement()
    {
        return $this->iddemandeevenement;
    }

    /**
     * @param int $iddemandeevenement
     */
    public function setIddemandeevenement($iddemandeevenement)
    {
        $this->iddemandeevenement = $iddemandeevenement;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * @param \DateTime $datedebut
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;
    }

    /**
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * @param \DateTime $datefin
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;
    }

    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return int
     */
    public function getIdclub()
    {
        return $this->idclub;
    }

    /**
     * @param int $idclub
     */
    public function setIdclub($idclub)
    {
        $this->idclub = $idclub;
    }

    /**
     * @return float
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * @param float $budget
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }


}

