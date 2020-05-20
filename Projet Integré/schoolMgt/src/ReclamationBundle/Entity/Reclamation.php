<?php

namespace ReclamationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation", indexes={@ORM\Index(name="FK_etudiant", columns={"IdEtd"})})
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
     * @ORM\Column(name="sujetReclamation", type="string", length=255, nullable=true)
     */
    private $sujetreclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionReclamation", type="string", length=255, nullable=true)
     */
    private $descriptionreclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="statutReclamation", type="string", length=11, nullable=true)
     */
    private $statutreclamation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="date", nullable=true)
     */
    private $datecreation;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdEtd", referencedColumnName="id")
     * })
     */
    private $idetd;

    /**
     * @return int
     */
    public function getIdreclamation()
    {
        return $this->idreclamation;
    }

    /**
     * @param int $idreclamation
     * @return Reclamation
     */
    public function setIdreclamation($idreclamation)
    {
        $this->idreclamation = $idreclamation;
        return $this;
    }

    /**
     * @return string
     */
    public function getSujetreclamation()
    {
        return $this->sujetreclamation;
    }

    /**
     * @param string $sujetreclamation
     */
    public function setSujetreclamation($sujetreclamation)
    {
        $this->sujetreclamation = $sujetreclamation;
    }

    /**
     * @return string
     */
    public function getDescriptionreclamation()
    {
        return $this->descriptionreclamation;
    }

    /**
     * @param string $descriptionreclamation
     */
    public function setDescriptionreclamation($descriptionreclamation)
    {
        $this->descriptionreclamation = $descriptionreclamation;
    }

    /**
     * @return string
     */
    public function getStatutreclamation()
    {
        return $this->statutreclamation;
    }

    /**
     * @param string $statutreclamation
     */
    public function setStatutreclamation($statutreclamation)
    {
        $this->statutreclamation = $statutreclamation;
    }

    /**
     * @return \DateTime
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * @param \DateTime $datecreation
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;
    }

    /**
     * @return \Users
     */
    public function getIdetd()
    {
        return $this->idetd;
    }

    /**
     * @param \Users $idetd
     */
    public function setIdetd($idetd)
    {
        $this->idetd = $idetd;
    }


}

