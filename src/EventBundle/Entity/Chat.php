<?php

namespace RecBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chat
 *
 * @ORM\Table(name="chat")
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
     * @var integer
     *
     * @ORM\Column(name="id_emp", type="integer", nullable=false)
     */
    private $idEmp;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_admin", type="integer", nullable=false)
     */
    private $idAdmin;

    /**
     * @var string
     *
     * @ORM\Column(name="mgs", type="string", length=255, nullable=false)
     */
    private $mgs;



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
     * Set idEmp
     *
     * @param integer $idEmp
     *
     * @return Chat
     */
    public function setIdEmp($idEmp)
    {
        $this->idEmp = $idEmp;

        return $this;
    }

    /**
     * Get idEmp
     *
     * @return integer
     */
    public function getIdEmp()
    {
        return $this->idEmp;
    }

    /**
     * Set idAdmin
     *
     * @param integer $idAdmin
     *
     * @return Chat
     */
    public function setIdAdmin($idAdmin)
    {
        $this->idAdmin = $idAdmin;

        return $this;
    }

    /**
     * Get idAdmin
     *
     * @return integer
     */
    public function getIdAdmin()
    {
        return $this->idAdmin;
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
}
