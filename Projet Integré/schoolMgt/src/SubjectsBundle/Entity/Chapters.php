<?php

namespace SubjectsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Chapters
 *
 * @ORM\Table(name="chapters")
 * @ORM\Entity(repositoryClass="SubjectsBundle\Repository\ChaptersRepository")
 */
class Chapters
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\NotBlank(message="Please provide a name")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="fichier", type="string", length=255)
     */
    private $fichier;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="schoolBundle\Entity\Matier"
     * )
     * @ORM\JoinColumn(
     *      name="matier",
     *      referencedColumnName="id",
     *      onDelete="CASCADE",
     *      nullable=false
     * )
     */
    private $matier;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Chapters
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set fichier
     *
     * @param string $fichier
     *
     * @return Chapters
     */
    public function setFichier($fichier)
    {
        $this->fichier = $fichier;

        return $this;
    }

    /**
     * Get fichier
     *
     * @return string
     */
    public function getFichier()
    {
        return $this->fichier;
    }

    /**
     * Set matier
     *
     * @param integer $matier
     *
     * @return Chapters
     */
    public function setMatier($matier)
    {
        $this->matier = $matier;

        return $this;
    }

    /**
     * Get matier
     *
     * @return int
     */
    public function getMatier()
    {
        return $this->matier;
    }
}

