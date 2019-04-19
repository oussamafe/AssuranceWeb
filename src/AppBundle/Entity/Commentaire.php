<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="user_com", columns={"id_user"}), @ORM\Index(name="com_forum", columns={"id_f"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentaireRepository")
 */
class Commentaire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_com", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_com", type="date", nullable=false)
     */
    private $dateCom;

    /**
     * @var string
     *
     * @ORM\Column(name="description_com", type="string", length=30, nullable=false)
     */
    private $descriptionCom;

    /**
     * @var \AppBundle\Entity\Forum
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Forum")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_f", referencedColumnName="id_f")
     * })
     */
    private $idF;

    /**
     * @var \UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @return int
     */
    public function getIdCom()
    {
        return $this->idCom;
    }

    /**
     * @param int $idCom
     */
    public function setIdCom($idCom)
    {
        $this->idCom = $idCom;
    }

    /**
     * @return \DateTime
     */
    public function getDateCom()
    {
        return $this->dateCom;
    }

    /**
     * @param \DateTime $dateCom
     */
    public function setDateCom($dateCom)
    {
        $this->dateCom = $dateCom;
    }

    /**
     * @return string
     */
    public function getDescriptionCom()
    {
        return $this->descriptionCom;
    }

    /**
     * @param string $descriptionCom
     */
    public function setDescriptionCom($descriptionCom)
    {
        $this->descriptionCom = $descriptionCom;
    }

    /**
     * @return Forum
     */
    public function getIdF()
    {
        return $this->idF;
    }

    /**
     * @param Forum $idF
     */
    public function setIdF($idF)
    {
        $this->idF = $idF;
    }

    /**
     * @return User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param User $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }





}

