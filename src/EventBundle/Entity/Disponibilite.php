<?php

namespace RecBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Disponibilite
 *
 * @ORM\Table(name="disponibilite")
 * @ORM\Entity
 */
class Disponibilite
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
     * @ORM\Column(name="lundi", type="integer", nullable=true)
     */
    private $lundi;

    /**
     * @var integer
     *
     * @ORM\Column(name="mardi", type="integer", nullable=true)
     */
    private $mardi;

    /**
     * @var integer
     *
     * @ORM\Column(name="mercredi", type="integer", nullable=true)
     */
    private $mercredi;

    /**
     * @var integer
     *
     * @ORM\Column(name="jeudi", type="integer", nullable=true)
     */
    private $jeudi;

    /**
     * @var integer
     *
     * @ORM\Column(name="vendredi", type="integer", nullable=true)
     */
    private $vendredi;

    /**
     * @var integer
     *
     * @ORM\Column(name="samedi", type="integer", nullable=true)
     */
    private $samedi;



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
     * @return Disponibilite
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
     * Set lundi
     *
     * @param integer $lundi
     *
     * @return Disponibilite
     */
    public function setLundi($lundi)
    {
        $this->lundi = $lundi;

        return $this;
    }

    /**
     * Get lundi
     *
     * @return integer
     */
    public function getLundi()
    {
        return $this->lundi;
    }

    /**
     * Set mardi
     *
     * @param integer $mardi
     *
     * @return Disponibilite
     */
    public function setMardi($mardi)
    {
        $this->mardi = $mardi;

        return $this;
    }

    /**
     * Get mardi
     *
     * @return integer
     */
    public function getMardi()
    {
        return $this->mardi;
    }

    /**
     * Set mercredi
     *
     * @param integer $mercredi
     *
     * @return Disponibilite
     */
    public function setMercredi($mercredi)
    {
        $this->mercredi = $mercredi;

        return $this;
    }

    /**
     * Get mercredi
     *
     * @return integer
     */
    public function getMercredi()
    {
        return $this->mercredi;
    }

    /**
     * Set jeudi
     *
     * @param integer $jeudi
     *
     * @return Disponibilite
     */
    public function setJeudi($jeudi)
    {
        $this->jeudi = $jeudi;

        return $this;
    }

    /**
     * Get jeudi
     *
     * @return integer
     */
    public function getJeudi()
    {
        return $this->jeudi;
    }

    /**
     * Set vendredi
     *
     * @param integer $vendredi
     *
     * @return Disponibilite
     */
    public function setVendredi($vendredi)
    {
        $this->vendredi = $vendredi;

        return $this;
    }

    /**
     * Get vendredi
     *
     * @return integer
     */
    public function getVendredi()
    {
        return $this->vendredi;
    }

    /**
     * Set samedi
     *
     * @param integer $samedi
     *
     * @return Disponibilite
     */
    public function setSamedi($samedi)
    {
        $this->samedi = $samedi;

        return $this;
    }

    /**
     * Get samedi
     *
     * @return integer
     */
    public function getSamedi()
    {
        return $this->samedi;
    }
}
