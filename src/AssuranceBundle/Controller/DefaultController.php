<?php

namespace AssuranceBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use AssuranceBundle\Entity\TypeAssurance;
use AssuranceBundle\Form\TypeAssuranceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $assurance = $em->getRepository("AssuranceBundle:TypeAssurance")->findAll();


        /**
         * @var $paginator \knp\Component\Pager\Paginator
         */
        $paginator= $this->get('knp_paginator');

        $result = $paginator->paginate(
            $assurance, /* query NOT result */
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 2)

        );
        $message = null;
        return $this->render('@Assurance/Assurance/Affiche.html.twig', array('m' =>$result, 'message'=>$message));}
    public function AfficherAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $assurance = $em->getRepository("AssuranceBundle:TypeAssurance")->findAll();


        /**
         * @var $paginator \knp\Component\Pager\Paginator
         */
        $paginator= $this->get('knp_paginator');

        $result = $paginator->paginate(
            $assurance, /* query NOT result */
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 2)

        );
        $message = null;
        return $this->render('@Assurance/Assurance/Affiche.html.twig', array('m' =>$result, 'message'=>$message));
    }

    function SupprimerAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $devis = $em->getRepository('GarantiaBundle:Devis')->findBy(['idAssurance'=>$id]);
        $assurance = $em->getRepository("AssuranceBundle:TypeAssurance")->find($id);

        $message = 'existe';
        if($devis == null)
        {
            $message = null;
            $em->remove($assurance);
            $em->flush();
            return $this->redirectToRoute('esprit_test_affiche',array('message'=>$message));
        }

        return $this->render('@Assurance/Assurance/Affiche.html.twig', array('m' => $assurance , 'message'=>$message));



    }

    function AjouterAction(Request $request)
    {
        $assurance = new TypeAssurance();
        $Form = $this->createForm(TypeAssuranceType::class, $assurance);
        $Form->handleRequest($request);
        if ($Form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($assurance);
            $em->flush();
            return $this->redirectToRoute('esprit_test_affiche');
        }
        return $this->render('@Assurance/Assurance/Ajouter.html.twig',
            array('form' => $Form->createView()));
    }

    function ModifierAction(Request $request, $id)
    {
        $assurance = new TypeAssurance();
        $em = $this->getDoctrine()->getManager();
        $assurance = $em->getRepository("AssuranceBundle:TypeAssurance")->find($id);

        $Form = $this->createForm(TypeAssuranceType::class, $assurance);
        $Form->handleRequest($request);
        if ($Form->isSubmitted() && $Form->isValid()) {

            $em->flush();

            return $this->redirectToRoute('esprit_test_affiche');

        }
        return $this->render('@Assurance/Assurance/modifier.html.twig', array('form' => $Form->createView()));
    }

    function rechercherAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $assurance = $em->getRepository("AssuranceBundle:TypeAssurance")->findAll();
        if($request->isMethod('POST'))
        {
            $nom=$request->get('nom');
            $assurance = $em->getRepository("AssuranceBundle:TypeAssurance")->findBy(array("nom"=>$nom));
        }
        return $this->render('@Assurance/Assurance/rechercher.html.twig', array('m' => $assurance));
    }

}
