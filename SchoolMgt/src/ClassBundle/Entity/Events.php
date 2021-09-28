<?php

namespace ClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Events
 *
 * @ORM\Table(name="events")
 * @ORM\Entity
 */
class Events
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_event", type="datetime", nullable=false)
     */
    private $startEvent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_event", type="datetime", nullable=false)
     */
    private $endEvent;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return \DateTime
     */
    public function getStartEvent()
    {
        return $this->startEvent;
    }

    /**
     * @param \DateTime $startEvent
     */
    public function setStartEvent($startEvent)
    {
        $this->startEvent = $startEvent;
    }

    /**
     * @return \DateTime
     */
    public function getEndEvent()
    {
        return $this->endEvent;
    }

    /**
     * @param \DateTime $endEvent
     */
    public function setEndEvent($endEvent)
    {
        $this->endEvent = $endEvent;
    }


}

