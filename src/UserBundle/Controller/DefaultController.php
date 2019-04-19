<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $json_string = 'https://api.ipify.org/?format=json';
        $jsondata = file_get_contents($json_string);
        $obj = json_decode($jsondata, true);
        $loc = $obj['ip'];
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user->setIp($loc);
        $userManager->updateUser($user);
        $this->getDoctrine()->getManager()->flush();

        $em = $this->getDoctrine()->getManager();
        $v=$em->getRepository("UserBundle:User")->nbNewClients();
        $nbnew = count($v);
        $l = $em->getRepository("UserBundle:User")->nbloggedClients();
        $nblog = count($l);

        $article=$em->getRepository("GarantiaBundle:Actualite")->mostViewedArticle();
        $comments = $em->getRepository("GarantiaBundle:Actualite")->mostCommentedArticle();

        $articles = $comments['article'];
        $thread = $comments['thread'];


        $ip = $em->getRepository("UserBundle:User")->usercountries();



        return $this->render('@User/Default/index.html.twig',array('nbnew'=>$nbnew , 'nblog'=>$nblog , 'location'=>$ip , 'plus'=>$article[0] , 'thread' => $thread , 'articles' => $articles));
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
