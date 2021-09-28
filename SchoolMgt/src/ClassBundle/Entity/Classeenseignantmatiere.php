<?php

namespace ClassBundle\Entity;
use ClassBundle\Entity\Enseigner;
use schoolBundle\Entity\Classe;
use Doctrine\ORM\Mapping as ORM;

/**
 * Classeenseignantmatiere
 *
 * @ORM\Table(name="classeenseignantmatiere", indexes={@ORM\Index(name="FK_classqqs", columns={"id_class"}), @ORM\Index(name="FK_USER", columns={"id_user"}), @ORM\Index(name="FK_Matiere", columns={"id_matiere"})})
 * @ORM\Entity
 */
class Classeenseignantmatiere
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
     * @var Enseigner
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="schoolBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @var Enseigner
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="schoolBundle\Entity\Matier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_matiere", referencedColumnName="id")
     * })
     */
    private $idMatiere;

    /**
     * @var Classe
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="schoolBundle\Entity\Classe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_class", referencedColumnName="Id")
     * })
     */
    private $idClass;

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
     * @return \ClassBundle\Entity\Enseigner
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param \ClassBundle\Entity\Enseigner $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @return \ClassBundle\Entity\Enseigner
     */
    public function getIdMatiere()
    {
        return $this->idMatiere;
    }

    /**
     * @param \ClassBundle\Entity\Enseigner $idMatiere
     */
    public function setIdMatiere($idMatiere)
    {
        $this->idMatiere = $idMatiere;
    }

    /**
     * @return Classe
     */
    public function getIdClass()
    {
        return $this->idClass;
    }

    /**
     * @param Classe $idClass
     */
    public function setIdClass($idClass)
    {
        $this->idClass = $idClass;
    }





}

