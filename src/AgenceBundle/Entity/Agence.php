<?php
namespace AgenceBundle\Entity;
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11/04/2019
 * Time: 02:21
 */




use Doctrine\ORM\Mapping as ORM;

/**
 * Agence
 *
 * @ORM\Table(name="agence")
 * @ORM\Entity
 */
class Agence
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id_Agence", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAgence;

    /**
     * @var string
     *
     * @ORM\Column(name="NomAgence", type="string", length=255, nullable=false)
     */
    private $nomagence;

    /**
     * @var string
     *
     * @ORM\Column(name="Localisation", type="string", length=255, nullable=false)
     */
    private $localisation;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Specialisation", type="string", length=255, nullable=false)
     */
    private $specialisation;

    /**
     * @var string
     *
     * @ORM\Column(name="Responsable", type="string", length=255, nullable=false)
     */
    private $responsable;



    /**
     * Get idAgence
     *
     * @return integer
     */
    public function getIdAgence()
    {
        return $this->idAgence;
    }

    /**
     * Set nomagence
     *
     * @param string $nomagence
     *
     * @return Agence
     */
    public function setNomagence($nomagence)
    {
        $this->nomagence = $nomagence;

        return $this;
    }

    /**
     * Get nomagence
     *
     * @return string
     */
    public function getNomagence()
    {
        return $this->nomagence;
    }

    /**
     * Set localisation
     *
     * @param string $localisation
     *
     * @return Agence
     */
    public function setLocalisation($localisation)
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * Get localisation
     *
     * @return string
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Agence
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
     * Set specialisation
     *
     * @param string $specialisation
     *
     * @return Agence
     */
    public function setSpecialisation($specialisation)
    {
        $this->specialisation = $specialisation;

        return $this;
    }

    /**
     * Get specialisation
     *
     * @return string
     */
    public function getSpecialisation()
    {
        return $this->specialisation;
    }

    /**
     * Set responsable
     *
     * @param string $responsable
     *
     * @return Agence
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return string
     */
    public function getResponsable()
    {
        return $this->responsable;
    }
}
