<?php

namespace  AgenceBundle\Repository;


class AgenceRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByNomagence($str)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT e
                FROM AgenceBundle:agence e
                WHERE e.nomagence LIKE :str'
            )
            ->setParameter('str', '%' . $str . '%')
            ->getResult();
    }
}
