<?php

namespace RecBundle\Entity;

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
     * @var integer
     *
     * @ORM\Column(name="id_evenement", type="integer", nullable=false)
     */
    private $idEvenement;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_participant", type="integer", nullable=false)
     */
    private $idParticipant;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idEvenement
     *
     * @param integer $idEvenement
     *
     * @return Participation
     */
    public function setIdEvenement($idEvenement)
    {
        $this->idEvenement = $idEvenement;

        return $this;
    }

    /**
     * Get idEvenement
     *
     * @return integer
     */
    public function getIdEvenement()
    {
        return $this->idEvenement;
    }

    /**
     * Set idParticipant
     *
     * @param integer $idParticipant
     *
     * @return Participation
     */
    public function setIdParticipant($idParticipant)
    {
        $this->idParticipant = $idParticipant;

        return $this;
    }

    /**
     * Get idParticipant
     *
     * @return integer
     */
    public function getIdParticipant()
    {
        return $this->idParticipant;
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
}
