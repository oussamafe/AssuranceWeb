<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 13/04/2019
 * Time: 14:14
 */
namespace GarantiaBundle\Controller;

use GarantiaBundle\Entity\Jugement;
use GarantiaBundle\Entity\Incident;

use Symfony\Component\HttpFoundation\Request;

use GarantiaBundle\Form\JugementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JugementController extends Controller
{
    public function AjoutAction(Request $request)
    {
        $jugement = new Jugement();
        $form = $this->createForm(JugementType::class,$jugement);
        $form->handleRequest($request);

        $data = $form['idIncident']->getData();
        $em = $this->getDoctrine()->getManager();
        $incident = $em->getRepository("GarantiaBundle:Incident")->findOneBy(array('id'=>$data));



        if ($form->isSubmitted() && $form->isValid()) {
            $incident->setEtat(3);

            //$nom_image = $form['file']->getData();
            //$evenement->setImage($nom_image);
            //$evenement->uploadProfilePicture();

            $em = $this->getDoctrine()->getManager();
            $em->persist($jugement);
            $em->flush();


            return $this->redirect('http://localhost/Assurance/web/app_dev.php/admin/Afficher');

        }
        return $this->render('@Garantia/Jugement/AjouterJugement.html.twig', array('form2' => $form->createView(),
            'r' => $jugement));
    }
    public function AfficherAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $jugements = $em->getRepository("GarantiaBundle:Jugement")->findAll();
        return $this->render('@Garantia/Jugement/AfficherJugement.html.twig', array(
            'jugements' => $jugements
        ));
    }
    public function afficherjugementAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $jugements = $em->getRepository("GarantiaBundle:Jugement")->findAll();
        return $this->render('@Garantia/Jugement/AfficherJugementClient.html.twig', array(
            'jugements' => $jugements
        ));
    }
    public function supprimerjugementAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $jugement = $em->getRepository("GarantiaBundle:Jugement")->find($id);

        if (!$jugement) {
            throw $this->createNotFoundException(
                'There are no jugement with the following id: ' . $id
            );
        }

        $em->remove($jugement);
        $em->flush();

        return $this->redirect('http://localhost/Garantia/Assurance/web/app_dev.php/Garantia/admin/Afficher');

    }
    public function modifierjugementAction($id,Request $request)
    {
        $em=$this->getDoctrine()->getManager() ;
        $jugement=$em->getRepository("GarantiaBundle:Jugement")->find($id) ;
        $form2 = $this->createForm(JugementType::class,$jugement);
        $form2->handleRequest($request) ;

        if ($form2->isSubmitted()&&$form2->isValid())
        {

            $em->flush();
            return $this->redirectToRoute('http://localhost/Garantia/Assurance/web/app_dev.php/admin/Afficher');
        }
        return $this->render('@Garantia/Jugement/ModifierJugement.html.twig', array(

            'f'=>$form2->createView()
        ));
    }



}