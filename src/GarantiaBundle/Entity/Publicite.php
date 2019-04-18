<?php

namespace GarantiaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Publicite
 *
 * @ORM\Table(name="publicite")
 * @ORM\Entity(repositoryClass="GarantiaBundle\Repository\PubliciteRepository")
 */
class Publicite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="vue", type="integer", length=255)
     */
    private $vue;

    /**
     * @var string
     *
     * @ORM\Column(name="imagepub", type="string", length=255)
     */
    private $imagepub;

    /**
     * @var string
     *
     * @ORM\Column(name="nompublicite", type="string", length=255)
     */
    private $nompublicite;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedebut", type="date")
     *
     * @Assert\GreaterThanOrEqual("today")
     *
     * @Assert\NotBlank()
     *
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefin", type="date")
     *
     * @Assert\GreaterThanOrEqual(propertyPath="datedebut" )
     *
     * @Assert\NotBlank()
     *
     */
    private $datefin;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 10,
     *      minMessage = "Your description must be at least {{ limit }} characters long",
     *      maxMessage = "Your description cannot be longer than {{ limit }} characters"
     * )
     */
    private $description;










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
     * Set vue
     *
     * @param integer $vue
     *
     * @return Publicite
     */
    public function setVue($vue)
    {
        $this->vue = $vue;

        return $this;
    }

    /**
     * Get vue
     *
     * @return integer
     */
    public function getVue()
    {
        return $this->vue;
    }

    /**
     * Set imagepub
     *
     * @param string $imagepub
     *
     * @return Publicite
     */
    public function setImagepub($imagepub)
    {
        $this->imagepub = $imagepub;

        return $this;
    }

    /**
     * Get imagepub
     *
     * @return string
     */
    public function getImagepub()
    {
        return $this->imagepub;
    }

    /**
     * Set nompublicite
     *
     * @param string $nompublicite
     *
     * @return Publicite
     */
    public function setNompublicite($nompublicite)
    {
        $this->nompublicite = $nompublicite;

        return $this;
    }

    /**
     * Get nompublicite
     *
     * @return string
     */
    public function getNompublicite()
    {
        return $this->nompublicite;
    }

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return Publicite
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \DateTime
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set datefin
     *
     * @param \DateTime $datefin
     *
     * @return Publicite
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Publicite
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
