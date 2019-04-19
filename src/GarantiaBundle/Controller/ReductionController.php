<?php

namespace GarantiaBundle\Controller;

use GarantiaBundle\Entity\Reduction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Garantia\src\GarantiaBundle\Resources\views\Reduction\AjouterReduction ;
use GarantiaBundle\Form\ReductionType;
use Swift_Attachment ;

use Endroid\QrCode\QrCode;
 use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;

class ReductionController extends Controller
{
    public function AjoutAction(Request $request)
    {

        $reduction = new Reduction();
        $form = $this->createForm(ReductionType::class,$reduction);
        $qrCode = new QrCode();

        $form->handleRequest($request);
        if ($form->isSubmitted() ) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reduction);
            $em->flush();




            return $this->redirectToRoute('_afficherreduction');
        }


        return $this->render('@Garantia/Reduction/AjouterReduction.html.twig', array('form' => $form->createView(),
                'r' => $reduction,'q'=>$qrCode)
        );
    }

    public function AfficherAction(Request $request)
    {



        $em = $this->getDoctrine()->getManager();
        $reductions = $em->getRepository("GarantiaBundle:Reduction")->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         *
         */
        $paginator=$this->get('knp_paginator') ;
       $resultat= $paginator->paginate($reductions,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',10)
        );

        return $this->render('@Garantia/Reduction/AfficherReduction.html.twig', array(
            'pagination' => $resultat
        ));

    }

    public function DeleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $reduction = $em->getRepository("GarantiaBundle:Reduction")->find($id);

        if (!$reduction) {
            throw $this->createNotFoundException(
                'There are no arti with the following id: ' . $id
            );
        }

        $em->remove($reduction);
        $em->flush();

        return $this->redirectToRoute('_afficherreduction');

    }

    public function ModifierAction($id,Request $request)
    {
        $em=$this->getDoctrine()->getManager() ;
        $reduction=$em->getRepository("GarantiaBundle:Reduction")->find($id) ;
        $form = $this->createForm(ReductionType::class,$reduction);
        $form->handleRequest($request) ;

        if ($form->isSubmitted()&&$form->isValid())
        {

            $em->flush();
            return $this->redirectToRoute('_afficherreduction');
        }
        return $this->render('@Garantia/Reduction/ModifierReduction.html.twig', array(

            'f'=>$form->createView()
        ));
    }

}
