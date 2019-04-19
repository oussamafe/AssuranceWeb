<?php
/**
 * Created by PhpStorm.
 * User: boussandel
 * Date: 30/03/2019
 * Time: 16:30
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class CommentaireRepository extends EntityRepository
{


    public function findParticipantDQL($iduser,$idEve)
    {
        $q = $this->getEntityManager()
            ->createQuery("SELECT v FROM AppBundle:Commentaire v
            WHERE v.idCom =$idEve");
        return $q->getResult();
    }

}