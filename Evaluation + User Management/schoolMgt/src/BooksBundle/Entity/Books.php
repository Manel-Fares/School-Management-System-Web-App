<?php

namespace BooksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Books
 *
 * @ORM\Table(name="books")
 * @ORM\Entity
 */
class Books
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idBook", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idbook;

    /**
     * @var string
     *
     * @ORM\Column(name="titreBook", type="string", length=50, nullable=true)
     */
    private $titrebook;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrLike", type="integer", nullable=true)
     */
    private $nbrLike;
    /**
     * @var string
     *
     * @ORM\Column(name="descriptionBook", type="string", length=250, nullable=true)
     */
    private $descriptionbook;

    /**
     * @var string
     *
     * @ORM\Column(name="etatBook", type="string", length=20, nullable=true)
     */
    private $etatbook;

    /**
     * @var string
     *
     * @ORM\Column(name="picBook", type="string", length=250, nullable=true)
     */
    private $picbook;
    /**
     * @Assert\File(maxSize="500k")
     */
    public $file;

    /**
     * @var string
     *
     * @ORM\Column(name="categorieBook", type="string", length=250, nullable=true)
     */
    private $categoriebook;

    /**
     * @return int
     */
    public function getIdbook()
    {
        return $this->idbook;
    }

    /**
     * @param int $idbook
     */
    public function setIdbook($idbook)
    {
        $this->idbook = $idbook;
    }

    /**
     * @return string
     */
    public function getTitrebook()
    {
        return $this->titrebook;
    }

    /**
     * @param string $titrebook
     */
    public function setTitrebook($titrebook)
    {
        $this->titrebook = $titrebook;
    }

    /**
     * @return string
     */
    public function getDescriptionbook()
    {
        return $this->descriptionbook;
    }

    /**
     * @param string $descriptionbook
     */
    public function setDescriptionbook($descriptionbook)
    {
        $this->descriptionbook = $descriptionbook;
    }

    /**
     * @return string
     */
    public function getEtatbook()
    {
        return $this->etatbook;
    }

    /**
     * @param string $etatbook
     */
    public function setEtatbook($etatbook)
    {
        $this->etatbook = $etatbook;
    }

    /**
     * Get picbook
     *
     * @return string
     */
    public function getPicbook()
    {
        return $this->picbook;
    }

    /**
     * Set picbook
     *
     * @param string $picbook
     *
     * @return Categorie
     */
    public function setPicbook($picbook)
    {
        $this->picbook = $picbook;
            return $this;
    }
    public function getWebPath(){
        return null===$this->picbook ? null : $this->getUploadDir().'/'.$this->picbook;
    }
     protected function getUploadRootDir(){
        return __DIR__.'/../../../web/'.$this->getUploadDir();
     }
     protected function getUploadDir(){
        return 'images';
     }
     public function uploadProfilePicture(){
        $this->file->move($this->getUploadRootDir(),$this->file->getClientOriginalName());
        $this->picbook=$this->file->getClientOriginalName();
        $this->file=null;
     }

    /**
     * @return string
     */
    public function getCategoriebook()
    {
        return $this->categoriebook;
    }

    /**
     * @param string $categoriebook
     */
    public function setCategoriebook($categoriebook)
    {
        $this->categoriebook = $categoriebook;
    }

    /**
     * @return int
     */
    public function getNbrLike()
    {
        return $this->nbrLike;
    }

    /**
     * @param int $nbrLike
     */
    public function setNbrLike($nbrLike)
    {
        $this->nbrLike = $nbrLike;
    }


}

