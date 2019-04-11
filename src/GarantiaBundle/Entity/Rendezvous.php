<?php

namespace GarantiaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rendezvous
 *
 * @ORM\Table(name="rendezvous", indexes={@ORM\Index(name="fk_id_incident1", columns={"id_incident"}), @ORM\Index(name="fk_idc", columns={"id_client"})})
 * @ORM\Entity
 */
class Rendezvous
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
     * @ORM\Column(name="jour", type="string", length=255, nullable=false)
     */
    private $jour;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure", type="time", nullable=false)
     */
    private $heure;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255, nullable=false)
     */
    private $lieu;

    /**
     * @var \Incident
     *
     * @ORM\ManyToOne(targetEntity="Incident")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_incident", referencedColumnName="id")
     * })
     */
    private $idIncident;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_client", referencedColumnName="id")
     * })
     */
    private $idClient;



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
     * Set jour
     *
     * @param string $jour
     *
     * @return Rendezvous
     */
    public function setJour($jour)
    {
        $this->jour = $jour;

        return $this;
    }

    /**
     * Get jour
     *
     * @return string
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * Set heure
     *
     * @param \DateTime $heure
     *
     * @return Rendezvous
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;

        return $this;
    }

    /**
     * Get heure
     *
     * @return \DateTime
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Rendezvous
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set idIncident
     *
     * @param \GarantiaBundle\Entity\Incident $idIncident
     *
     * @return Rendezvous
     */
    public function setIdIncident(\GarantiaBundle\Entity\Incident $idIncident = null)
    {
        $this->idIncident = $idIncident;

        return $this;
    }

    /**
     * Get idIncident
     *
     * @return \GarantiaBundle\Entity\Incident
     */
    public function getIdIncident()
    {
        return $this->idIncident;
    }

    /**
     * Set idClient
     *
     * @param \UserBundle\Entity\User $idClient
     *
     * @return Rendezvous
     */
    public function setIdClient(\UserBundle\Entity\User $idClient = null)
    {
        $this->idClient = $idClient;

        return $this;
    }

    /**
     * Get idClient
     *
     * @return \UserBundle\Entity\User
     */
    public function getIdClient()
    {
        return $this->idClient;
    }
}
