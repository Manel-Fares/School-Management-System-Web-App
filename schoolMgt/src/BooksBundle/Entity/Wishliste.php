<?php

namespace BooksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wishliste
 *
 * @ORM\Table(name="wishliste", indexes={@ORM\Index(name="FK_etudiant_wishliste", columns={"idEtd"}), @ORM\Index(name="FK_book_wishliste", columns={"idBook"})})
 * @ORM\Entity
 */
class Wishliste
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idList", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlist;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEtd", referencedColumnName="id")
     * })
     */
    private $idetd;

    /**
     * @var \Books
     *
     * @ORM\ManyToOne(targetEntity="Books")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idBook", referencedColumnName="idBook")
     * })
     */
    private $idbook;

    /**
     * @return int
     */
    public function getIdlist()
    {
        return $this->idlist;
    }

    /**
     * @param int $idlist
     */
    public function setIdlist($idlist)
    {
        $this->idlist = $idlist;
    }

    /**
     * @return \Users
     */
    public function getIdetd()
    {
        return $this->idetd;
    }

    /**
     * @param \Users $idetd
     */
    public function setIdetd($idetd)
    {
        $this->idetd = $idetd;
    }

    /**
     * @return \Books
     */
    public function getIdbook()
    {
        return $this->idbook;
    }

    /**
     * @param \Books $idbook
     */
    public function setIdbook($idbook)
    {
        $this->idbook = $idbook;
    }


}

