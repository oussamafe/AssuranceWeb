<?php

namespace GarantiaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Actualite
 *
 * @ORM\Table(name="actualite", indexes={@ORM\Index(name="fk_cat_actu", columns={"id_cat"})})
 * @ORM\Entity(repositoryClass="GarantiaBundle\Repository\ActualiteRepository")
 */
class Actualite
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
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     * @Assert\Length(
     *      min = 5,
     *      max = 30,
     *      minMessage = "Le Titre doit contenir au moins {{ limit }} caractéres ",
     *      maxMessage = "Le Titre doit contenir au plus {{ limit }} caractéres "
     * )
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_publication", type="date", nullable=false)
     */
    private $datePublication;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     * @Assert\Length(
     *      min = 5,
     *      max = 250,
     *      minMessage = "La Description doit contenir au moins {{ limit }} caractéres ",
     *      maxMessage = "La Description doit contenir au plus {{ limit }} caractéres "
     * )
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

    /**
     * @var \CategorieActu
     *
     * @ORM\ManyToOne(targetEntity="CategorieActu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cat", referencedColumnName="id")
     * })
     */
    private $idCat;

    /**
     * @var integer
     *
     * @ORM\Column(name="front", type="integer", nullable=false)
     */
    private $front;

    /**
     * @var integer
     *
     * @ORM\Column(name="views", type="integer", nullable=false)
     */
    private $views;


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
     * Set titre
     *
     * @param string $titre
     *
     * @return Actualite
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set datePublication
     *
     * @param \DateTime $datePublication
     *
     * @return Actualite
     */
    public function setDatePublication()
    {
        $this->datePublication = new \DateTime();

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Actualite
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

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Actualite
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set idCat
     *
     * @param \GarantiaBundle\Entity\CategorieActu $idCat
     *
     * @return Actualite
     */
    public function setIdCat(\GarantiaBundle\Entity\CategorieActu $idCat = null)
    {
        $this->idCat = $idCat;

        return $this;
    }

    /**
     * Get idCat
     *
     * @return \GarantiaBundle\Entity\CategorieActu
     */
    public function getIdCat()
    {
        return $this->idCat;
    }


    /**
     * Set front
     *
     * @param integer $front
     *
     * @return Actualite
     */
    public function setFront($front)
    {
        $this->front = $front;

        return $this;
    }

    /**
     * Get front
     *
     * @return integer
     */
    public function getFront()
    {
        return $this->front;
    }

    /**
     * Set views
     *
     * @param integer $views
     *
     * @return Actualite
     */
    public function setViews($views)
    {
        $this->views = $views;

        return $this;
    }

    /**
     * Get views
     *
     * @return integer
     */
    public function getViews()
    {
        return $this->views;
    }
}
