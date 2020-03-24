<?php

namespace schoolBundle\Entity;

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


}

