<?php

namespace ClassBundle\Entity;

use AncaRebeca\FullCalendarBundle\Model\FullCalendarEvent;
use Doctrine\ORM\Mapping as ORM;

/**
 * Calendarannuel
 *
 * @ORM\Table(name="calendarannuel")
 * @ORM\Entity
 */
class Calendarannuel extends  FullCalendarEvent
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
     * @ORM\Column(name="subject", type="string", length=255, nullable=false)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="term", type="string", length=255, nullable=false)
     */
    private $term;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateC", type="date", nullable=false)
     */
    private $datec;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="date", nullable=false)
     */
    private $startdate;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="enddate", type="date", nullable=false)
     */
    private $enddate;

    /**
     * Calendarannuel constructor.
     * @param string $subject
     * @param \DateTime $datec
     */
    public function __construct($subject, \DateTime $datec)
    {
        $this->subject = $subject;
        $this->datec = $datec;
    }

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
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * @param string $term
     */
    public function setTerm($term)
    {
        $this->term = $term;
    }

    /**
     * @return \DateTime
     */
    public function getDatec()
    {
        return $this->datec;
    }

    /**
     * @param \DateTime $datec
     */
    public function setDatec($datec)
    {
        $this->datec = $datec;
    }

    /**
     * @return \DateTime
     */
    public function getStartdate()
    {
        return $this->startdate;
    }

    /**
     * @param \DateTime $startdate
     */
    public function setStartdate($startdate)
    {
        $this->startdate = $startdate;
    }

    /**
     * @return \DateTime
     */
    public function getEnddate()
    {
        return $this->enddate;
    }

    /**
     * @param \DateTime $enddate
     */
    public function setEnddate($enddate)
    {
        $this->enddate = $enddate;
    }


    /**
     * @return array
     */
    public function toArray()
    {
        return $this->toArray();
        // TODO: Implement toArray() method.
    }

}

