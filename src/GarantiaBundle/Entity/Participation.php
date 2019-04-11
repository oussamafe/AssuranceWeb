<?php

namespace GarantiaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation", indexes={@ORM\Index(name="fk_id_event", columns={"id_evenement"}), @ORM\Index(name="fk_id_participant", columns={"id_participant"})})
 * @ORM\Entity
 */
class Participation
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
     * @ORM\Column(name="QrCode", type="string", length=50, nullable=false)
     */
    private $qrcode;

    /**
     * @var integer
     *
     * @ORM\Column(name="Etat", type="integer", nullable=false)
     */
    private $etat;

    /**
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_evenement", referencedColumnName="id")
     * })
     */
    private $idEvenement;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_participant", referencedColumnName="id")
     * })
     */
    private $idParticipant;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set qrcode
     *
     * @param string $qrcode
     *
     * @return Participation
     */
    public function setQrcode($qrcode)
    {
        $this->qrcode = $qrcode;

        return $this;
    }

    /**
     * Get qrcode
     *
     * @return string
     */
    public function getQrcode()
    {
        return $this->qrcode;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return Participation
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return integer
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set idEvenement
     *
     * @param \GarantiaBundle\Entity\Evenement $idEvenement
     *
     * @return Participation
     */
    public function setIdEvenement(\GarantiaBundle\Entity\Evenement $idEvenement = null)
    {
        $this->idEvenement = $idEvenement;

        return $this;
    }

    /**
     * Get idEvenement
     *
     * @return \GarantiaBundle\Entity\Evenement
     */
    public function getIdEvenement()
    {
        return $this->idEvenement;
    }

    /**
     * Set idParticipant
     *
     * @param \UserBundle\Entity\User $idParticipant
     *
     * @return Participation
     */
    public function setIdParticipant(\UserBundle\Entity\User $idParticipant = null)
    {
        $this->idParticipant = $idParticipant;

        return $this;
    }

    /**
     * Get idParticipant
     *
     * @return \UserBundle\Entity\User
     */
    public function getIdParticipant()
    {
        return $this->idParticipant;
    }
}
