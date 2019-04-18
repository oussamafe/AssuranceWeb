<?php
/**
 * Created by PhpStorm.
 * User: Oussama Fezzani
 * Date: 13/04/2019
 * Time: 13:16
 */

namespace GarantiaBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{

    public function recentArticles()
    {
        $em = $this->getDoctrine()->getManager();
        $model = $em->getRepository("GarantiaBundle:CategorieActu")->findAll();

        return $this->render('actualite/categorie.html.twig',['categorie' => $model]);
    }
}