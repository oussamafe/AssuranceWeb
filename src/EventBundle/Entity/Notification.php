<?php

namespace RecBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table(name="notification", indexes={@ORM\Index(name="fk_idemp", columns={"id_employe"})})
 * @ORM\Entity
 */
class Notification
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
     * @ORM\Column(name="sent", type="integer", nullable=false)
     */
    private $sent;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_admin", type="integer", nullable=false)
     */
    private $idAdmin;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_employe", type="integer", nullable=false)
     */
    private $idEmploye;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_client", type="integer", nullable=false)
     */
    private $idClient;



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
     * Set sent
     *
     * @param integer $sent
     *
     * @return Notification
     */
    public function setSent($sent)
    {
        $this->sent = $sent;

        return $this;
    }

    /**
     * Get sent
     *
     * @return integer
     */
    public function getSent()
    {
        return $this->sent;
    }

    /**
     * Set idAdmin
     *
     * @param integer $idAdmin
     *
     * @return Notification
     */
    public function setIdAdmin($idAdmin)
    {
        $this->idAdmin = $idAdmin;

        return $this;
    }

    /**
     * Get idAdmin
     *
     * @return integer
     */
    public function getIdAdmin()
    {
        return $this->idAdmin;
    }

    /**
     * Set idEmploye
     *
     * @param integer $idEmploye
     *
     * @return Notification
     */
    public function setIdEmploye($idEmploye)
    {
        $this->idEmploye = $idEmploye;

        return $this;
    }

    /**
     * Get idEmploye
     *
     * @return integer
     */
    public function getIdEmploye()
    {
        return $this->idEmploye;
    }

    /**
     * Set idClient
     *
     * @param integer $idClient
     *
     * @return Notification
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
}
