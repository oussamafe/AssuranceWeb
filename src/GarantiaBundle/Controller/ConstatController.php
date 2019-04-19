<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 14/04/2019
 * Time: 01:22
 */

namespace GarantiaBundle\Controller;
use GarantiaBundle\Entity\Constat;

use Symfony\Component\HttpFoundation\Request;

use GarantiaBundle\Form\ConstatType;
use GarantiaBundle\Form\IncidentAffectation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ConstatController extends Controller
{
    public function ajouterconstatAction(Request $request)
    {

        $constat = new Constat();

        $form4= $this->createForm(ConstatType::class,$constat);
        $form4->handleRequest($request);

        if ($form4->isSubmitted() && $form4->isValid()) {




            //$nom_image = $form['file']->getData();
            //$evenement->setImage($nom_image);
            //$evenement->uploadProfilePicture();

            $em = $this->getDoctrine()->getManager();
            $em->persist($constat);
            $em->flush();


            return $this->redirect('http://localhost/Garantia/Assurance/web/app_dev.php/afficherconstat');

        }
        return $this->render('@Garantia/Jugement/AjouterConstat.html.twig', array('form4' => $form4->createView(),
            'r' => $constat));
    }
    public function deleteconstatAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $constat = $em->getRepository("GarantiaBundle:Constat")->find($id);

        if (!$constat) {
            throw $this->createNotFoundException(
                'There are no constat with the following id: ' . $id
            );
        }

        $em->remove($constat);
        $em->flush();

        return $this->redirect('http://localhost/Garantia/Assurance/web/app_dev.php/Garantia/afficherconstat');

    }
    public function modifierconstatAction($id,Request $request)
    {
        $em=$this->getDoctrine()->getManager() ;
        $constat=$em->getRepository("GarantiaBundle:Constat")->find($id) ;
        $form4 = $this->createForm(ConstatType::class,$constat);
        $form4->handleRequest($request) ;

        if ($form4->isSubmitted()&&$form4->isValid())
        {

            $em->flush();
            return $this->redirectToRoute('http://localhost/Garantia/Assurance/web/app_dev.php/Garantia/afficherconstat');
        }
        return $this->render('@Garantia/Reduction/ModifierConstat.html.twig', array(

            'f'=>$form4->createView()
        ));
    }


}