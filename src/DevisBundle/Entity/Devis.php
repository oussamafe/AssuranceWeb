<?php

namespace DevisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Devis
 *
 * @ORM\Table(name="devis", indexes={@ORM\Index(name="fk_devis_client", columns={"id_client"}), @ORM\Index(name="fk_devis_assurance", columns={"id_assurance"})})
 * @ORM\Entity
 */
class Devis
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
     * @ORM\Column(name="id_client", type="integer", nullable=false)
     */
    private $idClient;

    /**
     * @var string
     *
     * @ORM\Column(name="champ1", type="string", length=255, nullable=true)
     */
    private $champ1;

    /**
     * @var string
     *
     * @ORM\Column(name="champ2", type="string", length=255, nullable=true)
     */
    private $champ2;

    /**
     * @var string
     *
     * @ORM\Column(name="champ3", type="string", length=255, nullable=true)
     */
    private $champ3;

    /**
     * @var string
     *
     * @ORM\Column(name="champ4", type="string", length=255, nullable=true)
     */
    private $champ4;

    /**
     * @var integer
     *
     * @ORM\Column(name="critere1", type="integer", nullable=true)
     */
    private $critere1;

    /**
     * @var integer
     *
     * @ORM\Column(name="critere2", type="integer", nullable=true)
     */
    private $critere2;

    /**
     * @var integer
     *
     * @ORM\Column(name="critere3", type="integer", nullable=true)
     */
    private $critere3;

    /**
     * @var integer
     *
     * @ORM\Column(name="critere4", type="integer", nullable=true)
     */
    private $critere4;

    /**
     * @var integer
     *
     * @ORM\Column(name="total", type="integer", nullable=true)
     */
    private $total;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_devis", type="datetime", nullable=true)
     */
    private $dateDevis = 'CURRENT_TIMESTAMP';



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
     * @return Devis
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
     * Set idClient
     *
     * @param integer $idClient
     *
     * @return Devis
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
     * Set champ1
     *
     * @param string $champ1
     *
     * @return Devis
     */
    public function setChamp1($champ1)
    {
        $this->champ1 = $champ1;

        return $this;
    }

    /**
     * Get champ1
     *
     * @return string
     */
    public function getChamp1()
    {
        return $this->champ1;
    }

    /**
     * Set champ2
     *
     * @param string $champ2
     *
     * @return Devis
     */
    public function setChamp2($champ2)
    {
        $this->champ2 = $champ2;

        return $this;
    }

    /**
     * Get champ2
     *
     * @return string
     */
    public function getChamp2()
    {
        return $this->champ2;
    }

    /**
     * Set champ3
     *
     * @param string $champ3
     *
     * @return Devis
     */
    public function setChamp3($champ3)
    {
        $this->champ3 = $champ3;

        return $this;
    }

    /**
     * Get champ3
     *
     * @return string
     */
    public function getChamp3()
    {
        return $this->champ3;
    }

    /**
     * Set champ4
     *
     * @param string $champ4
     *
     * @return Devis
     */
    public function setChamp4($champ4)
    {
        $this->champ4 = $champ4;

        return $this;
    }

    /**
     * Get champ4
     *
     * @return string
     */
    public function getChamp4()
    {
        return $this->champ4;
    }

    /**
     * Set critere1
     *
     * @param integer $critere1
     *
     * @return Devis
     */
    public function setCritere1($critere1)
    {
        $this->critere1 = $critere1;

        return $this;
    }

    /**
     * Get critere1
     *
     * @return integer
     */
    public function getCritere1()
    {
        return $this->critere1;
    }

    /**
     * Set critere2
     *
     * @param integer $critere2
     *
     * @return Devis
     */
    public function setCritere2($critere2)
    {
        $this->critere2 = $critere2;

        return $this;
    }

    /**
     * Get critere2
     *
     * @return integer
     */
    public function getCritere2()
    {
        return $this->critere2;
    }

    /**
     * Set critere3
     *
     * @param integer $critere3
     *
     * @return Devis
     */
    public function setCritere3($critere3)
    {
        $this->critere3 = $critere3;

        return $this;
    }

    /**
     * Get critere3
     *
     * @return integer
     */
    public function getCritere3()
    {
        return $this->critere3;
    }

    /**
     * Set critere4
     *
     * @param integer $critere4
     *
     * @return Devis
     */
    public function setCritere4($critere4)
    {
        $this->critere4 = $critere4;

        return $this;
    }

    /**
     * Get critere4
     *
     * @return integer
     */
    public function getCritere4()
    {
        return $this->critere4;
    }

    /**
     * Set total
     *
     * @param integer $total
     *
     * @return Devis
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return integer
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set dateDevis
     *
     * @param \DateTime $dateDevis
     *
     * @return Devis
     */
    public function setDateDevis($dateDevis)
    {
        $this->dateDevis = $dateDevis;

        return $this;
    }

    /**
     * Get dateDevis
     *
     * @return \DateTime
     */
    public function getDateDevis()
    {
        return $this->dateDevis;
    }
}
