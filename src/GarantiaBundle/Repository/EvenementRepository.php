<?php
/**
 * Created by PhpStorm.
 * User: marou
 * Date: 13/04/2019
 * Time: 22:20
 */

namespace GarantiaBundle\Repository;


use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\User ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/**
 * @ORM\Entity(repositoryClass="GarantiaBundle\Repository\EvenementRepository")
 */
class EvenementRepository extends EntityRepository
{
    public function VerifierParticipation($y,$u)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT p FROM GarantiaBundle:Participation p WHERE  p.idParticipant = :username and p.idEvenement = :evenement')  ;
        $query->setParameters(array(
            'username' => $u,
            'evenement' => $y
        ));
        return $query->getResult() ;
    }
    public function Rechercherparutilisateur($y,$z)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT p FROM GarantiaBundle:Participation p WHERE  p.idEvenement = :evenement and p.qrcode =:qrcode and p.etat=0 ')  ;
        $query->setParameters(array(
            'evenement' => $y,
            'qrcode'=>$z,

        ));
        return $query->getResult() ;
    }
    public function RechercherParticipation($y,$z)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT p.id FROM GarantiaBundle:Participation p WHERE  p.idEvenement = :evenement and p.qrcode =:qrcode and p.etat=0 ')  ;
        $query->setParameters(array(
            'evenement' => $y,
            'qrcode'=>$z,

        ));
        return $query->getResult() ;
    }
    public function NotifierParMail($y)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT IDENTITY(p.idParticipant) FROM GarantiaBundle:Participation p WHERE  p.idEvenement = :evenement');
        $query->setParameters(array(
            'evenement' => $y,
        ));
        $a = $query->getResult();
        dump($a);
        if (count($a) < 1)
        {
         return 1;
        }
        else
        {
            foreach ($a as $value) {

                $query2 = $this->getEntityManager()->createQuery("select v.email from AppBundle:User v 
        where v.id = :id ")->setParameter('id', $value);
                dump($query2->getResult());
                return $query2->getResult();
            }
        }

    }
    public function AfficherParDate()
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT e FROM GarantiaBundle:Evenement e WHERE e.date = (select min(b.date) from GarantiaBundle:Evenement b) ')  ;
        return $query->getResult() ;
    }
    public function AfficherParParticipant()
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT e FROM GarantiaBundle:Evenement e WHERE e.nbPlaces = (select min(b.nbPlaces) from GarantiaBundle:Evenement b) ')  ;
        return $query->getResult() ;
    }
    public function AppliquerReduction()
    {
        $query = $this->getEntityManager()
            ->createQuery('UPDATE e FROM GarantiaBundle:Devis e WHERE e.nbPlaces = (select min(b.nbPlaces) from GarantiaBundle:Evenement b) ')  ;
        return $query->getResult() ;
    }


    }
