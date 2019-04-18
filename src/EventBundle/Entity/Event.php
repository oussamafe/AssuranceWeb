<?php

namespace RecBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Essai
 *
 * @ORM\Table(name="essai", indexes={@ORM\Index(name="fk_id_client", columns={"id_client"})})
 * @ORM\Entity
 */
class Essai
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
     * @ORM\Column(name="id_client", type="integer", nullable=false)
     */
    private $idClient;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEssai", type="date", nullable=false)
     */
    private $dateessai;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=50, nullable=false)
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
     * Set idClient
     *
     * @param integer $idClient
     *
     * @return Essai
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;

        return $this;
    }

    /**
     * Get idClient
     *
     * @return integer
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * Set dateessai
     *
     * @param \DateTime $dateessai
     *
     * @return Essai
     */
    public function setDateessai($dateessai)
    {
        $this->dateessai = $dateessai;

        return $this;
    }

    /**
     * Get dateessai
     *
     * @return \DateTime
     */
    public function getDateessai()
    {
        return $this->dateessai;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Essai
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }
}
