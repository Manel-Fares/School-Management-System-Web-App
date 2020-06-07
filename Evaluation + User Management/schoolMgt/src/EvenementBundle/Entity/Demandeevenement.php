<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SBC\NotificationsBundle\Builder\NotificationBuilder;
use Symfony\Component\Validator\Constraints as Assert;
use SBC\NotificationsBundle\Model\NotifiableInterface;

/**
 * Demandeevenement
 *
 * @ORM\Table(name="demandeevenement", indexes={@ORM\Index(name="qsdqsdqd", columns={"idClub"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="EvenementBundle\Repository\DemandeevenementRepository")
 */
class Demandeevenement implements NotifiableInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idDemandeEvenement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddemandeevenement;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateDebut", type="date", nullable=false)
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateFin", type="date", nullable=false)
     */
    private $datefin;

    /**
     * @var string
     *
     * @ORM\Column(name="Etat", type="string", length=250, nullable=false)
     */
    private $etat;

    /**

     * @ORM\ManyToOne(targetEntity="EvenementBundle\Entity\Club")
     * @ORM\JoinColumn(name="idClub", referencedColumnName="idClub")
     */
    private $idclub;

    /**
     * @return mixed
     */
    public function getIdclub()
    {
        return $this->idclub;
    }

    /**
     * @param mixed $idclub
     */
    public function setIdclub($idclub)
    {
        $this->idclub = $idclub;
    }

    private $clubnom;

    /**
     * @return mixed
     */
    public function getClubnom()
    {
        return $this->clubnom;
    }

    /**
     * @param mixed $clubnom
     */
    public function setClubnom($clubnom)
    {
        $this->clubnom = $clubnom;
    }


    /**
     * @var float
     *
     * @ORM\Column(name="Budget", type="float", precision=10, scale=0, nullable=false)
     */
    private $budget;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=250, nullable=false)
     */
    private $image;

    /**
     * @return int
     */
    public function getIddemandeevenement()
    {
        return $this->iddemandeevenement;
    }

    /**
     * @param int $iddemandeevenement
     */
    public function setIddemandeevenement($iddemandeevenement)
    {
        $this->iddemandeevenement = $iddemandeevenement;
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

    /**
     * @return \DateTime
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * @param \DateTime $datedebut
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;
    }

    /**
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * @param \DateTime $datefin
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;
    }

    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }




    /**
     * @return float
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * @param float $budget
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    public function notificationsOnCreate(NotificationBuilder $builder)
    {
        $notification=new Notification();
        $notification
            ->setTitle('New Demande Evenement')
            ->setDescription($this->getDescription())
            ->setRoute('demandeevenement_show')
            ->setParameters(array('iddemandeevenement'=>$this->getIddemandeevenement()));

        $notification2=new Notification();
        $notification2
            ->setTitle('New Demande Evenement')
            ->setDescription($this->getDescription())
            ->setRoute('demandeevenement_show')
            ->setParameters(array('iddemandeevenement'=>$this->getIddemandeevenement()));


        $builder
            ->addNotification($notification)
            ->addNotification($notification2);


        return $builder;
    }

    public function notificationsOnUpdate(NotificationBuilder $builder)
    {
        $notification = new Notification();
        $notification
            ->setTitle('Demandeevenement updated')
            ->setDescription('"'.$this->description.'" has been updated')

            ->setRoute('comment_show')
            ->setParameters(array('id' => $this->iddemandeevenement))
        ;
        $builder->addNotification($notification);

        return $builder;
    }

    public function notificationsOnDelete(NotificationBuilder $builder)
    {
        // in case you don't want any notification for a special event
        // you can simply return an empty $builder
        return $builder;
    }
    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }
    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }


    /**
     * @Assert\File(maxSize="500k")
     *
     * )
     */
    private $file;

    public function getWebPath()
    {
        return null===$this->image ? null : $this->getUploadDir().'/'.$this->image;
    }
    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }
    protected function getUploadDir()
    {
        return 'images';
    }
    public function UploadProfilePicture()
    {
        $this->file->move($this->getUploadRootDir(),$this->file->getClientOriginalName());
        $this->image=$this->file->getClientOriginalName();
        $this->file=null;
    }

}

