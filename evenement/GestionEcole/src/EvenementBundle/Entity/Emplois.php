<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emplois
 *
 * @ORM\Table(name="emplois")
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


}

