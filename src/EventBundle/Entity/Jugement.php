<?php

namespace RecBundle\Entity;

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
     * @var integer
     *
     * @ORM\Column(name="id_incident", type="integer", nullable=false)
     */
    private $idIncident;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idIncident
     *
     * @param integer $idIncident
     *
     * @return Jugement
     */
    public function setIdIncident($idIncident)
    {
        $this->idIncident = $idIncident;

        return $this;
    }

    /**
     * Get idIncident
     *
     * @return integer
     */
    public function getIdIncident()
    {
        return $this->idIncident;
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
}
