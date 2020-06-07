<?php
/**
 * Created by PhpStorm.
 * User: Neifos
 * Date: 14/04/2020
 * Time: 00:59
 */

namespace BooksBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use FOS\CommentBundle\Entity\Thread as BaseThread;
/**
 * @ORM\Entity
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Thread extends BaseThread
{
    /**
     * @var string $id
     *
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    protected $id;
    /**
     * @var \Books
     *
     * @ORM\ManyToOne(targetEntity="Books")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idBook", referencedColumnName="idBook")
     * })
     */
    protected $idbook;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


}