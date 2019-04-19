<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 13/04/2019
 * Time: 17:19
 */

namespace GarantiaBundle\Controller;

use GarantiaBundle\Entity\Incident;
use GarantiaBundle\Entity\Rendezvous;

use Symfony\Component\HttpFoundation\Request;

use GarantiaBundle\Form\IncidentType;
use GarantiaBundle\Form\RendezvousType;
use GarantiaBundle\Form\IncidentAffectation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;


class IncidentController extends Controller
{
    public function indexAction()
    {
        {
            $pieChart = new PieChart();
            $em = $this->getDoctrine();

            $incidents = $em->getRepository('GarantiaBundle:Incident')->findAll();

            $totalEtudiant = 0;


            foreach ($incidents as $classe) {
                if ($classe != NULL) {
                    $totalEtudiant = $totalEtudiant + 1;
                }
            }

            $data = array();
            $stat = ['Type', 'nb'];
            $nb = 0;
            array_push($data, $stat);
            foreach ($incidents as $classe) {
                $stat = array();
                array_push($stat, $classe->getCommentaire(), (($classe->getEtat())));
                $nb = ($classe->getEtat() * 100) / $totalEtudiant;
                $stat = [$classe->getCommentaire(), $nb];
                array_push($data, $stat);
            }

            $pieChart->getData()->setArrayToDataTable(
                $data
            );
            $pieChart->getOptions()->setTitle('Statistiques sur les états des incidents');
            $pieChart->getOptions()->setHeight(500);
            $pieChart->getOptions()->setWidth(900);
            $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
            $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
            $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
            $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
            $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
            //return $this->render('@Graphe\Default\index.html.twig', array('piechart' => $pieChart));
            return $this->render('@Garantia\Jugement\index.html.twig', array('piechart' => $pieChart));

        }
    }


    public function ajouterincidentAction(Request $request)
    {

        $incident = new Incident();

        $form = $this->createForm(IncidentType::class, $incident);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $incident->setEtat(0);
            $incident->setIdExpert(null);
            $incident->setIdConstat(null);
            $incident->setIdClient($user);
            $incident->setIdAssurance(null);


            //$nom_image = $form['file']->getData();
            //$evenement->setImage($nom_image);
            //$evenement->uploadProfilePicture();

            $em = $this->getDoctrine()->getManager();
            $em->persist($incident);
            $em->flush();


            return $this->redirect('http://localhost/Assurance/web/app_dev.php/afficherincident');

        }
        return $this->render('@Garantia/Jugement/ajouterincident.html.twig', array('form3' => $form->createView(),
            'r' => $incident));
    }

    public function afficherincidentAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $incidents = $em->getRepository("GarantiaBundle:Incident")->findAll();
        return $this->render('@Garantia/Jugement/AfficherIncident.html.twig', array(
            'incidents' => $incidents
        ));
    }

    public function afficheraffecterAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $incidents = $em->getRepository("GarantiaBundle:Incident")->findAll();
        return $this->render('@Garantia/Jugement/AfficherAffecter.html.twig', array(
            'incidents' => $incidents
        ));
    }

    public function affecterrendezvousAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $incidents = $em->getRepository("GarantiaBundle:Incident")->findAll();
        return $this->render('@Garantia/Jugement/AffecterRendezvous.html.twig', array(
            'incidents' => $incidents
        ));
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

        return $this->redirect('http://localhost/Assurance/web/app_dev.php/afficherincident');

    }

    public function modifierincidentAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $incident = $em->getRepository("GarantiaBundle:Incident")->find($id);
        $form3 = $this->createForm(IncidentType::class, $incident);
        $form3->handleRequest($request);

        if ($form3->isSubmitted() && $form3->isValid()) {

            $em->flush();
            return $this->redirect('http://localhost/Assurance/web/app_dev.php/afficherincident');
        }
        return $this->render('@Garantia/Jugement/ModifierIncident.html.twig', array(

            'f' => $form3->createView()
        ));
    }

    public function affecterincidentAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $incident = $em->getRepository("GarantiaBundle:Incident")->find($id);
        $formaffecter = $this->createForm(IncidentAffectation::class, $incident);
        $formaffecter->handleRequest($request);
        if ($formaffecter->isSubmitted() && $formaffecter->isValid()) {
            $incident->setEtat(1);
            $em->flush();
            return $this->redirect('http://localhost/Assurance/web/app_dev.php/admin/afficheraffecter');
        }

        return $this->render('@Garantia/Jugement/AffecterIncident.html.twig', array(

            'f3' => $formaffecter->createView()
        ));
    }

    public function expertrendezvousAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();
        $incidents = $em->getRepository("GarantiaBundle:Incident")->findBy(['id' => $id]);

        return $this->redirectToRoute('_ajouterrendezvous');


    }

    public function Tri1Action(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = "SELECT `id`, `id_client` as idClient , `id_assurance`as idAssurance , `date_incident` as dateIncident, `image1` as image1, `image2`as image2, `image3` as image3, `commentaire`as Commentaire, `etat`as etat, `id_constat` as idConstat , `id_expert` as idExpert from incident WHERE DATEDIFF(CURDATE(),date_incident)>3";

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll();

        return $this->render('@Garantia/Jugement/AfficherAffecter.html.twig', ['incidents' => $result]);
    }


}
