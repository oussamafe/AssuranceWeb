<?php

namespace GarantiaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paiement
 *
 * @ORM\Table(name="paiement", indexes={@ORM\Index(name="fk_devis_fac", columns={"id_devis"}), @ORM\Index(name="fk_client_fac", columns={"id_client"})})
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
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_client", referencedColumnName="id")
     * })
     */
    private $idClient;

    /**
     * @var \Devis
     *
     * @ORM\ManyToOne(targetEntity="Devis")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_devis", referencedColumnName="id")
     * })
     */
    private $idDevis;



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

    /**
     * Set idClient
     *
     * @param \UserBundle\Entity\User $idClient
     *
     * @return Paiement
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
     * Set idDevis
     *
     * @param \GarantiaBundle\Entity\Devis $idDevis
     *
     * @return Paiement
     */
    public function setIdDevis(\GarantiaBundle\Entity\Devis $idDevis = null)
    {
        $this->idDevis = $idDevis;

        return $this;
    }

    /**
     * Get idDevis
     *
     * @return \GarantiaBundle\Entity\Devis
     */
    public function getIdDevis()
    {
        return $this->idDevis;
    }
}
