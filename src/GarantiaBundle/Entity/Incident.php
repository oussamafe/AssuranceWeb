<?php

namespace GarantiaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Incident
 *
 * @ORM\Table(name="incident", indexes={@ORM\Index(name="fk_id_assurance", columns={"id_assurance"}), @ORM\Index(name="fk_client_id", columns={"id_client"}), @ORM\Index(name="fk_expert_id", columns={"id_expert"}), @ORM\Index(name="fk_id_constat", columns={"id_constat"})})
 * @ORM\Entity
 */
class Incident
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
     * @ORM\Column(name="date_incident", type="date", nullable=false)
     */
    private $dateIncident;

    /**
     * @var string
     *
     * @ORM\Column(name="image1", type="string", length=255, nullable=false)
     */
    private $image1;

    /**
     * @var string
     *
     * @ORM\Column(name="image2", type="string", length=255, nullable=false)
     */
    private $image2;

    /**
     * @var string
     *
     * @ORM\Column(name="image3", type="string", length=255, nullable=false)
     */
    private $image3;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=255, nullable=false)
     */
    private $commentaire;

    /**
     * @var integer
     *
     * @ORM\Column(name="etat", type="integer", nullable=true)
     */
    private $etat;

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
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_expert", referencedColumnName="id")
     * })
     */
    private $idExpert;

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
     * @var \Constat
     *
     * @ORM\ManyToOne(targetEntity="Constat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_constat", referencedColumnName="id")
     * })
     */
    private $idConstat;



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
     * Set dateIncident
     *
     * @param \DateTime $dateIncident
     *
     * @return Incident
     */
    public function setDateIncident($dateIncident)
    {
        $this->dateIncident = $dateIncident;

        return $this;
    }

    /**
     * Get dateIncident
     *
     * @return \DateTime
     */
    public function getDateIncident()
    {
        return $this->dateIncident;
    }

    /**
     * Set image1
     *
     * @param string $image1
     *
     * @return Incident
     */
    public function setImage1($image1)
    {
        $this->image1 = $image1;

        return $this;
    }

    /**
     * Get image1
     *
     * @return string
     */
    public function getImage1()
    {
        return $this->image1;
    }

    /**
     * Set image2
     *
     * @param string $image2
     *
     * @return Incident
     */
    public function setImage2($image2)
    {
        $this->image2 = $image2;

        return $this;
    }

    /**
     * Get image2
     *
     * @return string
     */
    public function getImage2()
    {
        return $this->image2;
    }

    /**
     * Set image3
     *
     * @param string $image3
     *
     * @return Incident
     */
    public function setImage3($image3)
    {
        $this->image3 = $image3;

        return $this;
    }

    /**
     * Get image3
     *
     * @return string
     */
    public function getImage3()
    {
        return $this->image3;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Incident
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return Incident
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
     * Set idClient
     *
     * @param \UserBundle\Entity\User $idClient
     *
     * @return Incident
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

    /**
     * Set idExpert
     *
     * @param \UserBundle\Entity\User $idExpert
     *
     * @return Incident
     */
    public function setIdExpert(\UserBundle\Entity\User $idExpert = null)
    {
        $this->idExpert = $idExpert;

        return $this;
    }

    /**
     * Get idExpert
     *
     * @return \UserBundle\Entity\User
     */
    public function getIdExpert()
    {
        return $this->idExpert;
    }

    /**
     * Set idAssurance
     *
     * @param \GarantiaBundle\Entity\TypeAssurance $idAssurance
     *
     * @return Incident
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
     * Set idConstat
     *
     * @param \GarantiaBundle\Entity\Constat $idConstat
     *
     * @return Incident
     */
    public function setIdConstat(\GarantiaBundle\Entity\Constat $idConstat = null)
    {
        $this->idConstat = $idConstat;

        return $this;
    }

    /**
     * Get idConstat
     *
     * @return \GarantiaBundle\Entity\Constat
     */
    public function getIdConstat()
    {
        return $this->idConstat;
    }
}
