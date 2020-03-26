<?php

namespace EvenementBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class Users extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="cinUser", type="integer", nullable=true)
     */
    private $cinuser;

    /**
     * @var string
     *
     * @ORM\Column(name="nomUser", type="string", length=50, nullable=true)
     */
    private $nomuser;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomUser", type="string", length=50, nullable=true)
     */
    private $prenomuser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateNaissanceUser", type="date", nullable=true)
     */
    private $datenaissanceuser;

    /**
     * @var string
     *
     * @ORM\Column(name="sexeUser", type="string", length=10, nullable=true)
     */
    private $sexeuser;

    /**
     * @var string
     *
     * @ORM\Column(name="emailUser", type="string", length=100, nullable=true)
     */
    private $emailuser;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseUser", type="string", length=50, nullable=true)
     */
    private $adresseuser;

    /**
     * @var integer
     *
     * @ORM\Column(name="numTelUser", type="integer", nullable=true)
     */
    private $numteluser;

    /**
     * @var string
     *
     * @ORM\Column(name="roleUser", type="string", length=50, nullable=true)
     */
    private $roleuser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEmbaucheUser", type="date", nullable=true)
     */
    private $dateembaucheuser;

    /**
     * @var string
     *
     * @ORM\Column(name="motDePasseUser", type="string", length=100, nullable=true)
     */
    private $motdepasseuser;

    /**
     * @var string
     *
     * @ORM\Column(name="classeEtd", type="string", length=100, nullable=true)
     */
    private $classeetd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inscriptionEtd", type="date", nullable=true)
     */
    private $inscriptionetd;

    /**
     * @var string
     *
     * @ORM\Column(name="nomResponsableEtd", type="string", length=100, nullable=true)
     */
    private $nomresponsableetd;

    /**
     * @var string
     *
     * @ORM\Column(name="specialiteEtd", type="string", length=100, nullable=true)
     */
    private $specialiteetd;

    /**
     * @var string
     *
     * @ORM\Column(name="statutUser", type="string", length=50, nullable=true)
     */
    private $statutuser;

    /**
     * @var float
     *
     * @ORM\Column(name="salaireUser", type="float", precision=10, scale=0, nullable=true)
     */
    private $salaireuser;

    /**
     * @var string
     *
     * @ORM\Column(name="domaineUser", type="string", length=100, nullable=true)
     */
    private $domaineuser;

    /**
     * @var string
     *
     * @ORM\Column(name="idParent", type="string", length=30, nullable=true)
     */
    private $idparent;

    /**
     * @var string
     *
     * @ORM\Column(name="picUser", type="string", length=255, nullable=true)
     */
    private $picuser;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}


