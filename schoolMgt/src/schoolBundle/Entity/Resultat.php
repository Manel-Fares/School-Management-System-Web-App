<?php

namespace schoolBundle\Entity;

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
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Users")
     * @ORM\Column(name="idEtudiant", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $etudiant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateResultat", type="date", nullable=false)
     *
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $dateresultat;

    /**
     * @var float
     *
     * @ORM\Column(name="resultat", type="float", precision=10, scale=0, nullable=true)
     */
    private $resultat;

    /**
     * @return int
     */
    public function getEtudiant()
    {
        return $this->etudiant;
    }

    /**
     * @param int $etudiant
     */
    public function setEtudiant($etudiant)
    {
        $this->etudiant = $etudiant;
    }

    /**
     * @return \DateTime
     */
    public function getDateresultat()
    {
        return $this->dateresultat;
    }

    /**
     * @param \DateTime $dateresultat
     */
    public function setDateresultat($dateresultat)
    {
        $this->dateresultat = $dateresultat;
    }

    /**
     * @return float
     */
    public function getResultat()
    {
        return $this->resultat;
    }

    /**
     * @param float $resultat
     */
    public function setResultat($resultat)
    {
        $this->resultat = $resultat;
    }


}

