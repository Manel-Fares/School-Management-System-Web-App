<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sondage
 *
 * @ORM\Table(name="sondage")
 * @ORM\Entity
 */
class Sondage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_sondage", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSondage;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_club", type="integer", nullable=false)
     */
    private $idClub;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=250, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="reponse", type="text", length=65535, nullable=false)
     */
    private $reponse;


}

