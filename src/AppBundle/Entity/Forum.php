<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Forum
 *
 * @ORM\Table(name="forum", indexes={@ORM\Index(name="form_usr", columns={"id_user"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentaireRepository")
 */
class Forum
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_f", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idF;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="description_f", type="string", length=30, nullable=false)
     */
    private $descriptionF;

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
     * @var integer
     *
     * @ORM\Column(name="ETAT", type="integer", nullable=false)
     */
    private $etat = '0';

    private $countComments ;

    private $bloque ;



    /**
     * @return mixed
     */
    public function getBloque()
    {
        return $this->bloque;
    }

    /**
     * @param mixed $bloque
     */
    public function setBloque($bloque)
    {
        $this->bloque = $bloque;
    }





    /**
     * @return int
     */
    public function getIdF()
    {
        return $this->idF;
    }

    /**
     * @param int $idF
     */
    public function setIdF($idF)
    {
        $this->idF = $idF;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getDescriptionF()
    {
        return $this->descriptionF;
    }

    /**
     * @param string $descriptionF
     */
    public function setDescriptionF($descriptionF)
    {
        $this->descriptionF = $descriptionF;
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

    /**
     * @return mixed
     */
    public function getCountComments()
    {
        return $this->countComments;
    }

    /**
     * @param mixed $countComments
     */
    public function setCountComments($countComments)
    {
        $this->countComments = $countComments;
    }


    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return Forum
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return integer
     */
    public function getEtat()
    {
        return $this->etat;
    }









}
