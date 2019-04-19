<?php
/**
 * Created by PhpStorm.
 * User: Oussama Fezzani
 * Date: 16/04/2019
 * Time: 12:38
 */

namespace GarantiaBundle\Repository;


class ActualiteRepository extends \Doctrine\ORM\EntityRepository
{

    public function mostViewedArticle()
    {
        $query = $this->getEntityManager()->createQuery("select v from GarantiaBundle:Actualite v 
        ORDER BY v.views DESC ")->setMaxResults(1);
        return $query->getResult();
    }

    public function mostCommentedArticle()
    {
        $query = $this->getEntityManager()->createQuery("select v from UserBundle:Thread v 
        ORDER BY v.numComments DESC ")->setMaxResults(1);
        $ar = $query->getResult();
        $id = $ar[0]->getId();




        $query1 = $this->getEntityManager()->createQuery("select v from GarantiaBundle:Actualite v WHERE v.id= :id")
            ->setParameter('id', $id);
        $res = $query1->getResult();

        $array = [
            'article' => $res[0],
            'thread' => $ar[0],
        ];

        return $array;
    }

}