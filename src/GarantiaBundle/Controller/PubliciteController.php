<?php

namespace GarantiaBundle\Controller;

use GarantiaBundle\Entity\Publicite;
use GarantiaBundle\Entity\Rating;
use GarantiaBundle\Form\PubliciteType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class PubliciteController extends Controller
{
    public function ShowPAdmAction()
    {
        $posts = $this->getDoctrine()->getRepository('GarantiaBundle:Publicite')->findAll();
        return $this->render('Publicite/showpublicite.html.twig', ['posts' => $posts]);
    }

    public function ajouterpubAction(\Symfony\Component\HttpFoundation\Request $request)
    {        $models = $this->getDoctrine()->getRepository(Publicite::class)->findAll();

        $Publicite = new Publicite();
        $form = $this->createFormBuilder($Publicite)
            ->add('nompublicite', TextAreaType::class, array('attr' => array('class' => 'form-control')))
            ->add('description', TextAreaType::class, array('attr' => array('class' => 'form-control')))
            ->add('imagepub', TextAreaType::class, array('attr' => array('class' => 'form-control')))
            ->add('datedebut', DateType::class, array('attr' => array('class' => 'form-control')))
            ->add('datefin', DateType::class, array('attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Comfirmer L ajout', 'attr' => array('class' => 'btn btn-primary')))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $datedebut = $form['datedebut']->getData();
            $datefin = $form['datefin']->getData();
            $description = $form['description']->getData();
            $nompublicite = $form['nompublicite']->getData();
            $image = $form['imagepub']->getData();

            $Publicite->setDatedebut($datedebut);
            $Publicite->setDatefin($datefin);

            $Publicite->setDescription($description);
            $Publicite->setImagepub($image);
            $Publicite->setNompublicite($nompublicite);
            $Publicite->setVue(0);


            $e = $this->getDoctrine()->getManager();
            $e->persist($Publicite);
            $e->flush();
            return $this->redirectToRoute("listpub");
        }
        return $this->render("@Garantia/Publicite/ajouterepub.html.twig", array("ajouterpub" => $form->createView(),'modeles' => $models));

    }

    public function listtModelepubAction()
    {
        $models = $this->getDoctrine()->getRepository(Publicite::class)->findAll();
        return $this->render("@Garantia/Publicite/listepub.html.twig", array('modeles' => $models));
    }

    public function updatepubAction($id, \Symfony\Component\HttpFoundation\Request $request)
    {
        $Publicite = $this->getDoctrine()->getManager()->getRepository('GarantiaBundle:Publicite')->find($id);
        $Publicite->setDatedebut($Publicite->getDatedebut());
        $Publicite->setDatefin($Publicite->getDatefin());

        $Publicite->setDescription($Publicite->getDescription());
        $Publicite->setImagepub($Publicite->getImagepub());
        $Publicite->setNompublicite($Publicite->getNompublicite());
        $Publicite->setVue($Publicite->getVue());

        $form = $this->createFormBuilder($Publicite)
            ->add('description', TextAreaType::class, array('attr' => array('class' => 'form-control')))
            ->add('nompublicite', TextAreaType::class, array('attr' => array('class' => 'form-control')))
            ->add('imagepub', TextAreaType::class, array('attr' => array('class' => 'form-control')))
            ->add('datedebut', DateType::class, array('attr' => array('class' => 'form-control')))
            ->add('datefin', DateType::class, array('attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Enregistrer', 'attr' => array('class' => 'btn btn-primary')))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $datedebut = $form['datedebut']->getData();
            $datefin = $form['datefin']->getData();
            $description = $form['description']->getData();
            $nompublicite = $form['nompublicite']->getData();
            $image = $form['imagepub']->getData();

            $Publicite->setDatedebut($datedebut);
            $Publicite->setDatefin($datefin);
            $Publicite->setDescription($description);
            $Publicite->setImagepub($image);
            $Publicite->setNompublicite($nompublicite);
            $Publicite->setVue($Publicite->getVue());


            $e = $this->getDoctrine()->getManager();
            $e->persist($Publicite);
            $e->flush();
            return $this->redirectToRoute("listpub");
        }

        // replace this example code with whatever you need
        return $this->render("@Garantia/Publicite/updatepub.html.twig", array("updatepub" => $form->createView()));

    }

    public function supAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository(Publicite::class)->find($id);
        $em->remove($post);
        $em->flush();
        return $this->redirectToRoute("listpub");
    }


    public function ShowPubAction()
    {

        $posts = $this->getDoctrine()->getRepository('GarantiaBundle:Publicite')->findAll();
        return $this->render('Publicite/showpublicite.html.twig', ['posts' => $posts]);
    }

    public function ShPubDetAction(Request $request , $id)
    {


        $pub = $this->getDoctrine()->getRepository('GarantiaBundle:Publicite')->findBy(array('id' => $id));
        return $this->render('Publicite/ShPubDet.html.twig', ['pub' => $pub]);
    }


    public function RatAction(Request $request)
    {
        // replace this example code with whatever you need

        if($request->isXmlHttpRequest()) {

            $star = new Rating();
            $id = $request->get('id');
            $note=$request->get('note');
            $star->setNote($note);


            $em5 = $this->getDoctrine()->getManager();
            $idp=$em5->find('GarantiaBundle:Publicite', $id);
            $star->setIdPub($idp);
            $em = $this->getDoctrine()->getManager();
            $star->setIdClient($this->get('security.token_storage')->getToken()->getUser());

            $em->persist($star);
            $em->flush();
            $posts = $this->getDoctrine()->getRepository('GarantiaBundle:Publicite')->findBy(array('id'=>$id));
            return $this->render('Publicite/Rating.html.twig', ['posts' => $posts]);

        }

    }
    public function RatingAction(Request $request,$id)
    {


        $posts = $this->getDoctrine()->getRepository('GarantiaBundle:Publicite')->findBy(array('id'=>$id));

        return $this->render('Publicite/Rating.html.twig', ['posts' => $posts]);

    }
    public function VueAction(Request $request)
    {   $id = $request->get('id');
        $Publicite = $this->getDoctrine()->getManager()->getRepository('GarantiaBundle:Publicite')->find($id);

            $Publicite->setVue($Publicite->getVue()+1);


            $e = $this->getDoctrine()->getManager();
            $e->persist($Publicite);
            $e->flush();
        $posts = $this->getDoctrine()->getRepository('GarantiaBundle:Publicite')->findBy(array('id'=>$id));

        return $this->render('Publicite/Rating.html.twig', ['posts' => $posts]);


    }

    public function ShImgPubAction(Request $request)
    {   $td = $request->get('td');
        $Publicite = $this->getDoctrine()->getManager()->getRepository('GarantiaBundle:Publicite')->findBy(array('id'=>$td));


        return $this->render('Publicite/ShImgPub.html.twig', ['pub' => $Publicite]);


    }

    public function testAction(Request $request)
    {
        return $this->render('Publicite/test.html.twig');


    }


}