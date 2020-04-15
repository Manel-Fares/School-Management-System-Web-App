<?php

namespace schoolBundle\Entity;

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
    private $responsable;

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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return float
     */
    public function getCoef()
    {
        return $this->coef;
    }

    /**
     * @param float $coef
     */
    public function setCoef($coef)
    {
        $this->coef = $coef;
    }

    /**
     * @return int
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * @param int $responsable
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;
    }
    public function __toString(){
        try {
            // Note that the property needs to exist
            // on the class, or therefore the exception
            // will be thrown
            return (string) $this->getId();
        } catch (Exception $exception) {
            // Optionally you can var_dump the error message to see why the exception is being thrown !
            var_dump($exception->getMessage());
            return '';
        }
    }

}

