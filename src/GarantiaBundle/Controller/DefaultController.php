<?php

namespace GarantiaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GarantiaBundle\Entity\CategorieActu;


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
        if ( $user != 'anon.')
        {
            $user->setIp($externalIp);
            $userManager->updateUser($user);
            $this->getDoctrine()->getManager()->flush();
        }


        $em = $this->getDoctrine()->getManager();
        $model = $em->getRepository("GarantiaBundle:CategorieActu")->findAll();

        return $this->render('@Garantia/Default/index.html.twig' , array('categorieActu' => $model));
    }
}
