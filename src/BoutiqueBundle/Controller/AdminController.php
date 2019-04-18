<?php

namespace BoutiqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use UserBundle\Entity\Categorie;
use UserBundle\Entity\Produit;
use BoutiqueBundle\Form\CategorieType;
use BoutiqueBundle\Form\ProduitType;
use UserBundle\UserBundle;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends Controller
{
    public function listeProduitAction()
    {
        $m = $this->getDoctrine()->getManager();
        $pr = $m->getRepository('UserBundle:Produit')->findAll();
        // $con = $m->getConnexion();

        $table = array();
        foreach ($pr as $req) {
            $r = $req->getQuantiteDispo();

            if ($r < 5) {

                array_push($table, $req);
            }


        }
        return $this->render('@User/Admin/Boutique/listeProduit.html.twig',
            array(
                'ev' => $pr,
                'fedi' => $table
            )
        );
    }

    public function AjoutproduitAction(Request $request)
    {
        {
            $produit = new Produit();
            $form = $this->createForm(ProduitType::class, $produit);

            $form->handleRequest($request);
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $produit->uploadProfilePicture();
                $em->persist($produit);
                $em->flush();
                return $this->redirectToRoute('listeProduit');
            }

            return $this->render('UserBundle:Admin/Boutique:AjouterProduit.html.twig', array('form' => $form->createView()));
        }
    }

    public function supprimerProduitAction($id)
    {
        //instancier orm
        //nel9aw el id ela bech nfas5ouh
        $em = $this->getDoctrine()->getManager();
        $mark = $em->getRepository('UserBundle:Produit')->find($id);
        $em->remove($mark);
        $em->flush();
        return $this->redirectToRoute('listeProduit');
    }


    public function modifierProduitAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $mark = $em->getRepository('UserBundle:Produit')->find($id);
        $form = $this->createForm(ProduitType::class, $mark);
        if ($form->handleRequest($request)->isValid()) {
            $mark->uploadProfilePicture();
            $em->persist($mark);
            $em->flush();
            return $this->redirectToRoute('listeProduit');
        }
        return $this->render('UserBundle:Admin/Boutique:Modifier.html.twig', array('form' => $form->createView()));

    }


    public function listeCategorieAction()
    {
        $m = $this->getDoctrine()->getManager();
        $pr = $m->getRepository('UserBundle:Categorie')->findAll();
        return $this->render('@User/Admin/Boutique/listeCategorie.html.twig',
            array(
                'ev' => $pr,
            )
        );
    }


    public function AjoutCategorieAction(Request $request)
    {
        {
            $categorie = new Categorie();
            $form = $this->createForm(CategorieType::class, $categorie);

            $form->handleRequest($request);
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($categorie);
                $em->flush();
                return $this->redirectToRoute('listeCategorie');
            }

            return $this->render('UserBundle:Admin/Boutique:AjouterCategorie.html.twig', array('form' => $form->createView()));
        }
        // return $this->render('santeevenementBundle:evenement:ajoutevenement.html.twig', array(
        //  // ...
        // ));
    }


    public function modifierCategorieAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $mark = $em->getRepository('UserBundle:Categorie')->find($id);
        $form = $this->createForm(CategorieType::class, $mark);
        if ($form->handleRequest($request)->isValid()) {
            $em->persist($mark);
            $em->flush();
            return $this->redirectToRoute('listeCategorie');
        }
        return $this->render('UserBundle:Admin/Boutique:ModifierCategorie.html.twig', array('form' => $form->createView()));

    }


    public function supprimerCategorieAction($id)
    {
        //instancier orm
        //nel9aw el id ela bech nfas5ouh
        $em = $this->getDoctrine()->getManager();
        $mark = $em->getRepository('UserBundle:Categorie')->find($id);
        $em->remove($mark);
        $em->flush();
        return $this->redirectToRoute('listeCategorie');
    }


    public function ProduitFiniAction()
    {
        $em = $this->getDoctrine()->getManager();

        $mark = $em->getRepository('UserBundle:Produit')->findAll();

        foreach ($mark as $markk) {
            if ($markk->getQuantiteDispo() == 0) {
                $em->remove($markk);
                $em->flush();
            }
        }
        return;
    }
}
