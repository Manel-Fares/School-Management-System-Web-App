<?php

namespace EvenementBundle\Entity;

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

    /**
     * @return int
     */
    public function getIdclub()
    {
        return $this->idclub;
    }

    /**
     * @param int $idclub
     */
    public function setIdclub($idclub)
    {
        $this->idclub = $idclub;
    }

    /**
     * @return string
     */
    public function getNomclub()
    {
        return $this->nomclub;
    }

    /**
     * @param string $nomclub
     */
    public function setNomclub($nomclub)
    {
        $this->nomclub = $nomclub;
    }

    /**
     * @return int
     */
    public function getIdresponsable()
    {
        return $this->idresponsable;
    }

    /**
     * @param int $idresponsable
     */
    public function setIdresponsable($idresponsable)
    {
        $this->idresponsable = $idresponsable;
    }

    /**
     * @return string
     */
    public function getDomaine()
    {
        return $this->domaine;
    }

    /**
     * @param string $domaine
     */
    public function setDomaine($domaine)
    {
        $this->domaine = $domaine;
    }


}

