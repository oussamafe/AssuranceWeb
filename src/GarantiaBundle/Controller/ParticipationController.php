<?php
/**
 * Created by PhpStorm.
 * User: marou
 * Date: 10/04/2019
 * Time: 19:01
 */

namespace GarantiaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ParticipationController extends  Controller

{
    public function AfficherAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $u=$user->getId();
        $evenements = $em->getRepository("GarantiaBundle:Evenement")->findAll();
        $evenements2=$em->getRepository("GarantiaBundle:Evenement")->AfficherParDate()  ;
        $evenements3=$em->getRepository("GarantiaBundle:Evenement")->AfficherParParticipant()  ;
        dump($evenements2);
        $p=$em->getRepository("GarantiaBundle:Evenement");
        return $this->render('@Garantia/Reduction/Participation.html.twig', array(
            'evenements' => $evenements,
            'p'=>$p,
            'u'=>$u,
            'evenements2' => $evenements2,
            'evenements3' => $evenements3,

        ));
    }



}