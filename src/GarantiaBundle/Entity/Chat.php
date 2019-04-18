<?php

namespace GarantiaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chat
 *
 * @ORM\Table(name="chat", indexes={@ORM\Index(name="fk_chat_admin", columns={"id_admin"}), @ORM\Index(name="fk_chat_emp", columns={"id_emp"}) })
 * @ORM\Entity
 */
class Chat
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
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_emp", referencedColumnName="id")
     * })
     */
    private $idEmp;


    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_admin", referencedColumnName="id")
     * })
     */
    private $idAdmin;

    /**
     * @var string
     *
     * @ORM\Column(name="mgs", type="string", length=255, nullable=false)
     */
    private $mgs;
    /**
     * @var integer
     *
     * @ORM\Column(name="dest", type="integer", nullable=false)
     */
    private $dest;



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
     * Set mgs
     *
     * @param string $mgs
     *
     * @return Chat
     */
    public function setMgs($mgs)
    {
        $this->mgs = $mgs;

        return $this;
    }

    /**
     * Get mgs
     *
     * @return string
     */
    public function getMgs()
    {
        return $this->mgs;
    }

    /**
     * Set dest
     *
     * @param integer $dest
     *
     * @return Chat
     */
    public function setDest($dest)
    {
        $this->dest = $dest;

        return $this;
    }

    /**
     * Get dest
     *
     * @return integer
     */
    public function getDest()
    {
        return $this->dest;
    }

    /**
     * Set idEmp
     *
     * @param \UserBundle\Entity\User $idEmp
     *
     * @return Chat
     */
    public function setIdEmp(\UserBundle\Entity\User $idEmp = null)
    {
        $this->idEmp = $idEmp;

        return $this;
    }

    /**
     * Get idEmp
     *
     * @return \UserBundle\Entity\User
     */
    public function getIdEmp()
    {
        return $this->idEmp;
    }

    /**
     * Set idAdmin
     *
     * @param \UserBundle\Entity\User $idAdmin
     *
     * @return Chat
     */
    public function setIdAdmin(\UserBundle\Entity\User $idAdmin = null)
    {
        $this->idAdmin = $idAdmin;

        return $this;
    }

    /**
     * Get idAdmin
     *
     * @return \UserBundle\Entity\User
     */
    public function getIdAdmin()
    {
        return $this->idAdmin;
    }
}
