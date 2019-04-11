<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $url = 'http://checkip.dyndns.com/';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        curl_close($curl);
        preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $data, $m);
        $externalIp = $m[1];
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user->setIp($externalIp);
        $userManager->updateUser($user);
        $this->getDoctrine()->getManager()->flush();

        return $this->render('@User/Default/index.html.twig');
    }


    public function ShowAllUsersAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        return $this->render('@User/Default/allusers.html.twig', array('users' => $users));

    }

    public function ShowExpertAction()
    {
        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM AppBundle:User u WHERE u.roles LIKE :role '
            )->setParameter('role', '%"ROLE_EXPERT"%');
        $users = $query->getResult();
        return $this->render('@User/Default/clients.html.twig', array('users' => $users));
    }

    public function ShowEmployeAction()
    {
        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM AppBundle:User u WHERE u.roles LIKE :role '
            )->setParameter('role', '%"ROLE_EMPLOYE"%');
        $users = $query->getResult();
        return $this->render('@Garantia/Users/clients.html.twig', array('users' => $users));
    }

    public function ShowClientsAction()
    {
        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM AppBundle:User u WHERE (u.roles NOT LIKE :role) AND (u.roles NOT LIKE :role1) AND (u.roles NOT LIKE :role2) '
            )->setParameters(array('role' => '%"ROLE_SUPER_ADMIN"%', 'role1' => '%"ROLE_EMPLOYE"%', 'role2' => '%"ROLE_EXPERT"%'));
        $users = $query->getResult();
        return $this->render('@Garantia/Users/clients.html.twig', array('users' => $users));
    }

    public function PromoteUserExpertAction($id)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id' => $id));
        $user->addRole('ROLE_EXPERT');
        $userManager->updateUser($user);
        return $this->redirectToRoute('showAll');
    }

    public function PromoteUserEmployeAction($id)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id' => $id));
        $user->addRole('ROLE_EMPLOYE');
        $userManager->updateUser($user);
        return $this->redirectToRoute('showAll');
    }


}
