<?php

namespace DepartementBundle\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Form\departementType;
use UserBundle\Entity\departement;


class DepartementController extends Controller
{

    public function afficherAction()
    {


        $em = $this->getDoctrine()->getManager();


        $departement = $em->getRepository('UserBundle:departement')->findAll();

        foreach ($departement as $dep) {
            $services = $em->getRepository('UserBundle:service')->findBy(['departement' => $dep]);
            $dep->setService($services);
        }


        //$nom = $departements['nom'];
        //$id = $departements['id'];


        return $this->render('DepartementBundle:Departement:gestionDepartement.html.twig', array(
            'departements' => $departement
        ));
    }

    public function afficherDepartementAction(Request $request)
    {

        $m = $this->getDoctrine()->getManager();
        $id = $request->attributes->get('id');
        $departements = array();

        $dep = $m->getRepository('UserBundle:departement')->find($id);
        array_push($departements, $dep);

        foreach ($departements as $dep) {
            $services = $m->getRepository('UserBundle:service')->findBy(array('departement' => $dep));
            $dep->setService($services);
        }
        return $this->render('DepartementBundle:Departement:gestionDepartement.html.twig',
            array(
                'departements' => $departements,
            )
        );
    }

    public function ajouterAction(Request $request)
    {
        {
            $departement = new departement();
            $form = $this->createForm(departementType::class, $departement);
            $form->handleRequest($request);
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $departement->UploadProfilePicture();
                $em->persist($departement);
                $em->flush();
                return $this->redirectToRoute('departement_homepage');
            }

            return $this->render('@Departement/Departement/AjoutDepartement.html.twig', array('form' => $form->createView()));
        }

    }


    public function modifierAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $mark = $em->getRepository('UserBundle:departement')->find($id);
        $form = $this->createForm(departementType::class, $mark);
        if ($form->handleRequest($request)->isValid()) {
            $em->persist($mark);
            $em->flush();
            return $this->redirectToRoute('departement_homepage');
        }
        return $this->render('DepartementBundle:Departement:ModifDepartement.html.twig', array('form' => $form->createView()));
    }

    public function supprimerAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $departement = $em->getRepository('UserBundle:departement')->find($id);
        $em->remove($departement);
        $em->flush();
        return $this->redirectToRoute('departement_homepage');
    }


}
