<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Absence
 *
 * @ORM\Table(name="absence", indexes={@ORM\Index(name="id_matier", columns={"id_matiere"}), @ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
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
     * @var integer
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_matiere", type="integer", nullable=false)
     */
    private $idMatiere;

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


}

