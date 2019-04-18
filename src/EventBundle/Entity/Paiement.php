<?php

namespace RecBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paiement
 *
 * @ORM\Table(name="paiement", indexes={@ORM\Index(name="fk_client_fac", columns={"id_client"}), @ORM\Index(name="fk_devis_fac", columns={"id_devis"})})
 * @ORM\Entity
 */
class Paiement
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
     * @var integer
     *
     * @ORM\Column(name="id_devis", type="integer", nullable=false)
     */
    private $idDevis;

    /**
     * @var integer
     *
     * @ORM\Column(name="paid", type="integer", nullable=false)
     */
    private $paid;

    /**
     * @var integer
     *
     * @ORM\Column(name="total", type="integer", nullable=false)
     */
    private $total;



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
     * @return Paiement
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
     * Set idDevis
     *
     * @param integer $idDevis
     *
     * @return Paiement
     */
    public function setIdDevis($idDevis)
    {
        $this->idDevis = $idDevis;

        return $this;
    }

    /**
     * Get idDevis
     *
     * @return integer
     */
    public function getIdDevis()
    {
        return $this->idDevis;
    }

    /**
     * Set paid
     *
     * @param integer $paid
     *
     * @return Paiement
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;

        return $this;
    }

    /**
     * Get paid
     *
     * @return integer
     */
    public function getPaid()
    {
        return $this->paid;
    }

    /**
     * Set total
     *
     * @param integer $total
     *
     * @return Paiement
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
}
