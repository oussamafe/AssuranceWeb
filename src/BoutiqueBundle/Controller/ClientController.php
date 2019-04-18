<?php

namespace BoutiqueBundle\Controller;

use blackknight467\StarRatingBundle\Form\RatingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\rating;

class ClientController extends Controller
{
    public function acheterAction(Request $request, $id)
    {
        if (is_object($this->getUser())) {


            $em = $this->getDoctrine()->getManager();

            $produit = $em->getRepository('SanteUserBundle:Produit')->find($id);
            $user = $em->getRepository('SanteUserBundle:User')->find($this->getUser());

            // $evenement->setNbrpalacedispo($evenement->getNbrpalacedispo() - 1);
            // $douki=$this->getUser()->getId();

            $produit->setQuantiteDispo($produit->getQuantiteDispo() - 1);

            $p = new Panier();
            $em->persist($p->setIdPoduit($produit), $p->getIduser($user));
            $em->flush();

            //$em->persist($p->getIduser($user));

            // $em->flush();


            return $this->redirectToRoute('Boutique');
        }


        return $this->redirectToRoute('fos_user_security_login');

    }









    public function quikviewAction(Request $request, $id)
    {
        $m = $this->getDoctrine()->getManager();
        $em = $this->getDoctrine()->getManager();
        $mark = $em->getRepository('UserBundle:Produit')->find($id);
        $rating = $m->getRepository('UserBundle:rating')->AVGRating();
        $rating = new rating();
        $form = $this->createFormBuilder($rating)
            ->add('rating', RatingType::class, [
                'label' => 'Rating'
            ])
            ->add('valider', SubmitType::class, array(
                'attr' => array(

                    'class' => 'btn btn-xs btn-primary'
                )))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $rating->setProduit($mark->getId());
            $em->persist($rating);
            $em->flush();
        }

        $produits = $em->getRepository('UserBundle:Produit')->findAll();


        return $this->render('@Boutique/Client/quikview.html.twig',
            array(

                'mark' => $mark,
                'produits' => $produits,

                'form' => $form->createView(), 'rating' => $rating));

    }

    public function afficherPanierAction(Request $request)
    {

        $session = $request->getSession();
        $cartProductsId = $session->get("produits");
        $m = $this->getDoctrine()->getManager();

        $panier = array();
        $table = array();
        $prixtotal = 0;
        foreach ($cartProductsId as $idprod) {
            array_push($panier, $m->getRepository('UserBundle:Produit')->find($idprod));
        }
        foreach ($panier as $tab) {

            if (in_array($tab, $table)) {

                $tab->setQuantite($tab->getQuantite() + 1);
            } else {

                array_push($table, $tab);
                $tab->setQuantite($tab->getQuantite() + 1);

            }
            foreach ($table as $total) {
                $prixtotal = $prixtotal + ($total->getQuantite() * $total->getPrix());
            }


            return $this->render('@Boutique/Client/afficherPanier.html.twig', array('panier' => $table));

        }
    }


    public function ValiderAchatAction(Request $request)
    {

        $session = $request->getSession();
        $cartProductsId = $session->get("produits");
        $m = $this->getDoctrine()->getManager();

        $panier = array();
        $table = array();
        $prixtotal = 0;
        foreach ($cartProductsId as $idprod) {
            array_push($panier, $m->getRepository('UserBundle:Produit')->find($idprod));
        }
        foreach ($panier as $tab) {

            if (in_array($tab, $table)) {

                $tab->setQuantite($tab->getQuantite() + 1);
            } else {

                array_push($table, $tab);
                $tab->setQuantite($tab->getQuantite() + 1);

            }
            foreach ($table as $total) {
                $prixtotal = $prixtotal + ($total->getQuantite() * $total->getPrix());
            }


        }


        $m = $this->getDoctrine()->getManager();
        $panier = $m->getRepository('UserBundle:Panier')->findAll();

        return $this->render('BoutiqueBundle:Client:Facture.html.twig', array('panier' => $table));


    }


    public function AnnulerProduitAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $mark = $em->getRepository('UserBundle:Panier')->find($id);

        $produit = $mark->getIdPoduit();
        // $evenement->setNbrpalacedispo($evenement->getNbrpalacedispo() - 1);
        $pr = $em->getRepository('UserBundle:Produit')->find($produit);


        $pr->setQuantiteDispo($pr->getQuantiteDispo() + 1);
        $em->remove($mark);
        $em->flush();
        return $this->redirectToRoute('afficherPanier');

    }

    public function RetourAction()
    {
        return $this->redirectToRoute('Boutique');
    }


    public function searchAction(Request $request)
    {
        $libelle = $request->get('libelle');
        $categorie = $request->get('categorie');
        $prix = $request->get('prix');

        $m = $this->getDoctrine()->getManager();

        $produits = $m->getRepository('UserBundle:Produit')->findDQL($libelle, $categorie, $prix);

        return $this->render('BoutiqueBundle:Client:Rechercher.html.twig',
            array(

                'produits' => $produits,
            )
        );
    }


    public function pdfAction(Request $request)
    {

        $session = $request->getSession();
        $cartProductsId = $session->get("produits");
        $m = $this->getDoctrine()->getManager();

        $panier = array();
        $table = array();
        $prixtotal = 0;
        foreach ($cartProductsId as $idprod) {
            array_push($panier, $m->getRepository('UserBundle:Produit')->find($idprod));
        }
        foreach ($panier as $tab) {

            if (in_array($tab, $table)) {

                $tab->setQuantite($tab->getQuantite() + 1);
            } else {

                array_push($table, $tab);
                $tab->setQuantite($tab->getQuantite() + 1);

            }
            foreach ($table as $total) {
                $prixtotal = $prixtotal + ($total->getQuantite() * $total->getPrix());
            }

        }
        $session->set("produits", null);
        $snappy = $this->get('knp_snappy.pdf');


        $html = $this->renderView('C:\xampp\htdocs\pidev1\src\BoutiqueBundle\Resources\views\Client\Facture1.html.twig"', array('panier' => $table
            //..Send some data to your view if you need to //
        ));

        $filename = 'MonFacturePDF';

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $filename . '.pdf"'
            )
        );
    }


    public function deliveryAction(Request $request)
    {
        $name = $request->get('name');
        $number = $request->get('number');
        $landmark = $request->get('landmark');
        $city = $request->get('city');
        $adress = $request->get('adress');
        //$table=array('name'=>$name,'number'=>$number,'landmark'=>$landmark,'city'=>$city,'adress'=>$adress);


        return $this->render('BoutiqueBundle:Client:Delivery.html.twig', array('name' => $name, 'number' => $number, 'landmark' => $landmark, 'city' => $city, 'adress' => $adress));
    }


    public function statAction()
    {
        $pieChart = new PieChart();
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('UserBundle:Produit')->findAll();
        $totalEtudiant = 0;
        foreach ($categories as $categorie) {
            $totalEtudiant = $totalEtudiant + $categorie->getQuantiteDispo();
        }

        $data = array();
        $stat = ['classe', 'nbEtudiant'];
        $nb = 0;
        array_push($data, $stat);
        foreach ($categories as $categorie) {
            $stat = array();
            array_push($stat, $categorie->getLibelle(), (($categorie->getQuantiteDispo()) * 100) / $totalEtudiant);
            $nb = ($categorie->getQuantiteDispo() * 100) / $totalEtudiant;
            $stat = [$categorie->getLibelle(), $nb];
            array_push($data, $stat);
        }
        $pieChart->getData()->setArrayToDataTable($data);
        $pieChart->getOptions()->setTitle('Pourcentages des Produits par Quantité');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('@User/Admin/Boutique/stat.html.twig', array('piechart' => $pieChart));
    }


    public function setProduitToSessionAction($id, Request $request)

    {
        $session = $request->getSession();
        $sessionArray = $session->get("produits");
        if ($sessionArray == null) {
            $sessionArray = array();
            $session->set("produits", $sessionArray);

        }
        array_push($sessionArray, $id);
        $session->set("produits", $sessionArray);
        return new JsonResponse(array('data' => $array = $session->get("produits")));


    }


    public function getallProduitFromSessionAction(Request $request)
    {
        $session = $request->getSession();
        $array = $session->get("produits");
        $response = new JsonResponse(array('data' => $array));
        return $response;
    }


    public function CheckoutAction(Request $request)
    {
        if (is_object($this->getUser())) {

            $session = $request->getSession();
            $cartProductsId = $session->get("produits");
            $m = $this->getDoctrine()->getManager();

            $panier = array();
            $table = array();
            $prixtotal = 0;
            foreach ($cartProductsId as $idprod) {
                array_push($panier, $m->getRepository('UserBundle:Produit')->find($idprod));
            }
            foreach ($panier as $tab) {

                if (in_array($tab, $table)) {

                    $tab->setQuantite($tab->getQuantite() + 1);
                } else {

                    array_push($table, $tab);
                    $tab->setQuantite($tab->getQuantite() + 1);

                }
                foreach ($table as $total) {
                    $prixtotal = $prixtotal + ($total->getQuantite() * $total->getPrix());
                }

            }

            return $this->render('@Boutique/Client/checkout.html.twig', array('panier' => $table));
        }
        return $this->redirectToRoute('fos_user_security_login');

    }

    public function RecupererProduitAction(Request $request)
    {
        $libelle = $request->get('libelle');
        $categorie = $request->get('categorie');
        $prix = $request->get('prix');
        $em = $this->getDoctrine()->getManager();


        $cat = $em->getRepository('UserBundle:Categorie')->findAll();

        $produit = $em->getRepository('UserBundle:Produit')->findDQL($libelle, $categorie, $prix);


        $rating = $em->getRepository('UserBundle:rating')->AVGRating();

        $produits = $this->get('knp_paginator')->paginate(
            $produit,
            $request->query->get('page', 1), 10
        );


        return $this->render('UserBundle:Default:Boutique.html.twig', array('produits' => $produits
        , 'cat' => $cat
        , 'rating' => $rating
        ));


    }


    public function paymentAction(Request $request)
    {
        $session = $request->getSession();
        $cartProductsId = $session->get("produits");
        $em = $this->getDoctrine()->getManager();
        $m = "impo";


        foreach ($cartProductsId as $p) {

            $cat = $em->getRepository('UserBundle:Produit')->find($p);
            $h = $cat->getId();
            $l = $cat->getLibelle();
            $marou = $cat->getQuantiteDispo();


           // $d = $cat->getQuantiteDispo();

            if ($h == $p) {
                $d = $cat->getQuantiteDispo();
                //1
                if ($d > 0) {
                    $cat->setQuantiteDispo($d);
                    $em->persist($cat);
                    $em->flush();
                }

                // return $this->render('SanteBoutiqueBundle:Client:impossible.html.twig',array('hh'=>$h,'ll'=>$l));
                // echo 'TON TEXTE';
                // echo '<script>alert("désole ! il reste "$p.quantiteDispo "pieces du produit"||$p.libelle); evt.preventDefault();</script>';
                echo '<script type="text/javascript">alert("vous avez acheter plus que notre quantite disponible nous somme désolé il nous reste      ' . $marou . '     pièces du produit:     ' . $l . '");</script>';
                // die();
                exit();
                //   return $this->redirectToRoute('Checkout');


            }


        }


        return $this->render('@Boutique/Client/payment.html.twig');
    }


    public function delsessionAction(Request $request, $id, $quantite)
    {
        $i = 0;
        $quantite = $quantite + 1;
        $j = 0;
        $session = $request->getSession();
        $cartProductsId = $session->get("produits");
        foreach ($cartProductsId as $a) {

            if ($a == $id) {

                $i = $i + 1;
                if ($i == $quantite) {
                    unset($cartProductsId[$j]);
                }
            }
            $j = $j + 1;
        }
        $a = array_values($cartProductsId);
        $session->set("produits", $a);

        return new JsonResponse(array('data' => $array = $session->get("produits")));
    }

    public function delfrompanierAction(Request $request, $id)
    {


        $j = 0;
        $session = $request->getSession();
        $cartProductsId = $session->get("produits");
        foreach ($cartProductsId as $a) {

            if ($a == $id) {
                unset($cartProductsId[$j]);
            }
            $j = $j + 1;
        }
        $session->set("produits", array_values($cartProductsId));

        return new JsonResponse(array('data' => $array = $session->get("produits")));
    }

    public function supprimerpanierAction($id, Request $request)
    {
        $session = $request->getSession();
        $panier = $session->get('produits');

        if (array_key_exists($id, $panier)) {
            unset($panier[$id]);
            $session->set('panier', $panier);
            $this->get('session')->getFlashBag()->add('success', 'Article supprimé avec succès');
        }

        return $this->redirect($this->generateUrl('Checkout'));
    }


    public function moinscherAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $produitss = $em->getRepository('UserBundle:Produit')->triermoinsDQL();
        $rating = $em->getRepository('UserBundle:rating')->AVGRating();
        $produits = $this->get('knp_paginator')->paginate(
            $produitss,
            $request->query->get('page', 1), 6
        );
        return $this->render('@Boutique/Client/moinscher.html.twig', array(
            'produits' => $produits,
            'rating' => $rating
        ));

    }

    public function pluscherAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $produitss = $em->getRepository('UserBundle:Produit')->trierplusDQL();
        $rating = $em->getRepository('UserBundle:rating')->AVGRating();
        $produits = $this->get('knp_paginator')->paginate(
            $produitss,
            $request->query->get('page', 1), 6
        );


        return $this->render('@Boutique/Client/pluscher.html.twig', array(
            'produits' => $produits,
            'rating' => $rating
        ));

    }
}
