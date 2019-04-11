<?php

namespace GarantiaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jugement
 *
 * @ORM\Table(name="jugement", indexes={@ORM\Index(name="fk_id_incident", columns={"id_incident"})})
 * @ORM\Entity
 */
class Jugement
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
     * @ORM\Column(name="observation", type="string", length=255, nullable=false)
     */
    private $observation;

    /**
     * @var string
     *
     * @ORM\Column(name="verdict", type="string", length=255, nullable=false)
     */
    private $verdict;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set observation
     *
     * @param string $observation
     *
     * @return Jugement
     */
    public function setObservation($observation)
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * Get observation
     *
     * @return string
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * Set verdict
     *
     * @param string $verdict
     *
     * @return Jugement
     */
    public function setVerdict($verdict)
    {
        $this->verdict = $verdict;

        return $this;
    }

    /**
     * Get verdict
     *
     * @return string
     */
    public function getVerdict()
    {
        return $this->verdict;
    }

    /**
     * Set idIncident
     *
     * @param \GarantiaBundle\Entity\Incident $idIncident
     *
     * @return Jugement
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
}
