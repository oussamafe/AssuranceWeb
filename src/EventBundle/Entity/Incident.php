<?php

namespace RecBundle\Entity;

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
     * @var integer
     *
     * @ORM\Column(name="id_client", type="integer", nullable=true)
     */
    private $idClient;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_assurance", type="integer", nullable=true)
     */
    private $idAssurance;

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
     * @var integer
     *
     * @ORM\Column(name="id_constat", type="integer", nullable=true)
     */
    private $idConstat;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_expert", type="integer", nullable=true)
     */
    private $idExpert;



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
     * @return Incident
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
     * Set idAssurance
     *
     * @param integer $idAssurance
     *
     * @return Incident
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
     * Set idConstat
     *
     * @param integer $idConstat
     *
     * @return Incident
     */
    public function setIdConstat($idConstat)
    {
        $this->idConstat = $idConstat;

        return $this;
    }

    /**
     * Get idConstat
     *
     * @return integer
     */
    public function getIdConstat()
    {
        return $this->idConstat;
    }

    /**
     * Set idExpert
     *
     * @param integer $idExpert
     *
     * @return Incident
     */
    public function setIdExpert($idExpert)
    {
        $this->idExpert = $idExpert;

        return $this;
    }

    /**
     * Get idExpert
     *
     * @return integer
     */
    public function getIdExpert()
    {
        return $this->idExpert;
    }
}
