<?php

namespace AgenceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AgenceBundle\Entity\Agence;
use AgenceBundle\Form\AgenceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $agence= $em->getRepository("AgenceBundle:Agence")->findAll();
        $paginator= $this->get('knp_paginator');

        $result = $paginator->paginate(
            $agence, /* query NOT result */
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 2)
        );

        return $this->render('@Agence/Agence/Afficher.html.twig', array('m' => $result));
    }

    public function  AfficherAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $agence= $em->getRepository("AgenceBundle:Agence")->findAll();
        $paginator= $this->get('knp_paginator');

        $result = $paginator->paginate(
            $agence, /* query NOT result */
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 2)
        );

        return $this->render('@Agence/Agence/Afficher.html.twig',  array('m' => $result));
    }
    function  SupprimerAction($IdAgence)
    { $em=$this->getDoctrine()->getManager();
        $agence=$em->getRepository("AgenceBundle:Agence")->find($IdAgence);
        $em->remove($agence);
        $em->flush();
        return $this->redirectToRoute('Afficher');

    }
    function  modifierAction(Request $request,$IdAgence){
        $agence =new Agence();
        $em=$this->getDoctrine()->getManager();
        $agence=$em->getRepository("AgenceBundle:Agence")->find($IdAgence);

        $Form=$this->createForm(AgenceType::class,$agence) ;
        $Form->handleRequest($request);
        if($Form->isSubmitted() && $Form->isValid()){

            $em->flush();

            return $this->redirectToRoute('Afficher');

        }
        return $this->render('@Agence/Agence/modifier.html.twig',array('form'=>$Form->createView()));
    }
    function  AjouterAction(Request $request)
    {
        $agence= new Agence();
        $Form=$this->createForm(AgenceType::class,$agence);
        $Form->handleRequest($request);
        if($Form->isSubmitted() && $Form->isValid() )
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($agence);
            $em->flush();
            return $this->redirectToRoute('Afficher');

        }
        return $this->render('@Agence/Agence/Ajouter.html.twig',array('form'=>$Form->createView()));
    }

    public function  Afficher2Action()
    {
        $em = $this->getDoctrine()->getManager();
        $agence= $em->getRepository("AgenceBundle:Agence")->findAll();
        return $this->render('@Agence/Agence/Afficher2.html.twig', array('m' => $agence));
    }

    public function AgenceAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $requestString = $request->get('q');
        $entities = $em->getRepository('AgenceBundle:Agence')->findByNomagence($requestString);
        if (!$entities) {
            $result['entities']['error'] = "cet agence n'existe pas ";
        } else {
            $result['entities'] = $this->getRealEntities($entities);
        }
        return new Response(json_encode($result));

    }


    public function getRealEntities($entities)
    {
        foreach ($entities as $entity) {
            $realEntities[
            $entity->getIdAgence()] = [

                $entity->getNomagence(),
                $entity->getLocalisation(),
                $entity->getDescription(),
                $entity->getSpecialisation()
            ];

        }
        return $realEntities;
    }


    public function TrierAction(Request $request)
    {
        $localisation=$request->get('localisation');
        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = "SELECT * FROM agence WHERE  $localisation='Bizerte' ";
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll();

        return $this->render('@Agence/Agence/Afficher2.html.twig',['posts'=>$result]);
    }

}

