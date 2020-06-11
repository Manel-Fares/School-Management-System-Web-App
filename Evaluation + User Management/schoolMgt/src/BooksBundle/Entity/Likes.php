<?php

namespace BooksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Likes
 *
 * @ORM\Table(name="likes", indexes={@ORM\Index(name="FK_etudiant_like", columns={"idetd"}), @ORM\Index(name="FK_Book_like", columns={"idbook"})})
 * @ORM\Entity
 */
class Likes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idLike", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlike;

    /**
     * @var \Books
     *
     * @ORM\ManyToOne(targetEntity="Books")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idbook", referencedColumnName="idBook")
     * })
     */
    private $idbook;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idetd", referencedColumnName="id")
     * })
     */
    private $idetd;

    /**
     * @return int
     */
    public function getIdlike()
    {
        return $this->idlike;
    }

    /**
     * @param int $idlike
     */
    public function setIdlike($idlike)
    {
        $this->idlike = $idlike;
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


}

