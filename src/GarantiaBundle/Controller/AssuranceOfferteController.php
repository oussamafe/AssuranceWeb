<?php
/**
 * Created by PhpStorm.
 * User: marou
 * Date: 08/04/2019
 * Time: 20:55
 */

namespace GarantiaBundle\Controller;

use GarantiaBundle\Entity\AssuranceOfferte;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Garantia\src\GarantiaBundle\Resources\views\Reduction\AjouterOfferte ;
use GarantiaBundle\Form\AssuranceOfferteType;


class AssuranceOfferteController extends Controller
{
    public function AjoutAction(Request $request)
    {

        $offerte = new AssuranceOfferte();
        $form = $this->createForm(AssuranceOfferteType::class,$offerte);

        $form->handleRequest($request);
        if ($form->isSubmitted() ) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($offerte);
            $em->flush();

            return $this->redirectToRoute('_afficherreassuranceo');
        }


        return $this->render('@Garantia/Reduction/AjouterOfferte.html.twig', array('form3' => $form->createView(),
                'a' => $offerte)
        );
    }
    public function AfficherAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $offertes = $em->getRepository("GarantiaBundle:AssuranceOfferte")->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         *
         */
        $paginator=$this->get('knp_paginator') ;
        $resultat= $paginator->paginate($offertes,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',10)
        );

        return $this->render('@Garantia/Reduction/AfficherOfferte.html.twig', array(
            'pagination' => $resultat
        ));
    }
    public function DeleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $offerte = $em->getRepository("GarantiaBundle:AssuranceOfferte")->find($id);

        if (!$offerte) {
            throw $this->createNotFoundException(
                'There are no arti with the following id: ' . $id
            );
        }

        $em->remove($offerte);
        $em->flush();

        return $this->redirectToRoute('_afficherreassuranceo');

    }

    public function ModifierAction($id,Request $request)
    {
        $em=$this->getDoctrine()->getManager() ;
        $offerte=$em->getRepository("GarantiaBundle:AssuranceOfferte")->find($id) ;
        $form = $this->createForm(AssuranceOfferteType::class,$offerte);
        $form->handleRequest($request) ;

        if ($form->isSubmitted()&&$form->isValid())
        {

            $em->flush();
            return $this->redirectToRoute('_afficherreassuranceo');
        }
        return $this->render('@Garantia/Reduction/ModifierOfferte.html.twig', array(

            'f5'=>$form->createView()
        ));
    }














}