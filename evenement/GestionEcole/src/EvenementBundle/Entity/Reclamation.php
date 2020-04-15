<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation", indexes={@ORM\Index(name="FK_reclamation", columns={"IdEtd"})})
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idReclamation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="sujetReclamation", type="string", length=255, nullable=false)
     */
    private $sujetreclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionReclamation", type="string", length=255, nullable=false)
     */
    private $descriptionreclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="statutReclamation", type="string", length=11, nullable=false)
     */
    private $statutreclamation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="date", nullable=false)
     */
    private $datecreation;

    /**
     * @var integer
     *
     * @ORM\Column(name="IdEtd", type="integer", nullable=true)
     */
    private $idetd = 'NULL';


}

