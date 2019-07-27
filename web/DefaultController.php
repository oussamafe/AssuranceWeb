<?php

namespace PieceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('Piece/afficher.html.twig');
    }
    public function loginAction()
    {
        return $this->render('Piece/login.html.twig');
    }

    public function ajouterpAction()
    {
        return $this->render('Piece/ajouterp.html.twig');
    }
    public function afficherpAction()
    {
        $em=$this->getDoctrine()->getManager();
        $posts = $this->getDoctrine()->getRepository('PieceBundle:Produit')->findAll();
        return $this->render('Piece/afficherp.html.twig',['posts'=>$posts]);
    }
}

