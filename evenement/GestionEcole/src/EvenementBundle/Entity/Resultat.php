<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resultat
 *
 * @ORM\Table(name="resultat")
 * @ORM\Entity
 */
class Resultat
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idEtudiant", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idetudiant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateResultat", type="date", nullable=false)
     */
    private $dateresultat;

    /**
     * @var float
     *
     * @ORM\Column(name="resultat", type="float", precision=10, scale=0, nullable=true)
     */
    private $resultat = 'NULL';


}

