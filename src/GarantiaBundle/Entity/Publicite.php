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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getVue()
    {
        return $this->vue;
    }

    /**
     * @param string $vue
     */
    public function setVue($vue)
    {
        $this->vue = $vue;
    }

    /**
     * @return string
     */
    public function getImagepub()
    {
        return $this->imagepub;
    }

    /**
     * @param string $imagepub
     */
    public function setImagepub($imagepub)
    {
        $this->imagepub = $imagepub;
    }

    /**
     * @return string
     */
    public function getNompublicite()
    {
        return $this->nompublicite;
    }

    /**
     * @param string $nompublicite
     */
    public function setNompublicite($nompublicite)
    {
        $this->nompublicite = $nompublicite;
    }

    /**
     * @return \DateTime
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * @param \DateTime $datedebut
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;
    }

    /**
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * @param \DateTime $datefin
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }







}
