<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 15/04/2019
 * Time: 17:06
 */

namespace GarantiaBundle\Controller;


class AffectationController
{
    public function ajouterincidentAction(Request $request)
    {

        $incident = new Incident();

        $form = $this->createForm(IncidentType::class,$incident);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $incident->setEtat(0);
            $incident->setIdExpert(null);
            $incident->setIdConstat(null);
            $incident->setIdClient(null);
            $incident->setIdAssurance(null);





            //$nom_image = $form['file']->getData();
            //$evenement->setImage($nom_image);
            //$evenement->uploadProfilePicture();

            $em = $this->getDoctrine()->getManager();
            $em->persist($incident);
            $em->flush();


            return $this->redirect('http://localhost/Garantia/Assurance/web/app_dev.php/afficherincident');

        }
        return $this->render('@Garantia/Jugement/ajouterincident.html.twig', array('form3' => $form->createView(),
            'r' => $incident));
    }

    public function supprimerincidentAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $incident = $em->getRepository("GarantiaBundle:Incident")->find($id);

        if (!$incident) {
            throw $this->createNotFoundException(
                'There are no incident with the following id: ' . $id
            );
        }

        $em->remove($incident);
        $em->flush();

        return $this->redirect('http://localhost/Garantia/Assurance/web/app_dev.php/AffichierIncident');

    }
    public function modifierincidentAction($id,Request $request)
    {
        $em=$this->getDoctrine()->getManager() ;
        $incident=$em->getRepository("GarantiaBundle:Incident")->find($id) ;
        $formaffecter = $this->createForm(IncidentAffectation::class,$incident);
        $formaffecter->handleRequest($request) ;

        if ($formaffecter->isSubmitted()&&$formaffecter->isValid())
        {
            $incident->setEtat(1);
            $em->flush();
            return $this->redirectToRoute('http://localhost/Garantia/Assurance/web/app_dev.php/Garantia/afficheraffecter');
        }
        return $this->render('@Garantia/Incident/ModifierAffecter.html.twig', array(

            'f'=>$formaffecter->createView()
        ));
    }

}