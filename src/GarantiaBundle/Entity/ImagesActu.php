<?php

namespace GarantiaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImagesActu
 *
 * @ORM\Table(name="images_actu", indexes={@ORM\Index(name="fk_img_actu", columns={"id_actu"})})
 * @ORM\Entity
 */
class ImagesActu
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
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var \Actualite
     *
     * @ORM\ManyToOne(targetEntity="Actualite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_actu", referencedColumnName="id")
     * })
     */
    private $idActu;



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
     * Set url
     *
     * @param string $url
     *
     * @return ImagesActu
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set idActu
     *
     * @param \GarantiaBundle\Entity\Actualite $idActu
     *
     * @return ImagesActu
     */
    public function setIdActu(\GarantiaBundle\Entity\Actualite $idActu = null)
    {
        $this->idActu = $idActu;

        return $this;
    }

    /**
     * Get idActu
     *
     * @return \GarantiaBundle\Entity\Actualite
     */
    public function getIdActu()
    {
        return $this->idActu;
    }
}
