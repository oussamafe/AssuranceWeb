<?php

namespace RecBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Constat
 *
 * @ORM\Table(name="constat")
 * @ORM\Entity
 */
class Constat
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
     * @ORM\Column(name="nomA", type="string", length=255, nullable=false)
     */
    private $noma;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomA", type="string", length=255, nullable=false)
     */
    private $prenoma;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseA", type="string", length=255, nullable=false)
     */
    private $adressea;

    /**
     * @var integer
     *
     * @ORM\Column(name="permisA", type="integer", nullable=false)
     */
    private $permisa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="delivreA", type="date", nullable=false)
     */
    private $delivrea;

    /**
     * @var string
     *
     * @ORM\Column(name="marqueA", type="string", length=255, nullable=false)
     */
    private $marquea;

    /**
     * @var string
     *
     * @ORM\Column(name="immatriculationA", type="string", length=255, nullable=false)
     */
    private $immatriculationa;

    /**
     * @var string
     *
     * @ORM\Column(name="chocA", type="string", length=11, nullable=false)
     */
    private $choca;

    /**
     * @var string
     *
     * @ORM\Column(name="chocB", type="string", length=11, nullable=false)
     */
    private $chocb;

    /**
     * @var string
     *
     * @ORM\Column(name="circonstance1", type="string", length=255, nullable=false)
     */
    private $circonstance1;

    /**
     * @var string
     *
     * @ORM\Column(name="circonstance2", type="string", length=255, nullable=false)
     */
    private $circonstance2;

    /**
     * @var string
     *
     * @ORM\Column(name="circonstance3", type="string", length=255, nullable=false)
     */
    private $circonstance3;

    /**
     * @var string
     *
     * @ORM\Column(name="circonstance4", type="string", length=255, nullable=false)
     */
    private $circonstance4;

    /**
     * @var string
     *
     * @ORM\Column(name="circonstance5", type="string", length=255, nullable=false)
     */
    private $circonstance5;

    /**
     * @var string
     *
     * @ORM\Column(name="circonstance6", type="string", length=255, nullable=false)
     */
    private $circonstance6;

    /**
     * @var string
     *
     * @ORM\Column(name="circonstance7", type="string", length=255, nullable=false)
     */
    private $circonstance7;

    /**
     * @var string
     *
     * @ORM\Column(name="circonstance8", type="string", length=255, nullable=false)
     */
    private $circonstance8;

    /**
     * @var string
     *
     * @ORM\Column(name="circonstance9", type="string", length=255, nullable=false)
     */
    private $circonstance9;

    /**
     * @var string
     *
     * @ORM\Column(name="circonstanceautre", type="string", length=255, nullable=false)
     */
    private $circonstanceautre;

    /**
     * @var string
     *
     * @ORM\Column(name="nomB", type="string", length=255, nullable=false)
     */
    private $nomb;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomB", type="string", length=255, nullable=false)
     */
    private $prenomb;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseB", type="string", length=255, nullable=false)
     */
    private $adresseb;

    /**
     * @var integer
     *
     * @ORM\Column(name="permisB", type="integer", nullable=false)
     */
    private $permisb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="delivreB", type="date", nullable=false)
     */
    private $delivreb;

    /**
     * @var string
     *
     * @ORM\Column(name="marqueB", type="string", length=255, nullable=false)
     */
    private $marqueb;

    /**
     * @var integer
     *
     * @ORM\Column(name="immatriculationB", type="integer", nullable=false)
     */
    private $immatriculationb;



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
     * Set noma
     *
     * @param string $noma
     *
     * @return Constat
     */
    public function setNoma($noma)
    {
        $this->noma = $noma;

        return $this;
    }

    /**
     * Get noma
     *
     * @return string
     */
    public function getNoma()
    {
        return $this->noma;
    }

    /**
     * Set prenoma
     *
     * @param string $prenoma
     *
     * @return Constat
     */
    public function setPrenoma($prenoma)
    {
        $this->prenoma = $prenoma;

        return $this;
    }

    /**
     * Get prenoma
     *
     * @return string
     */
    public function getPrenoma()
    {
        return $this->prenoma;
    }

    /**
     * Set adressea
     *
     * @param string $adressea
     *
     * @return Constat
     */
    public function setAdressea($adressea)
    {
        $this->adressea = $adressea;

        return $this;
    }

    /**
     * Get adressea
     *
     * @return string
     */
    public function getAdressea()
    {
        return $this->adressea;
    }

    /**
     * Set permisa
     *
     * @param integer $permisa
     *
     * @return Constat
     */
    public function setPermisa($permisa)
    {
        $this->permisa = $permisa;

        return $this;
    }

    /**
     * Get permisa
     *
     * @return integer
     */
    public function getPermisa()
    {
        return $this->permisa;
    }

    /**
     * Set delivrea
     *
     * @param \DateTime $delivrea
     *
     * @return Constat
     */
    public function setDelivrea($delivrea)
    {
        $this->delivrea = $delivrea;

        return $this;
    }

    /**
     * Get delivrea
     *
     * @return \DateTime
     */
    public function getDelivrea()
    {
        return $this->delivrea;
    }

    /**
     * Set marquea
     *
     * @param string $marquea
     *
     * @return Constat
     */
    public function setMarquea($marquea)
    {
        $this->marquea = $marquea;

        return $this;
    }

    /**
     * Get marquea
     *
     * @return string
     */
    public function getMarquea()
    {
        return $this->marquea;
    }

    /**
     * Set immatriculationa
     *
     * @param string $immatriculationa
     *
     * @return Constat
     */
    public function setImmatriculationa($immatriculationa)
    {
        $this->immatriculationa = $immatriculationa;

        return $this;
    }

    /**
     * Get immatriculationa
     *
     * @return string
     */
    public function getImmatriculationa()
    {
        return $this->immatriculationa;
    }

    /**
     * Set choca
     *
     * @param string $choca
     *
     * @return Constat
     */
    public function setChoca($choca)
    {
        $this->choca = $choca;

        return $this;
    }

    /**
     * Get choca
     *
     * @return string
     */
    public function getChoca()
    {
        return $this->choca;
    }

    /**
     * Set chocb
     *
     * @param string $chocb
     *
     * @return Constat
     */
    public function setChocb($chocb)
    {
        $this->chocb = $chocb;

        return $this;
    }

    /**
     * Get chocb
     *
     * @return string
     */
    public function getChocb()
    {
        return $this->chocb;
    }

    /**
     * Set circonstance1
     *
     * @param string $circonstance1
     *
     * @return Constat
     */
    public function setCirconstance1($circonstance1)
    {
        $this->circonstance1 = $circonstance1;

        return $this;
    }

    /**
     * Get circonstance1
     *
     * @return string
     */
    public function getCirconstance1()
    {
        return $this->circonstance1;
    }

    /**
     * Set circonstance2
     *
     * @param string $circonstance2
     *
     * @return Constat
     */
    public function setCirconstance2($circonstance2)
    {
        $this->circonstance2 = $circonstance2;

        return $this;
    }

    /**
     * Get circonstance2
     *
     * @return string
     */
    public function getCirconstance2()
    {
        return $this->circonstance2;
    }

    /**
     * Set circonstance3
     *
     * @param string $circonstance3
     *
     * @return Constat
     */
    public function setCirconstance3($circonstance3)
    {
        $this->circonstance3 = $circonstance3;

        return $this;
    }

    /**
     * Get circonstance3
     *
     * @return string
     */
    public function getCirconstance3()
    {
        return $this->circonstance3;
    }

    /**
     * Set circonstance4
     *
     * @param string $circonstance4
     *
     * @return Constat
     */
    public function setCirconstance4($circonstance4)
    {
        $this->circonstance4 = $circonstance4;

        return $this;
    }

    /**
     * Get circonstance4
     *
     * @return string
     */
    public function getCirconstance4()
    {
        return $this->circonstance4;
    }

    /**
     * Set circonstance5
     *
     * @param string $circonstance5
     *
     * @return Constat
     */
    public function setCirconstance5($circonstance5)
    {
        $this->circonstance5 = $circonstance5;

        return $this;
    }

    /**
     * Get circonstance5
     *
     * @return string
     */
    public function getCirconstance5()
    {
        return $this->circonstance5;
    }

    /**
     * Set circonstance6
     *
     * @param string $circonstance6
     *
     * @return Constat
     */
    public function setCirconstance6($circonstance6)
    {
        $this->circonstance6 = $circonstance6;

        return $this;
    }

    /**
     * Get circonstance6
     *
     * @return string
     */
    public function getCirconstance6()
    {
        return $this->circonstance6;
    }

    /**
     * Set circonstance7
     *
     * @param string $circonstance7
     *
     * @return Constat
     */
    public function setCirconstance7($circonstance7)
    {
        $this->circonstance7 = $circonstance7;

        return $this;
    }

    /**
     * Get circonstance7
     *
     * @return string
     */
    public function getCirconstance7()
    {
        return $this->circonstance7;
    }

    /**
     * Set circonstance8
     *
     * @param string $circonstance8
     *
     * @return Constat
     */
    public function setCirconstance8($circonstance8)
    {
        $this->circonstance8 = $circonstance8;

        return $this;
    }

    /**
     * Get circonstance8
     *
     * @return string
     */
    public function getCirconstance8()
    {
        return $this->circonstance8;
    }

    /**
     * Set circonstance9
     *
     * @param string $circonstance9
     *
     * @return Constat
     */
    public function setCirconstance9($circonstance9)
    {
        $this->circonstance9 = $circonstance9;

        return $this;
    }

    /**
     * Get circonstance9
     *
     * @return string
     */
    public function getCirconstance9()
    {
        return $this->circonstance9;
    }

    /**
     * Set circonstanceautre
     *
     * @param string $circonstanceautre
     *
     * @return Constat
     */
    public function setCirconstanceautre($circonstanceautre)
    {
        $this->circonstanceautre = $circonstanceautre;

        return $this;
    }

    /**
     * Get circonstanceautre
     *
     * @return string
     */
    public function getCirconstanceautre()
    {
        return $this->circonstanceautre;
    }

    /**
     * Set nomb
     *
     * @param string $nomb
     *
     * @return Constat
     */
    public function setNomb($nomb)
    {
        $this->nomb = $nomb;

        return $this;
    }

    /**
     * Get nomb
     *
     * @return string
     */
    public function getNomb()
    {
        return $this->nomb;
    }

    /**
     * Set prenomb
     *
     * @param string $prenomb
     *
     * @return Constat
     */
    public function setPrenomb($prenomb)
    {
        $this->prenomb = $prenomb;

        return $this;
    }

    /**
     * Get prenomb
     *
     * @return string
     */
    public function getPrenomb()
    {
        return $this->prenomb;
    }

    /**
     * Set adresseb
     *
     * @param string $adresseb
     *
     * @return Constat
     */
    public function setAdresseb($adresseb)
    {
        $this->adresseb = $adresseb;

        return $this;
    }

    /**
     * Get adresseb
     *
     * @return string
     */
    public function getAdresseb()
    {
        return $this->adresseb;
    }

    /**
     * Set permisb
     *
     * @param integer $permisb
     *
     * @return Constat
     */
    public function setPermisb($permisb)
    {
        $this->permisb = $permisb;

        return $this;
    }

    /**
     * Get permisb
     *
     * @return integer
     */
    public function getPermisb()
    {
        return $this->permisb;
    }

    /**
     * Set delivreb
     *
     * @param \DateTime $delivreb
     *
     * @return Constat
     */
    public function setDelivreb($delivreb)
    {
        $this->delivreb = $delivreb;

        return $this;
    }

    /**
     * Get delivreb
     *
     * @return \DateTime
     */
    public function getDelivreb()
    {
        return $this->delivreb;
    }

    /**
     * Set marqueb
     *
     * @param string $marqueb
     *
     * @return Constat
     */
    public function setMarqueb($marqueb)
    {
        $this->marqueb = $marqueb;

        return $this;
    }

    /**
     * Get marqueb
     *
     * @return string
     */
    public function getMarqueb()
    {
        return $this->marqueb;
    }

    /**
     * Set immatriculationb
     *
     * @param integer $immatriculationb
     *
     * @return Constat
     */
    public function setImmatriculationb($immatriculationb)
    {
        $this->immatriculationb = $immatriculationb;

        return $this;
    }

    /**
     * Get immatriculationb
     *
     * @return integer
     */
    public function getImmatriculationb()
    {
        return $this->immatriculationb;
    }
}
