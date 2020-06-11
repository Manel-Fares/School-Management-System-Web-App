<?php

namespace schoolBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="schoolBundle\Repository\UsersRepository")
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
     * @var Classe
     *
     * @ORM\ManyToOne(targetEntity="Classe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="classeEtd", referencedColumnName="Id",nullable=true)
     * })
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

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCinuser()
    {
        return $this->cinuser;
    }

    /**
     * @param int $cinuser
     */
    public function setCinuser($cinuser)
    {
        $this->cinuser = $cinuser;
    }

    /**
     * @return string
     */
    public function getNomuser()
    {
        return $this->nomuser;
    }

    /**
     * @param string $nomuser
     */
    public function setNomuser($nomuser)
    {
        $this->nomuser = $nomuser;
    }

    /**
     * @return string
     */
    public function getPrenomuser()
    {
        return $this->prenomuser;
    }

    /**
     * @param string $prenomuser
     */
    public function setPrenomuser($prenomuser)
    {
        $this->prenomuser = $prenomuser;
    }

    /**
     * @return \DateTime
     */
    public function getDatenaissanceuser()
    {
        return $this->datenaissanceuser;
    }

    /**
     * @param \DateTime $datenaissanceuser
     */
    public function setDatenaissanceuser($datenaissanceuser)
    {
        $this->datenaissanceuser = $datenaissanceuser;
    }

    /**
     * @return string
     */
    public function getSexeuser()
    {
        return $this->sexeuser;
    }

    /**
     * @param string $sexeuser
     */
    public function setSexeuser($sexeuser)
    {
        $this->sexeuser = $sexeuser;
    }

    /**
     * @return string
     */
    public function getEmailuser()
    {
        return $this->emailuser;
    }

    /**
     * @param string $emailuser
     */
    public function setEmailuser($emailuser)
    {
        $this->emailuser = $emailuser;
    }


    /**
     * @return string
     */
    public function getAdresseuser()
    {
        return $this->adresseuser;
    }

    /**
     * @param string $adresseuser
     */
    public function setAdresseuser($adresseuser)
    {
        $this->adresseuser = $adresseuser;
    }

    /**
     * @return int
     */
    public function getNumteluser()
    {
        return $this->numteluser;
    }

    /**
     * @param int $numteluser
     */
    public function setNumteluser($numteluser)
    {
        $this->numteluser = $numteluser;
    }

    /**
     * @return string
     */
    public function getRoleuser()
    {
        return $this->roleuser;
    }

    /**
     * @param string $roleuser
     */
    public function setRoleuser($roleuser)
    {
        $this->roleuser = $roleuser;
    }

    /**
     * @return \DateTime
     */
    public function getDateembaucheuser()
    {
        return $this->dateembaucheuser;
    }

    /**
     * @param \DateTime $dateembaucheuser
     */
    public function setDateembaucheuser($dateembaucheuser)
    {
        $this->dateembaucheuser = $dateembaucheuser;
    }

    /**
     * @return string
     */
    public function getMotdepasseuser()
    {
        return $this->motdepasseuser;
    }

    /**
     * @param string $motdepasseuser
     */
    public function setMotdepasseuser($motdepasseuser)
    {
        $this->motdepasseuser = $motdepasseuser;
    }

    /**
     * @return Classe
     */
    public function getClasseetd()
    {
        return $this->classeetd;
    }

    /**
     * @param Classe $classeetd
     */
    public function setClasseetd($classeetd)
    {
        $this->classeetd = $classeetd;
    }

    public function __toString()
    {
        return parent::__toString(); // TODO: Change the autogenerated stub
    }

    /**
     * @return \DateTime
     */
    public function getInscriptionetd()
    {
        return $this->inscriptionetd;
    }

    /**
     * @param \DateTime $inscriptionetd
     */
    public function setInscriptionetd($inscriptionetd)
    {
        $this->inscriptionetd = $inscriptionetd;
    }

    /**
     * @return string
     */
    public function getNomresponsableetd()
    {
        return $this->nomresponsableetd;
    }

    /**
     * @param string $nomresponsableetd
     */
    public function setNomresponsableetd($nomresponsableetd)
    {
        $this->nomresponsableetd = $nomresponsableetd;
    }

    /**
     * @return string
     */
    public function getSpecialiteetd()
    {
        return $this->specialiteetd;
    }

    /**
     * @param string $specialiteetd
     */
    public function setSpecialiteetd($specialiteetd)
    {
        $this->specialiteetd = $specialiteetd;
    }

    /**
     * @return string
     */
    public function getStatutuser()
    {
        return $this->statutuser;
    }

    /**
     * @param string $statutuser
     */
    public function setStatutuser($statutuser)
    {
        $this->statutuser = $statutuser;
    }

    /**
     * @return float
     */
    public function getSalaireuser()
    {
        return $this->salaireuser;
    }

    /**
     * @param float $salaireuser
     */
    public function setSalaireuser($salaireuser)
    {
        $this->salaireuser = $salaireuser;
    }

    /**
     * @return string
     */
    public function getDomaineuser()
    {
        return $this->domaineuser;
    }

    /**
     * @param string $domaineuser
     */
    public function setDomaineuser($domaineuser)
    {
        $this->domaineuser = $domaineuser;
    }

    /**
     * @return string
     */
    public function getIdparent()
    {
        return $this->idparent;
    }

    /**
     * @param string $idparent
     */
    public function setIdparent($idparent)
    {
        $this->idparent = $idparent;
    }

    /**
     * @return string
     */
    public function getPicuser()
    {
        return 'img/blog/'.$this->picuser;
    }

    /**
     * @param string $picuser
     */
    public function setPicuser($picuser)
    {
        $this->picuser = $picuser;
    }


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }




}


