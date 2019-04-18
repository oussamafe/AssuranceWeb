<?php

namespace RecBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use RecBundle\Entity\Reclamation;
use Symfony\Component\Form\Button;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class ReclamationController extends Controller
{
    public function ShowAllAction(Request $request)
    {
        // replace this example code with whatever you need
        $posts = $this->getDoctrine()->getRepository('RecBundle:Reclamation')->findAll();
        return $this->render('Reclamation/index1.html.twig',['posts'=>$posts]);
    }

    /**
     *
     */
    public function CreateRecAction(Request $request)
    {
        $reclamation = new Reclamation();
        $form = $this->createFormBuilder($reclamation)
            ->add('objet',ChoiceType::class, [
                'choices' => [
                    'devis' => 'devis',
                    'type assurance' => 'type assurance',
                ],'choice_label' => function ($obj, $key, $value) {
        return $obj;
            }


        ])

            ->add('contenu',TextAreaType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('type',CheckboxType::class,array('attr'=>array('class'=>'toggle') ))
            ->add('save',ButtonType::class,array('label'=>'Create Reclamation','attr'=>array('class'=>'btn btn-primary') ))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {
            $objet=$form['objet']->getData();
            $contenu=$form['contenu']->getData();
            $type='ok';
            {#"$form['type']->getData()"#}
            $reclamation->setObjet($objet);
            $reclamation->setContenu($contenu);
            $reclamation->setType($type);
            $reclamation->setEtat('non traitée');
            $reclamation->setReponse('');
            $reclamation->setDate(new \DateTime('now'));
            $em=$this->getDoctrine()->getManager();

            $us=$em->find('RecBundle:Reclamation',40)->getIdClient();
            $reclamation->setIdClient($us);


            $em->persist($reclamation);
            $em->flush();
            $this->addFlash('message','Reclamation Crée');


        }

        return $this->render('Reclamation/create.html.twig',['form'=>$form->createView()]);
    }}
    /**
     *
     */
    public function DeleteRecAction($id)
    {$em=$this->getDoctrine()->getManager();
        $r=$em->getRepository('RecBundle:Reclamation')->find($id);
        $em->remove($r);
        $em->flush();
        return $this->render('Reclamation/delete.html.twig');
    }
    /**
     *
     */
    public function ViewRecAction(Request $request,$id)
    {

        $r= $this->getDoctrine()->getManager()->getRepository('RecBundle:Reclamation')->find($id);
        $r->setObjet($r->getObjet());
        $r->setContenu($r->getContenu());
        $r->setType($r->getType());
        $form = $this->createFormBuilder($r)

            ->add('objet',TextType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('contenu',TextAreaType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('type',TextType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('save',SubmitType::class,array('label'=>'Save','attr'=>array('class'=>'btn btn-primary') ))
            ->getForm();
        $form->handleRequest($request);
        return $this->render('Reclamation/view.html.twig',['form'=>$form->createView()]);
    }
    /**
     *
     */
    public function EditRecAction(Request $request,$id)
    {   $r= $this->getDoctrine()->getManager()->getRepository('RecBundle:Reclamation')->find($id);
        $r->setObjet($r->getObjet());
        $r->setContenu($r->getContenu());
        $r->setType($r->getType());
        $form = $this->createFormBuilder($r)
            ->add('objet',TextType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('contenu',TextAreaType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('type',TextType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('save',SubmitType::class,array('label'=>'Create Reclamation','attr'=>array('class'=>'btn btn-primary') ))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {

            $objet=$form['objet']->getData();
            $contenu=$form['contenu']->getData();
            $type=$form['type']->getData();

            $em=$this->getDoctrine()->getManager();
            $r=$em->getRepository('RecBundle:Reclamation')->find($id);

            $r->setObjet($objet);
            $r->setContenu($contenu);
            $r->setType($type);
            $r->setEtat('non traitée');
            $r->setReponse('');
            $r->setDate(new \DateTime('now'));

            $em->flush();
        }

        // replace this example code with whatever you need
        return $this->render('Reclamation/edit.html.twig',['form'=>$form->createView()]);
    }

}
