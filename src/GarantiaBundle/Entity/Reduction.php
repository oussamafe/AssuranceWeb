<?php

namespace GarantiaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reduction
 *
 * @ORM\Table(name="reduction", indexes={@ORM\Index(name="fk_assurance", columns={"id_assurance"})})
 * @ORM\Entity
 */
class Reduction
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
     * @ORM\Column(name="taux", type="integer", nullable=false)
     */
    private $taux;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date", nullable=false)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=false)
     */
    private $dateFin;

    /**
     * @var \TypeAssurance
     *
     * @ORM\ManyToOne(targetEntity="TypeAssurance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_assurance", referencedColumnName="id")
     * })
     */
    private $idAssurance;



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
     * Set taux
     *
     * @param integer $taux
     *
     * @return Reduction
     */
    public function setTaux($taux)
    {
        $this->taux = $taux;

        return $this;
    }

    /**
     * Get taux
     *
     * @return integer
     */
    public function getTaux()
    {
        return $this->taux;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Reduction
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
     * @return Reduction
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
     * @return Reduction
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
}
