<?php

namespace PieceBundle\Controller;

use PieceBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('Piece/afficher.html.twig');
    }
    public function loginAction()
    { $em=$this->getDoctrine()->getManager();
        $posts = $this->getDoctrine()->getRepository('PieceBundle:User')->findAll();
        return $this->render('Piece/login.html.twig',['posts'=>$posts]);
    }

    public function ajouterpAction(Request $request)
    {

        $produit = new Produit();

        $em1=$this->getDoctrine()->getManager();
        $cat= $em1->getRepository('PieceBundle:Categorie')->findAll();


        $form = $this->createFormBuilder($produit)

            ->add('codeArt',TextareaType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('designation',TextareaType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('quantite',TextareaType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('prix',TextareaType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('save',SubmitType::class,array('label'=>'Ajouter','attr'=>array('class'=>'btn btn-primary') ))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {
            $codeArt=$form['codeArt']->getData();
            $designation=$form['designation']->getData();
            $quantite=$form['quantite']->getData();
            $prix=$form['prix']->getData();


            {

                $produit->setCodeArt($codeArt);
                $produit->setDesignation($designation);
                $produit->setQuantite($quantite);
                $produit->setPrix($prix);
                $em=$this->getDoctrine()->getManager();
                $user = $em->getRepository('PieceBundle:Categorie')->findOneBy(['id' => 1]);
                $produit->setIdCategorie($user);

                $manager = $this->get('oneup_uploader.orphanage_manager')->get('gallery');
                $files = $manager->getFiles();
                $filesup = $manager->uploadFiles();

                foreach ($filesup as $value)
                {
                    $produit->setImage($value->getFilename());
                }


                $em->persist($produit);
                $em->flush();


            }
            return $this->redirectToRoute('afficherp');
        }
        return $this->render('Piece/ajouterp.html.twig',['form'=>$form->createView()]);






    }
    public function afficherpAction()
    {
        $em=$this->getDoctrine()->getManager();
        $posts = $this->getDoctrine()->getRepository('PieceBundle:Produit')->findAll();
        return $this->render('Piece/afficherp.html.twig',['posts'=>$posts]);
    }



    public function EditRAction(Request $request ,$id)
    {  $r= $this->getDoctrine()->getManager()->getRepository('PieceBundle:Produit')->find($id);
        $r->setCodeArt($r->getCodeArt());
        $r->setDesignation($r->getDesignation());
        $r->setQuantite($r->getQuantite());
        $r->setPrix($r->getPrix());

        $form = $this->createFormBuilder($r)
            ->add('codeArt',TextareaType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('designation',TextareaType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('quantite',TextareaType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('prix',TextareaType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('save',SubmitType::class,array('label'=>'enregistrer','attr'=>array('class'=>'btn btn-primary') ))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {
            $codeArt=$form['codeArt']->getData();
            $designation=$form['designation']->getData();
            $quantite=$form['quantite']->getData();
            $prix=$form['prix']->getData();
            $em=$this->getDoctrine()->getManager();
            $r=$em->getRepository('PieceBundle:Produit')->find($id);

            $r->setCodeArt($codeArt);
            $r->setDesignation($designation);
            $r->setQuantite($quantite);
            $r->setPrix($prix);


            $em->flush();
            return $this->redirectToRoute('afficherp');
        }

        return $this->render('Piece/EditR.html.twig',['form'=>$form->createView()]);

    }


    public function DeletePAction($id)
    {$em=$this->getDoctrine()->getManager();
        $r=$em->getRepository('PieceBundle:Produit')->find($id);
        $em->remove($r);
        $em->flush();
        return $this->redirectToRoute('afficherp');
    }
    public function contactAction()
    {
        $em=$this->getDoctrine()->getManager();
        $posts = $this->getDoctrine()->getRepository('PieceBundle:Contact')->findAll();
        return $this->render('Piece/contact.html.twig',['posts'=>$posts]);
    }

    public function repondreAction(Request $request ,$id)

    {$r= $this->getDoctrine()->getManager()->getRepository('PieceBundle:Contact')->find($id);
        $r->setMail($r->getMail());
        $r->setContenu($r->getContenu());

        $form = $this->createFormBuilder($r)
            ->add('mail',TextType::class,array('attr'=>array('class'=>'form-control','disabled'=>'true') ))
            ->add('contenu',TextType::class,array('attr'=>array('class'=>'form-control','disabled'=>'true') ))

            ->getForm();
        $form->handleRequest($request);
        return $this->render('Piece/repondre.html.twig',['form'=>$form->createView()]);
    }

}
