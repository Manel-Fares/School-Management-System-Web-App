<?php

namespace EvenementBundle\Entity;

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
     * @ORM\Column(name="id_class", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idClass;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_matiere", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idMatiere;


}

