<?php

namespace GarantiaBundle\Controller;


use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GarantiaBundle\Entity\Reclamation;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use GarantiaBundle\Entity\Chat;

class ReclamationController extends Controller
{
    public function showreclamationAction()
    { $em=$this->getDoctrine()->getManager();
        $id = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $user = $em->getRepository('UserBundle:User')->findOneBy(['id' => $id]);
        $posts = $this->getDoctrine()->getRepository('GarantiaBundle:Reclamation')->findBy(['idClient' => $user]);
        return $this->render('Reclamation/showreclamation.html.twig',['posts'=>$posts]);
    }


    public function CreateRecAction(Request $request)
    {
        $reclamation = new Reclamation();
        $form = $this->createFormBuilder($reclamation)
            ->add('objet', ChoiceType::class, [
                'choices' => [
                    'devis' => 'devis',
                    'type assurance' => 'type assurance',
                ],'choice_label' => function ($obj, $key, $value) {
                    return $obj;
                }
            ])
            ->add('contenu',CKEditorType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('type',ChoiceType::class, [
                'choices' => [
                    'Urgente' => 'Urgente',
                    'non Urgente' => 'non Urgente',
                ],'choice_label' => function ($obj, $key, $value) {
                    return $obj;
                }
            ])
            ->add('save',SubmitType::class,array('label'=>'Create Reclamation','attr'=>array('class'=>'btn btn-primary') ))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {
            $objet=$form['objet']->getData();
            $contenu=$form['contenu']->getData();
            $type=$form['type']->getData();
            {

                $reclamation->setObjet($objet);
                $reclamation->setContenu($contenu);
                $reclamation->setType($type);
                $reclamation->setEtat('non traitée');
                $reclamation->setReponse('');
                $reclamation->setDate(new \DateTime('now'));
                $em=$this->getDoctrine()->getManager();
                $id = $this->get('security.token_storage')->getToken()->getUser()->getId();
                $user = $em->getRepository('UserBundle:User')->findOneBy(['id' => $id]);
                $reclamation->setIdClient($user);


                $em->persist($reclamation);
                $em->flush();
                $this->addFlash('message','Reclamation Crée');


            }
            return $this->redirectToRoute('show_front_Reclamation');
        }
        return $this->render('Reclamation/createreclamation.html.twig',['form'=>$form->createView()]);

    }
    /**
     *
     */
    public function DeleteRecAction($id)
    {$em=$this->getDoctrine()->getManager();
        $r=$em->getRepository('GarantiaBundle:Reclamation')->find($id);
        $em->remove($r);
        $em->flush();
        return $this->redirectToRoute('show_front_Reclamation');
    }

    public function EditRecAction(Request $request,$id)
    {   $r= $this->getDoctrine()->getManager()->getRepository('GarantiaBundle:Reclamation')->find($id);
        $r->setObjet($r->getObjet());
        $r->setContenu($r->getContenu());
        $r->setType($r->getType());
        $form = $this->createFormBuilder($r)
            ->add('objet',ChoiceType::class, [
                'choices' => [
                    'devis' => 'devis',
                    'type assurance' => 'type assurance',
                ],'choice_label' => function ($obj, $key, $value) {
                    return $obj;
                }
            ])
            ->add('contenu',CKEditorType::class,array('attr'=>array('class'=>'form-control') ))

            ->add('type',ChoiceType::class, [
                'choices' => [
                    'Urgente' => 'Urgente',
                    'non Urgente' => 'non Urgente',
                ],'choice_label' => function ($obj, $key, $value) {
                    return $obj;
                }
            ])
            ->add('save',SubmitType::class,array('label'=>'Modifier La Reclamation','attr'=>array('class'=>'btn btn-primary') ))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {

            $objet=$form['objet']->getData();
            $contenu=$form['contenu']->getData();
            $type=$form['type']->getData();

            $em=$this->getDoctrine()->getManager();
            $r=$em->getRepository('GarantiaBundle:Reclamation')->find($id);

            $r->setObjet($objet);
            $r->setContenu($contenu);
            $r->setType($type);
            $r->setEtat('non traitée');
            $r->setReponse('');


            $em->flush();
            return $this->redirectToRoute('show_front_Reclamation');
        }

        // replace this example code with whatever you need
        return $this->render('Reclamation/editreclamation.html.twig',['form'=>$form->createView()]);
    }




    public function ShowRAdmAction()
    {
        $dat=new \DateTime('now');
        $dat->format('d/m/Y');
        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = "SELECT * FROM reclamation where  type='Urgente' and etat='non traitée' and  DATEDIFF(CURDATE(),date)>7";

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll();

        return $this->render('Reclamation/ShowRAdm.html.twig',['posts'=>$result]);
    }



    public function ShowEAdmAction(Request $request)
    {
        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM UserBundle:User u WHERE (u.roles NOT LIKE :role) AND (u.roles NOT LIKE :role1) AND (u.roles NOT LIKE :role2) '
            )->setParameters(array('role' => '%"ROLE_SUPER_ADMIN"%', 'role1' => '%"ROLE_CLIENT"%', 'role2' => '%"ROLE_EXPERT"%'));
        $emp = $query->getResult();
        $td=$request->get('td');
        $arr['tdi']=$td;
        return $this->render('Reclamation/ShowEAdm.html.twig', array('emp'=>$emp,'arr'=>$arr));

    }


    public function ShowREmpAction()
    {

        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = "SELECT * FROM reclamation ";

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll();

        return $this->render('Reclamation/ShowREmp.html.twig',['posts'=>$result]);
    }

    public function ShowDetRecAction(Request $request)
    {   $id=$request->get('id');

        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = "SELECT * FROM reclamation where  id='$id' ";

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll();



        return $this->render('Reclamation/ShowDetRec.html.twig',['posts'=>$result]);
    }


    public function SaveRecAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = "SELECT * FROM reclamation ";

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll();


        $id=$request->get('id');
        $rep=$request->get('rep');
        $etat=$request->get('etat');



        $r= $this->getDoctrine()->getManager()->getRepository('GarantiaBundle:Reclamation')->find($id);


        $r->setEtat($etat);
        $r->setReponse($rep);
        $e = $this->getDoctrine()->getManager();
        $e->persist($r);
        $e->flush();

        return $this->redirectToRoute('ShowREmp');

    }



    public function TriRecAction(Request $request)
    {
        $nom=$request->get('nom');
        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = "SELECT * FROM reclamation WHERE type='$nom'";

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll();

        return $this->render('Reclamation/ShowREmp.html.twig',['posts'=>$result]);
    }


}
