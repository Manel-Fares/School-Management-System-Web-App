<?php

namespace schoolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message="Please provide a name")
     */
    private $nom;

    /**
     * @var float
     *
     * @ORM\Column(name="coef", type="float", precision=10, scale=0, nullable=false)
     * @Assert\Range(
     *      min = 1,
     *      max = 8,
     *      minMessage = "The grade must be between 1 and 8",
     *      maxMessage = "The grade must be between 1 and 8",
     * )     */
    private $coef;


    /**
     * @var Users
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Users", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="responsable", referencedColumnName="id")
     * })
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
     * @return Users
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * @param Users $responsable
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

