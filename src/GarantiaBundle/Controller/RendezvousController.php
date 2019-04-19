<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 13/04/2019
 * Time: 14:14
 */
namespace GarantiaBundle\Controller;

use GarantiaBundle\Entity\Rendezvous;

use Symfony\Component\HttpFoundation\Request;

use GarantiaBundle\Form\RendezvousType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RendezvousController extends Controller
{
    public function ajouterrendezvousAction(Request $request , $id)
    {

        $rendezvous = new Rendezvous();

        $form = $this->createForm(RendezvousType::class,$rendezvous);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //$nom_image = $form['file']->getData();
            //$evenement->setImage($nom_image);
            //$evenement->uploadProfilePicture();
            $em = $this->getDoctrine()->getManager();
            $incident = $em->getRepository("GarantiaBundle:Incident")->findOneBy(['id' => $id]);
            $rendezvous->setIdIncident($incident);
            $incident->setEtat(2);
            $userManager = $this->get('fos_user.user_manager');
            $user = $userManager->findUserBy(array('id'=>$incident->getIdClient()));

            $rendezvous->setIdClient($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($rendezvous);
            $em->flush();


            return $this->redirectToRoute('_afficherrendezvous');

        }
        return $this->render('@Garantia/Jugement/AjouterRendezvous.html.twig', array('formrendez' => $form->createView(),
            'r' => $rendezvous));
    }
    public function afficherrendezvousAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rendezvouss = $em->getRepository("GarantiaBundle:Rendezvous")->findAll();
        return $this->render('@Garantia/Jugement/AfficherRendezvous.html.twig', array(
            'rendezvouss' => $rendezvouss
        ));
    }
    public function supprimerrendezvousAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $rendezvous = $em->getRepository("GarantiaBundle:Rendezvous")->find($id);

        if (!$rendezvous) {
            throw $this->createNotFoundException(
                'There are no rendezvous with the following id: ' . $id
            );
        }

        $em->remove($rendezvous);
        $em->flush();

        return $this->redirectToRoute('_afficherrendezvous');

    }
    public function modifierrendezvousAction($id,Request $request)
    {
        $em=$this->getDoctrine()->getManager() ;
        $rendezvous=$em->getRepository("GarantiaBundle:Rendezvous")->find($id) ;
        $form2 = $this->createForm(RendezvousType::class,$rendezvous);
        $form2->handleRequest($request) ;

        if ($form2->isSubmitted()&&$form2->isValid())
        {

            $em->flush();
            return $this->redirectToRoute('http://localhost/Garantia/Assurance/web/app_dev.php/Garantia/admin/afficherrendezvous');
        }
        return $this->render('@Garantia/Jugement/ModifierRendezvous.html.twig', array(

            'f'=>$form2->createView()
        ));
    }

    public function verifierRdzAction()
    {
        $em = $this->getDoctrine()->getManager();
        $rendezvouss = $em->getRepository("GarantiaBundle:Rendezvous")->findBy(['idClient' => 16]);
        return $this->render('@Garantia/Jugement/Rendezvousclient.html.twig',array('rendezvouss'=>$rendezvouss));
    }

}