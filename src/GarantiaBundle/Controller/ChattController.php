<?php

namespace GarantiaBundle\Controller;

use GarantiaBundle\Entity\Reclamation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GarantiaBundle\Entity\Notification;
use GarantiaBundle\Entity\Chat;
use Symfony\Component\HttpFoundation\Request;

class ChattController extends Controller
{

    public function sendMAFAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {

            $idR = $request->get('id');
            $idE = $request->get('td');
            $em1 = $this->getDoctrine()->getManager();
            $id = $this->get('security.token_storage')->getToken()->getUser();
            $em5 = $this->getDoctrine()->getManager();

            $idemp = $em5->find('UserBundle:User', $idE);
            $ch = new Chat();

            $ch->setIdAdmin($id);
            $ch->setIdEmp($idemp);
            $ch->setDest(0);


            $rec = $this->getDoctrine()->getRepository('GarantiaBundle:Reclamation')->find($idR);
            $r = $rec->getId();
            $info = $this->getDoctrine()->getRepository('UserBundle:User')->find($r);
            $ch->setMgs('La reclamation n : '.$rec->getId().' a depasse une semaine sans avoir etre traiter . priere de la traiter '
                . 'son objet : ' . $rec->getObjet() . ' son contenu : ' . $rec->getContenu().' elle date de plus une semaine  ');

            $em = $this->getDoctrine()->getManager();
            $em->persist($ch);
            $em->flush();


            $notif = new Notification();
            $notif->setIdClient(0);
            $idem = $em5->find('UserBundle:User', $idE);
            $notif->setIdEmploye($idem);
            $ida = $this->get('security.token_storage')->getToken()->getUser()->getId();
            $notif->setIdAdmin($ida);
            $notif->setSent(0);
            $em6 = $this->getDoctrine()->getManager();
            $em6->persist($notif);
            $em6->flush();

            $em7 = $this->getDoctrine()->getManager();

            $RAW_QUERY = "SELECT * FROM reclamation where  type='Urgente' and etat='non traitée'";

            $statement = $em7->getConnection()->prepare($RAW_QUERY);
            $statement->execute();

            $result = $statement->fetchAll();

            return $this->render('Reclamation/ShowRAdm.html.twig', ['posts' => $result]);
        }


    }


    public function MessaAdmAction(Request $request)
    {
        $chat = $this->getDoctrine()->getRepository('GarantiaBundle:Chat')->findAll();
        $posts = $this->getDoctrine()->getRepository('GarantiaBundle:Notification')->findBy(array('sent' => 0));


        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = "SELECT * FROM notification where sent = 0";

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll();


        $em1 = $this->getDoctrine()->getManager();

        $RAW_QUERY1 = "SELECT * FROM fos_user ";

        $statement1 = $em1->getConnection()->prepare($RAW_QUERY1);
        $statement1->execute();

        $result1 = $statement1->fetchAll();

        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM UserBundle:User u WHERE (u.roles  LIKE :role) '
            )->setParameters(array('role' => '%"ROLE_EMPLOYE"%'));
        $disc = $query->getResult();

        $id4 = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $em6 = $this->getDoctrine()->getManager();

        $RAW_QUERY6 = "SELECT * FROM notification WHERE sent=0 AND id_admin=$id4";

        $statement6 = $em6->getConnection()->prepare($RAW_QUERY6);
        $statement6->execute();

        $disc1 = $statement6->fetchAll();

        return $this->render('Reclamation/MessaAdm.html.twig', array('posts' => $posts, 'chat' => $chat, 'notif' => $result, 'nom' => $result1, 'disc' => $disc, 'disc1' => $disc1));


    }

    public function sh()
    {
        $id4 = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $em6 = $this->getDoctrine()->getManager();

        $RAW_QUERY6 = "SELECT * FROM notification WHERE sent=0 AND id_admin=$id4";

        $statement6 = $em6->getConnection()->prepare($RAW_QUERY6);
        $statement6->execute();

        $disc1 = $statement6->fetchAll();

        return $this->render('Reclamation/MessaAdm.html.twig', ['disc1' => $disc1]);

    }


    public function DiscAction(Request $request)
    {
        $td = $request->get('td');
        $arr['tdi'] = $td;
        $idemp = $request->get('td');
        $disc = $this->getDoctrine()->getRepository('GarantiaBundle:Chat')->findBy(array('idEmp' => $idemp, 'idAdmin' => $this->get('security.token_storage')->getToken()->getUser()->getId()));


        return $this->render('Reclamation/Disc.html.twig', ['disc' => $disc, 'arr' => $arr]);


    }

    public function sendMAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $ch = new Chat();
            $not = $request->get('mgs');
            $ide = $request->get('id');

            $ch->setMgs($not);
            $id = $this->get('security.token_storage')->getToken()->getUser();
            $ch->setIdAdmin($id);
            $em5 = $this->getDoctrine()->getManager();
            $idep = $em5->find('UserBundle:User', $ide);
            $ch->setIdEmp($idep);
            $ch->setDest(0);

            $em = $this->getDoctrine()->getManager();
            $em->persist($ch);

            $em->flush();

            $notif = new Notification();
            $notif->setIdClient(0);
            $notif->setIdAdmin($this->get('security.token_storage')->getToken()->getUser()->getId());
            $notif->setIdEmploye($em5->find('UserBundle:User', $ide));

            $notif->setSent(0);
            $em->persist($notif);
            $em->flush();
            $td = $request->get('id');
            $arr['tdi'] = $td;
            $idemp = $request->get('id');
            $disc = $this->getDoctrine()->getRepository('GarantiaBundle:Chat')->findBy(array('idEmp' => $idemp, 'idAdmin' => $this->get('security.token_storage')->getToken()->getUser()->getId()));


            return $this->render('Reclamation/Disc.html.twig', ['disc' => $disc, 'arr' => $arr]);
        }


    }


    public function ShowNAction(Request $request)
    {
        $id = $this->get('security.token_storage')->getToken()->getUser()->getId();

        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM UserBundle:User u WHERE (u.roles NOT LIKE :role) AND (u.roles NOT LIKE :role2) '
            )->setParameters(array('role' => '%"ROLE_SUPER_ADMIN"%', 'role2' => '%"ROLE_EXPERT"%'));
        $disc42 = $query->getResult();


        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'DELETE FROM GarantiaBundle:Notification u WHERE (u.sent =:s) AND (u.idAdmin =:id) '
            )->setParameters(array('s' => 0, 'id' => $id));
        $disc89 = $query->getResult();

        return $this->redirectToRoute('Disc');

    }


    public function MessaEmpAction(Request $request)
    {

        $disc = $this->getDoctrine()->getRepository('GarantiaBundle:Chat')->findBy(array('idEmp' => $this->get('security.token_storage')->getToken()->getUser()->getId()));

        return $this->render('Reclamation/MessaEmp.html.twig', ['disc' => $disc]);


    }


    public function sendMEmpAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $ch = new Chat();
            $not = $request->get('mgs');

            $ch->setMgs($not);
            $ch->setIdEmp($this->get('security.token_storage')->getToken()->getUser());

            $em6 = $this->getDoctrine()->getManager();

            $us = $em6->find('UserBundle:User', 12);

            $ch->setIdAdmin($us);


            $ch->setDest(1);

            $em = $this->getDoctrine()->getManager();
            $em->persist($ch);

            $em->flush();

            $notif = new Notification();
            $notif->setIdClient(0);
            $notif->setIdAdmin($us->getId());
            $notif->setIdEmploye($this->get('security.token_storage')->getToken()->getUser());

            $notif->setSent(0);
            $em->persist($notif);
            $em->flush();
            $disc = $this->getDoctrine()->getRepository('GarantiaBundle:Chat')->findBy(array('idEmp' =>  $this->get('security.token_storage')->getToken()->getUser()->getId()));


            return $this->render('Reclamation/DiscEmp.html.twig', ['disc' => $disc]);
        }

    }

    public function DiscEpAction(Request $request)
    { if ($request->isXmlHttpRequest()) {

        $disc = $this->getDoctrine()->getRepository('GarantiaBundle:Chat')->findBy(array('idEmp' => $this->get('security.token_storage')->getToken()->getUser()->getId()));

        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $this->render('Reclamation/DiscEmp.html.twig', ['disc' => $disc]);
    }

    }


}
