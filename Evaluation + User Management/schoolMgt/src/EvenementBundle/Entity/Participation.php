<?php


namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Participation
 *
 * @ORM\Table(name="participation", indexes={@ORM\Index(name="aszdzd", columns={"iduser"}), @ORM\Index(name="ploikfdxzs", columns={"idEvenement"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="EvenementBundle\Repository\ParticipationRepository")
**/
class Participation
{   /**
 * @var integer
 *
 * @ORM\Column(name="idparticipation", type="integer", nullable=false)
 * @ORM\Id
 * @ORM\GeneratedValue(strategy="IDENTITY")
 */
    private $idparticipation;

    /**
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idevenement", referencedColumnName="idEvenement")
     * })
     */
    private $idevenement;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="schoolBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="iduser", referencedColumnName="id")
     * })
     */
    private $iduser;

    /**
     * @return int
     */
    public function getIdparticipation()
    {
        return $this->idparticipation;
    }

    /**
     * @param int $idparticipation
     */
    public function setIdparticipation($idparticipation)
    {
        $this->idparticipation = $idparticipation;
    }

    /**
     * @return \Evenement
     */
    public function getIdevenement()
    {
        return $this->idevenement;
    }

    /**
     * @param \Evenement $idevenement
     */
    public function setIdevenement($idevenement)
    {
        $this->idevenement = $idevenement;
    }

    /**
     * @return \Users
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @param \Users $iduser
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }


}