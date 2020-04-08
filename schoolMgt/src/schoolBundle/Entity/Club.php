<?php

namespace schoolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Club
 *
 * @ORM\Table(name="club", indexes={@ORM\Index(name="qsdqsd", columns={"idResponsable"})})
 * @ORM\Entity
 */
class Club
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idClub", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idclub;

    /**
     * @var string
     *
     * @ORM\Column(name="nomClub", type="string", length=250, nullable=false)
     */
    private $nomclub;

    /**
     * @var integer
     *
     * @ORM\Column(name="idResponsable", type="integer", nullable=false)
     */
    private $idresponsable;

    /**
     * @var string
     *
     * @ORM\Column(name="domaine", type="string", length=250, nullable=false)
     */
    private $domaine;


}

