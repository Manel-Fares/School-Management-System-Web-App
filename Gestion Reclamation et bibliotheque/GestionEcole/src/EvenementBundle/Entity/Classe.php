<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classe
 *
 * @ORM\Table(name="classe", uniqueConstraints={@ORM\UniqueConstraint(name="Name", columns={"Name"})})
 * @ORM\Entity
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


}

