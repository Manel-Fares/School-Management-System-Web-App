<?php

namespace schoolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classe
 *
 * @ORM\Table(name="classe", uniqueConstraints={@ORM\UniqueConstraint(name="Name", columns={"Name"})})
 * @ORM\Entity(repositoryClass="schoolBundle\Repository\ClasseRepository")
 */
class Classe
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Niveau", type="string", length=255, nullable=false)
     */
    private $niveau;

    /**
     * @var string
     *
     * @ORM\Column(name="Spec", type="string", length=255, nullable=false)
     */
    private $spec;

    /**
     * @var integer
     *
     * @ORM\Column(name="Nbr_Etudiant", type="integer", nullable=false)
     */
    private $nbrEtudiant;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * @param string $niveau
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;
    }

    /**
     * @return string
     */
    public function getSpec()
    {
        return $this->spec;
    }

    /**
     * @param string $spec
     */
    public function setSpec($spec)
    {
        $this->spec = $spec;
    }

    /**
     * @return int
     */
    public function getNbrEtudiant()
    {
        return $this->nbrEtudiant;
    }

    /**
     * @param int $nbrEtudiant
     */
    public function setNbrEtudiant($nbrEtudiant)
    {
        $this->nbrEtudiant = $nbrEtudiant;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


}

