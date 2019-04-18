<?php

namespace RecBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeAssurance
 *
 * @ORM\Table(name="type_assurance")
 * @ORM\Entity
 */
class TypeAssurance
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="champ1", type="string", length=255, nullable=false)
     */
    private $champ1;

    /**
     * @var string
     *
     * @ORM\Column(name="champ2", type="string", length=255, nullable=false)
     */
    private $champ2;

    /**
     * @var string
     *
     * @ORM\Column(name="champ3", type="string", length=255, nullable=false)
     */
    private $champ3;

    /**
     * @var string
     *
     * @ORM\Column(name="champ4", type="string", length=255, nullable=false)
     */
    private $champ4;

    /**
     * @var string
     *
     * @ORM\Column(name="critere1", type="string", length=255, nullable=false)
     */
    private $critere1;

    /**
     * @var integer
     *
     * @ORM\Column(name="devis1", type="integer", nullable=false)
     */
    private $devis1;

    /**
     * @var string
     *
     * @ORM\Column(name="critere2", type="string", length=255, nullable=false)
     */
    private $critere2;

    /**
     * @var integer
     *
     * @ORM\Column(name="devis2", type="integer", nullable=false)
     */
    private $devis2;

    /**
     * @var string
     *
     * @ORM\Column(name="critere3", type="string", length=255, nullable=false)
     */
    private $critere3;

    /**
     * @var integer
     *
     * @ORM\Column(name="devis3", type="integer", nullable=false)
     */
    private $devis3;

    /**
     * @var string
     *
     * @ORM\Column(name="critere4", type="string", length=255, nullable=false)
     */
    private $critere4;

    /**
     * @var integer
     *
     * @ORM\Column(name="devis4", type="integer", nullable=false)
     */
    private $devis4;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix_initial", type="integer", nullable=false)
     */
    private $prixInitial;



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
     * Set nom
     *
     * @param string $nom
     *
     * @return TypeAssurance
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set champ1
     *
     * @param string $champ1
     *
     * @return TypeAssurance
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
     * @return TypeAssurance
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
     * @return TypeAssurance
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
     * @return TypeAssurance
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
     * @param string $critere1
     *
     * @return TypeAssurance
     */
    public function setCritere1($critere1)
    {
        $this->critere1 = $critere1;

        return $this;
    }

    /**
     * Get critere1
     *
     * @return string
     */
    public function getCritere1()
    {
        return $this->critere1;
    }

    /**
     * Set devis1
     *
     * @param integer $devis1
     *
     * @return TypeAssurance
     */
    public function setDevis1($devis1)
    {
        $this->devis1 = $devis1;

        return $this;
    }

    /**
     * Get devis1
     *
     * @return integer
     */
    public function getDevis1()
    {
        return $this->devis1;
    }

    /**
     * Set critere2
     *
     * @param string $critere2
     *
     * @return TypeAssurance
     */
    public function setCritere2($critere2)
    {
        $this->critere2 = $critere2;

        return $this;
    }

    /**
     * Get critere2
     *
     * @return string
     */
    public function getCritere2()
    {
        return $this->critere2;
    }

    /**
     * Set devis2
     *
     * @param integer $devis2
     *
     * @return TypeAssurance
     */
    public function setDevis2($devis2)
    {
        $this->devis2 = $devis2;

        return $this;
    }

    /**
     * Get devis2
     *
     * @return integer
     */
    public function getDevis2()
    {
        return $this->devis2;
    }

    /**
     * Set critere3
     *
     * @param string $critere3
     *
     * @return TypeAssurance
     */
    public function setCritere3($critere3)
    {
        $this->critere3 = $critere3;

        return $this;
    }

    /**
     * Get critere3
     *
     * @return string
     */
    public function getCritere3()
    {
        return $this->critere3;
    }

    /**
     * Set devis3
     *
     * @param integer $devis3
     *
     * @return TypeAssurance
     */
    public function setDevis3($devis3)
    {
        $this->devis3 = $devis3;

        return $this;
    }

    /**
     * Get devis3
     *
     * @return integer
     */
    public function getDevis3()
    {
        return $this->devis3;
    }

    /**
     * Set critere4
     *
     * @param string $critere4
     *
     * @return TypeAssurance
     */
    public function setCritere4($critere4)
    {
        $this->critere4 = $critere4;

        return $this;
    }

    /**
     * Get critere4
     *
     * @return string
     */
    public function getCritere4()
    {
        return $this->critere4;
    }

    /**
     * Set devis4
     *
     * @param integer $devis4
     *
     * @return TypeAssurance
     */
    public function setDevis4($devis4)
    {
        $this->devis4 = $devis4;

        return $this;
    }

    /**
     * Get devis4
     *
     * @return integer
     */
    public function getDevis4()
    {
        return $this->devis4;
    }

    /**
     * Set prixInitial
     *
     * @param integer $prixInitial
     *
     * @return TypeAssurance
     */
    public function setPrixInitial($prixInitial)
    {
        $this->prixInitial = $prixInitial;

        return $this;
    }

    /**
     * Get prixInitial
     *
     * @return integer
     */
    public function getPrixInitial()
    {
        return $this->prixInitial;
    }
}
