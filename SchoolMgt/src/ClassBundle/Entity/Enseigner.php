<?php

namespace ClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use schoolBundle\Entity\Matier;
use schoolBundle\Entity\Users;

/**
 * Enseigner
 *
 * @ORM\Table(name="enseigner", indexes={@ORM\Index(name="FK_enseig", columns={"idEnseignant"}), @ORM\Index(name="FK_Mat", columns={"idMatiere"})})
 * @ORM\Entity
 */
class Enseigner
{


    /**
     * @var Matier
     *
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Matier", fetch="EAGER")
     * @ORM\Id
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idMatiere", referencedColumnName="id")
     * })
     */
    private $idmatiere;

    /**
     * @var Users
     *
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Users", fetch="EAGER")
     * @ORM\Id
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEnseignant", referencedColumnName="id")
     * })
     */
    private $idenseignant;

    /**
     * @return Matier
     */
    public function getIdmatiere()
    {
        return $this->idmatiere;
    }

    /**
     * @param Matier $idmatiere
     */
    public function setIdmatiere($idmatiere)
    {
        $this->idmatiere = $idmatiere;
    }

    /**
     * @return Users
     */
    public function getIdenseignant()
    {
        return $this->idenseignant;
    }

    /**
     * @param Users $idenseignant
     */
    public function setIdenseignant($idenseignant)
    {
        $this->idenseignant = $idenseignant;
    }




}

