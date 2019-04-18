<?php

namespace DepartementBundle\Controller;

use blackknight467\StarRatingBundle\DependencyInjection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Rate;
use UserBundle\Entity\service;
use UserBundle\Form\RateType;
use UserBundle\Form\service2Type;
use UserBundle\Form\serviceType;

class ServiceController extends Controller
{
    public function afficherAction()
    {
        $m = $this->getDoctrine()->getManager();
        $servises = $m->getRepository('UserBundle:service')->findAll();
        return $this->render('DepartementBundle:Services:gestionService.html.twig',
            array(
                'services' => $servises,
            )
        );
    }

    public function afficherSericeParDepartementAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $request->attributes->get('id');
        $dep = $em->getRepository('UserBundle:departement')->find($id);
        $services = $em->getRepository('UserBundle:service')->findBy(['departement' => $dep]);

        foreach ($services as $service) {
            $service->setRating($this->calculerVote($service, $request));
        }

        return $this->render('DepartementBundle:Services:gestionService.html.twig',
            array(
                'services' => $services,
            )
        );


    }


    public function afficherServicesUtilisateurAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $request->attributes->get('id');
        $dep = $em->getRepository('UserBundle:departement')->find($id);
        $services = $em->getRepository('UserBundle:service')->findBy(['departement' => $dep]);


        $req = $em->getConnection()->prepare("select id,description from conseil");
        $req->execute();
        $conseil = $req->fetchAll();
        /**
         * @var $paginator \knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $services,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 3)


        );
        foreach ($services as $service) {
            $service->setRating($this->calculerVote($service, $request));
        }
        $departements = $em->getRepository('UserBundle:departement')->findAll();


        return $this->render('UserBundle:Default:Departements.html.twig',
            array(
                'conseil' => $conseil[array_rand($conseil)], 'services' => $result, 'depSelectionne' => $dep, 'departements' => $departements,
            )
        );
    }

    public function ajouterAction(Request $request)
    {
        {
            $service = new service();
            $form = $this->createForm(serviceType::class, $service);

            $form->handleRequest($request);
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $service->UploadProfilePicture();
                $em->persist($service);
                $em->flush();
                return $this->redirectToRoute('service_homepage');
            }

            return $this->render('@Departement/Services/AjoutService.html.twig', array('form' => $form->createView()));
        }

    }

    public function modifierAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $mark = $em->getRepository('UserBundle:service')->find($id);
        $form = $this->createForm(serviceType::class, $mark);
        $form->handleRequest($request);
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $mark->UploadProfilePicture();
            $em->persist($mark);
            $em->flush();
            return $this->redirectToRoute('service_homepage');
        }
        return $this->render('DepartementBundle:Services:ModifService.html.twig', array('form' => $form->createView()));
    }

    public function supprimerAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $service = $em->getRepository('UserBundle:service')->find($id);

        $em->remove($service);
        $em->flush();
        return $this->redirectToRoute('service_homepage');
    }


    public function showServiceAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $id = $request->attributes->get('id');
        $rate = $em->getRepository('UserBundle:Rate')->findOneBy(array('id_service' => $id, 'id_user' => $this->getUser()));
        $service = $em->getRepository('UserBundle:service')->find($id);

        $form = $this->createForm(RateType::class, $rate);
        $form->handleRequest($request);
        // $user = $this->container->get('security.context')->getToken()->getUser();

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if (count($rate) == 0) { //mafemech rate gdim
                $rate = new Rate();
                $rate->setIdMembre($this->getUser());
                $rate->setIdPublication($service);
                $rate->setValue($form['value']->getData());
                $em->persist($rate);
                $em->flush();

            } else {
                $em->persist($rate);
                $em->flush();
            }
        }

        return $this->render('@Departement/Services/detailService.html.twig', array('service' => $service, 'form' => $form->createView()));

    }

    public function calculerVote(service $service, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $x = 0.0;
        $rates = $em->getRepository('UserBundle:Rate')->findBy(array('id_service' => $service->getId()));
        foreach ($rates as $rate) {
            $x = $x + $rate->getValue();
        }
        if (count($rates) > 0) {
            $x = $x / count($rates);
        } else {
            $x = 0;
        }
        return round($x);
    }


}