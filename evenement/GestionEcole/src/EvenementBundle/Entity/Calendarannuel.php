<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calendarannuel
 *
 * @ORM\Table(name="calendarannuel")
 * @ORM\Entity
 */
class Calendarannuel
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


}

