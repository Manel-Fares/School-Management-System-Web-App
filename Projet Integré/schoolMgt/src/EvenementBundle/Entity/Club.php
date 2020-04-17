<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ReflectionClass;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Club
 *
 * @ORM\Table(name="club", indexes={@ORM\Index(name="qsdqsd", columns={"idResponsable"})})
 * @ORM\Entity(repositoryClass="EvenementBundle\Repository\ClubRepository")
 */
class Club
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idClub", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idclub;

    /**
     * @var string
     *
     * @ORM\Column(name="nomClub", type="string", length=250, nullable=false)
     */
    private $nomclub;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Users")
     * @ORM\JoinColumn(name="idResponsable", referencedColumnName="id")
     */
    private $idresponsable;

    /**
     * @var string
     *
     * @ORM\Column(name="domaine", type="string", length=250, nullable=false)
     */
    private $domaine;

    /**
     * @return int
     */
    public function getIdclub()
    {
        return $this->idclub;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="image", type="text", length=65535, nullable=false)
     */
    private $image;

    /**
     * @param int $idclub
     */
    public function setIdclub($idclub)
    {
        $this->idclub = $idclub;
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
    /**
     * @return string
     */
    public function getNomclub()
    {
        return $this->nomclub;
    }

    /**
     * @param string $nomclub
     */
    public function setNomclub($nomclub)
    {
        $this->nomclub = $nomclub;
    }

    /**
     * @return mixed
     */
    public function getIdresponsable()
    {
        return $this->idresponsable;
    }

    /**
     * @param mixed $idresponsable
     */
    public function setIdresponsable($idresponsable)
    {
        $this->idresponsable = $idresponsable;
    }


    /**
     * @return string
     */
    public function getDomaine()
    {
        return $this->domaine;
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

    /**
     * @param string $domaine
     */
    public function setDomaine($domaine)
    {
        $this->domaine = $domaine;
    }

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

    public function __toString(){
        try {
            // Note that the property needs to exist
            // on the class, or therefore the exception
            // will be thrown
            return (string) $this->getIdclub();
        } catch (Exception $exception) {
            // Optionally you can var_dump the error message to see why the exception is being thrown !
            var_dump($exception->getMessage());
            return '';
        }
    }
    const BDGT =1000000;
    public function getConstants()
    {
        $reflectionClass = new ReflectionClass($this);
        return $reflectionClass->getConstants();
    }

}

