<?php

namespace BoutiqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BoutiqueBundle:Default:index.html.twig');
    }

    function sendSmsAction()
    {
        $message = $_GET['message'];
        $em = $this->getDoctrine()->getManager();

        $sender = $this->get('jhg_nexmo_sms');
        $sender->sendText(21625315460, $message, 'ParaShop');
        exit();
    }
}
