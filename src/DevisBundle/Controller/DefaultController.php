<?php

namespace DevisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DevisBundle:Default:index.html.twig');
    }
    public function createAction()
    {
        return $this->render('DevisBundle:Default:index.html.twig');
    }
    public function viewAction()
    {
        return $this->render('DevisBundle:Default:view.html.twig');
    }
}
