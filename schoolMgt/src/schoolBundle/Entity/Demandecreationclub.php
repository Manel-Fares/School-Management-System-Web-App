<?php

namespace schoolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demandecreationclub
 *
 * @ORM\Table(name="demandecreationclub")
 * @ORM\Entity
 */
class Demandecreationclub
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idDemandeClub", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddemandeclub;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDEtudiant", type="integer", nullable=false)
     */
    private $idetudiant;

    /**
     * @var string
     *
     * @ORM\Column(name="nomClub", type="string", length=250, nullable=false)
     */
    private $nomclub;

    /**
     * @var string
     *
     * @ORM\Column(name="domaine", type="string", length=250, nullable=false)
     */
    private $domaine;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text", length=65535, nullable=false)
     */
    private $description;


}

