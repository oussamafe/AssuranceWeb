<?php
/**
 * Created by PhpStorm.
 * User: Oussama Fezzani
 * Date: 14/04/2019
 * Time: 16:06
 */

namespace UserBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use FOS\CommentBundle\Entity\Thread as BaseThread;

/**
 * @ORM\Entity(repositoryClass="UserBundle\Repository\ThreadRepository")
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Thread extends BaseThread
{
    /**
     * @var string $id
     *
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    protected $id;
}