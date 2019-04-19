<?php

namespace GarantiaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AssuranceOfferteController
 *
 * @ORM\Table(name="assurance_offerte", indexes={@ORM\Index(name="fk_id_assurance4", columns={"id_assurance"}), @ORM\Index(name="fk_id_assuranceo", columns={"id_assurance_o"})})
 * @ORM\Entity
 */
class AssuranceOfferte
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @var \TypeAssurance
     *
     * @ORM\ManyToOne(targetEntity="AssuranceBundle\Entity\TypeAssurance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_assurance", referencedColumnName="id")
     * })
     */
    private $idAssurance;

    /**
     * @var \TypeAssurance
     *
     * @ORM\ManyToOne(targetEntity="AssuranceBundle\Entity\TypeAssurance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_assurance_o", referencedColumnName="id")
     * })
     */
    private $idAssuranceO;



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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return AssuranceOfferte
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return AssuranceOfferte
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set idAssurance
     *
     * @param \GarantiaBundle\Entity\TypeAssurance $idAssurance
     *
     * @return AssuranceOfferte
     */
    public function setIdAssurance(\GarantiaBundle\Entity\TypeAssurance $idAssurance = null)
    {
        $this->idAssurance = $idAssurance;

        return $this;
    }

    /**
     * Get idAssurance
     *
     * @return \GarantiaBundle\Entity\TypeAssurance
     */
    public function getIdAssurance()
    {
        return $this->idAssurance;
    }

    /**
     * Set idAssuranceO
     *
     * @param \GarantiaBundle\Entity\TypeAssurance $idAssuranceO
     *
     * @return AssuranceOfferte
     */
    public function setIdAssuranceO(\GarantiaBundle\Entity\TypeAssurance $idAssuranceO = null)
    {
        $this->idAssuranceO = $idAssuranceO;

        return $this;
    }

    /**
     * Get idAssuranceO
     *
     * @return \GarantiaBundle\Entity\TypeAssurance
     */
    public function getIdAssuranceO()
    {
        return $this->idAssuranceO;
    }
}
