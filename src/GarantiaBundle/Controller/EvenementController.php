<?php
/**
 * Created by PhpStorm.
 * User: marou
 * Date: 07/04/2019
 * Time: 23:04
 */

namespace GarantiaBundle\Controller;

use Doctrine\DBAL\Types\IntegerType;
use GarantiaBundle\Entity\Participation;
use UserBundle\Entity\User;
use http\Exception;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Garantia\src\GarantiaBundle\Resources\views\Reduction\AjouterReduction;
use GarantiaBundle\Entity\Evenement;
use GarantiaBundle\Form\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swift_Attachment;

use Endroid\QrCode\QrCode;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;


class EvenementController extends Controller
{
    public function AjoutAction(Request $request)
    {

        $evenement = new Evenement();

        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //$nom_image = $form['file']->getData();
            //$evenement->setImage($nom_image);
            //$evenement->uploadProfilePicture();

            $em = $this->getDoctrine()->getManager();
            $em->persist($evenement);
            $em->flush();


            return $this->redirectToRoute('_afficherevenement');

        }
        return $this->render('@Garantia/Reduction/AjouterEvenement.html.twig', array('form2' => $form->createView(),
                'r' => $evenement)
        );
    }

    public function AjoutPAction(Request $request, $event)
    {
        $participation = new Participation();


        $qrCode = new QrCode();
        $participation->setQrcode(md5(uniqid()));
        $qrCode->setText($participation->getQrcode())
            ->setSize(300)
            ->setErrorCorrectionLevel('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0));
        $qrCode->writeFile(__DIR__ . '/qrcode.png');

        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $email = $user->getEmail();
        $mailer = $this->get('mailer');
        $message = $mailer->createMessage()
            ->setSubject('Vous etes inscrits à evenement')
            ->setFrom('marou.khadhraoui@gmail.com')
            ->setTo($email)
            ->attach(Swift_Attachment::fromPath(__DIR__ . '/qrcode.png'));

        $mailer->send($message);
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("GarantiaBundle:Evenement")->find($event);
        $participation->setIdEvenement($evenement);
        $user = $this->getUser();
        $participation->setIdParticipant($user);
        $participation->setEtat('1');

        $evenement->setNbPlaces(($evenement->getNbPlaces() - 1));

        $em = $this->getDoctrine()->getManager();
        $em->persist($participation);
        $em->flush();
        return $this->redirectToRoute('_AfficherEventFront');

    }

    public function AfficherAction(Request $request)
    {
        $now = date("Y-m-d");
        $date = date("Y-m-d", strtotime('+24 hours', strtotime($now)));
        $em = $this->getDoctrine()->getManager();
        $evenements = $em->getRepository("GarantiaBundle:Evenement")->findAll();
        $f = $em->getRepository("GarantiaBundle:Evenement");
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         *
         */
        $paginator = $this->get('knp_paginator');
        $resultat = $paginator->paginate($evenements,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 2)
        );
        foreach ($evenements as $value) {
            if ($value->getDate()->format("Y-m-d") == $date) {
                $b = $em->getRepository("GarantiaBundle:Evenement")->NotifierParMail($value->getId());
                if ($b = !1) {
                    foreach ($b as $m) {
                        $z = implode('', $m);
                        $mailer = $this->get('mailer');
                        $message = $mailer->createMessage()
                            ->setSubject('Rappel evenement')
                            ->setFrom('marou.khadhraoui@gmail.com')
                            ->setTo($z);
                        $mailer->send($message);
                    };
                }
            };

        }
        return $this->render('@Garantia/Reduction/AfficherEvenement.html.twig', array(
            'evenements' => $resultat,
            'f' => $f

        ));
    }

    public function DeleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("GarantiaBundle:Evenement")->find($id);

        if (!$evenement) {
            throw $this->createNotFoundException(
                'There are no evenement with the following id: ' . $id
            );
        }

        $em->remove($evenement);
        $em->flush();

        return $this->redirectToRoute('_afficherevenement');

    }

    public function ModifierAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("GarantiaBundle:Evenement")->find($id);
        $form2 = $this->createForm(EvenementType::class, $evenement);
        $form2->handleRequest($request);

        if ($form2->isSubmitted() && $form2->isValid()) {

            $em->flush();
            return $this->redirect('http://localhost/Garantia/web/app_dev.php/Garantia/AfficherEvenement');
        }
        return $this->render('@Garantia/Reduction/ModifierEvenement.html.twig', array(

            'f' => $form2->createView()
        ));
    }

    public function AfficherLireQrCodeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $q = $em->getRepository("GarantiaBundle:Evenement");
        $evenement = $em->getRepository("GarantiaBundle:Evenement")->find($id);

        return $this->render('@Garantia/Reduction/scanqr.html.twig', array(
            'q' => $q,
            'e' => $evenement,
        ));
    }

    public function VerifierQrAction()
    {
        $qr = $_POST['inoutqrn'];
        $id = $_POST['id'];
        $em = $this->getDoctrine()->getManager();
        $participation = $em->getRepository("GarantiaBundle:Evenement")->Rechercherparutilisateur($id, $qr);
        $evenement = $em->getRepository("GarantiaBundle:Evenement")->find($id);
        $message = '';
        $message2 = '';
        if ($participation == null) {
            dump($message2);
            $message2 = 'Acces réfusé';
            return $this->render('@Garantia/Reduction/scanqr2.html.twig', array(
                'e' => $evenement,
                'm' => $message,
                'p' => $participation,
                'm2' => $message2,
            ));
        } else {
            dump($participation);
            $message2 = 'Acces autorisé';
            $part = $participation[0];
            $part->setEtat(1);
            $em->merge($part);
            $em->flush();

            return $this->render('@Garantia/Reduction/scanqr2.html.twig', array(
                'e' => $evenement,
                'm' => $message,
                'p' => $participation,
                'm2' => $message2,

            ));


        }


    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }


}