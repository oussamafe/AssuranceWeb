<?php

namespace GarantiaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeOffre
 *
 * @ORM\Table(name="type_offre", indexes={@ORM\Index(name="fk_idAgence", columns={"id_agence"})})
 * @ORM\Entity
 */
class TypeOffre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id_offre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOffre;

    /**
     * @var string
     *
     * @ORM\Column(name="nomoffre", type="string", length=255, nullable=false)
     */
    private $nomoffre;

    /**
     * @var \Agence
     *
     * @ORM\ManyToOne(targetEntity="Agence")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_agence", referencedColumnName="Id_Agence")
     * })
     */
    private $idAgence;



    /**
     * Get idOffre
     *
     * @return integer
     */
    public function getIdOffre()
    {
        return $this->idOffre;
    }

    /**
     * Set nomoffre
     *
     * @param string $nomoffre
     *
     * @return TypeOffre
     */
    public function setNomoffre($nomoffre)
    {
        $this->nomoffre = $nomoffre;

        return $this;
    }

    /**
     * Get nomoffre
     *
     * @return string
     */
    public function getNomoffre()
    {
        return $this->nomoffre;
    }

    /**
     * Set idAgence
     *
     * @param \GarantiaBundle\Entity\Agence $idAgence
     *
     * @return TypeOffre
     */
    public function setIdAgence(\GarantiaBundle\Entity\Agence $idAgence = null)
    {
        $this->idAgence = $idAgence;

        return $this;
    }

    /**
     * Get idAgence
     *
     * @return \GarantiaBundle\Entity\Agence
     */
    public function getIdAgence()
    {
        return $this->idAgence;
    }
}
