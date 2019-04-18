<?php

namespace RecBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AssuranceOfferte
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
     * @var integer
     *
     * @ORM\Column(name="id_assurance", type="integer", nullable=false)
     */
    private $idAssurance;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_assurance_o", type="integer", nullable=false)
     */
    private $idAssuranceO;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idAssurance
     *
     * @param integer $idAssurance
     *
     * @return AssuranceOfferte
     */
    public function setIdAssurance($idAssurance)
    {
        $this->idAssurance = $idAssurance;

        return $this;
    }

    /**
     * Get idAssurance
     *
     * @return integer
     */
    public function getIdAssurance()
    {
        return $this->idAssurance;
    }

    /**
     * Set idAssuranceO
     *
     * @param integer $idAssuranceO
     *
     * @return AssuranceOfferte
     */
    public function setIdAssuranceO($idAssuranceO)
    {
        $this->idAssuranceO = $idAssuranceO;

        return $this;
    }

    /**
     * Get idAssuranceO
     *
     * @return integer
     */
    public function getIdAssuranceO()
    {
        return $this->idAssuranceO;
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
}
