<?php
/**
 * Created by PhpStorm.
 * User: Oussama Fezzani
 * Date: 15/04/2019
 * Time: 19:14
 */

namespace GarantiaBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PubController extends AbstractController
{
    public function recentArticles()
    {
        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = "SELECT * FROM publicite where DATEDIFF(CURDATE(),datefin)<1";

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll();


        return $this->render('Publicite/pub.html.twig' , array("pub" => $result));
    }
}