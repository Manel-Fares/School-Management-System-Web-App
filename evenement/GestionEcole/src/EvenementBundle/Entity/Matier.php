<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matier
 *
 * @ORM\Table(name="matier", indexes={@ORM\Index(name="responsable", columns={"responsable"})})
 * @ORM\Entity
 */
class Matier
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;

    /**
     * @var float
     *
     * @ORM\Column(name="coef", type="float", precision=10, scale=0, nullable=false)
     */
    private $coef;

    /**
     * @var integer
     *
     * @ORM\Column(name="responsable", type="integer", nullable=true)
     */
    private $responsable = 'NULL';


}

