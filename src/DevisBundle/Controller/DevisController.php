<?php

namespace DevisBundle\Controller;


use DevisBundle\Entity\TypeAssurance;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DevisBundle\Entity\Devis;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use UserBundle\Entity\User;

class DevisController extends Controller
{
    /**
     *
     */
    public function ShowAllAction(Request $request)
    {
        // replace this example code with whatever you need
        $posts = $this->getDoctrine()->getRepository('DevisBundle:Devis')->findBy(array('idClient' =>$this->getUser()));
        $em=$this->getDoctrine()->getManager();
        $model = $em->getRepository("GarantiaBundle:CategorieActu")->findAll();
        $user=$this->getUser();
        return $this->render('Devis/index.html.twig',['posts'=>$posts,'categorieActu' => $model, 'user' => $user]);

    }



    public function combAction(Request $request){


        $data=new \GarantiaBundle\Entity\TypeAssurance();


  $form = $this->createFormBuilder($data)
      ->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em=$this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
            return $this->render('Devis/combo.html.twig', array('nom'=>$data->getNom()));

        }
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('DevisBundle:TypeAssurance')->findAll();


        return $this->render('Devis/combo.html.twig', array(
            'news' => $data,
            'form' => $form->createView(),
            'categories' => $categories,
        ));




    }



    public function createAction(Request $request)
    {

        $r= new Devis();
        $form = $this->createFormBuilder($r)
            ->add('idAssurance', EntityType::class, [
                // looks for choices from this entity
                'class' => \GarantiaBundle\Entity\TypeAssurance::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'nom',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('champ1',TextType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('champ2',TextType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('champ3',TextType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('champ4',TextType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('critere1', ChoiceType::class, [
                'choices' => [
                    'Oui' => True,
                    'Non' => False,
                ],
            ])

            ->add('critere2', ChoiceType::class, [
                'choices' => [
                    'Oui' => True,
                    'Non' => False,
                ],
            ])
            ->add('critere3', ChoiceType::class, [
                'choices' => [
                    'Oui' => True,
                    'Non' => False,
                ],
            ])
            ->add('critere4', ChoiceType::class, [
                'choices' => [
                    'Oui' => True,
                    'Non' => False,
                ],
            ])
            ->add('save',SubmitType::class,array('label'=>'Create Devis','attr'=>array('class'=>'btn btn-primary') ))


            ->getForm();


        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {
            $champ1=$form['champ1']->getData();
            $champ2=$form['champ2']->getData();
            $champ3=$form['champ3']->getData();
            $champ4=$form['champ4']->getData();
            $critere1=$form['critere1']->getData();
            $critere2=$form['critere2']->getData();
            $critere3=$form['critere3']->getData();
            $critere4=$form['critere4']->getData();
            $typeform=$form['idAssurance']->getData();

            $em=$this->getDoctrine()->getManager();
            $type = new \GarantiaBundle\Entity\TypeAssurance();
          //  $ty=$em->find('DevisBundle:Devis',5)->getIdAssurance();
            $r->setIdAssurance($typeform->getId());
           // $type = $this->getDoctrine()->getRepository('GarantiaBundle:TypeAssurance')->find($ty);



            $user = $this->getUser();
            $r->setIdClient($user->getId());
            $r->setchamp1($champ1);
            $r->setchamp2($champ2);
            $r->setchamp3($champ3);
            $r->setchamp4($champ4);
            $r->setcritere1($critere1);
            $r->setcritere2($critere2);
            $r->setcritere3($critere3);
            $r->setcritere4($critere4);
            $total=$typeform->getPrixInitial()+$typeform->getDevis1()*$r->getCritere1()+$r->getCritere2()*$typeform->getDevis2()+$r->getCritere3()*$typeform->getDevis3()+$r->getCritere4()*$typeform->getDevis4();
            $r->settotal($total);
            $r->setDateDevis(new \DateTime('now'));



            $em=$this->getDoctrine()->getManager();
            $em->persist($r);
            $em->flush();
            return $this->redirectToRoute('_ViewD', array('id' => $r->getId()));
        }
        $em=$this->getDoctrine()->getManager();
        $model = $em->getRepository("GarantiaBundle:CategorieActu")->findAll();
        $user=$this->getUser();
        return $this->render('Devis/create.html.twig',['form'=>$form->createView(),'categorieActu' => $model, 'user' => $user]);
    }


    public function viewAction(Request $request ,$id)
    {
        $devis= new Devis();
        $user= new User();
        $type= new \GarantiaBundle\Entity\TypeAssurance();
        $devis = $this->getDoctrine()->getRepository('DevisBundle:Devis')->find($id);
        $type = $this->getDoctrine()->getRepository('GarantiaBundle:TypeAssurance')->find($devis->getIdAssurance());
        $user = $this->getDoctrine()->getRepository('UserBundle:User')->find($devis->getIdClient());

       // var_dump($type->getNom());



        $em=$this->getDoctrine()->getManager();
        $model = $em->getRepository("GarantiaBundle:CategorieActu")->findAll();
        return $this->render('Devis/view.html.twig',array('devis'=>$devis,'type'=>$type,'categorieActu' => $model,'user'=>$user));
    }


    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $r=$em->getRepository('DevisBundle:Devis')->find($id);
        $em->remove($r);
        $em->flush();
        return $this->render('Devis/delete.html.twig');
    }
    public function updateAction($id,Request $request)
    {  $r= $this->getDoctrine()->getManager()->getRepository('DevisBundle:Devis')->find($id);

        $r->setchamp1($r->getchamp1());
        $r->setchamp2($r->getchamp2());
        $r->setchamp3($r->getchamp3());
        $r->setchamp4($r->getchamp4());
        $r->setcritere1($r->getcritere1());
        $r->setcritere2($r->getcritere2());
        $r->setcritere3($r->getcritere3());
        $r->setcritere4($r->getcritere4());
        $r->settotal($r->gettotal());
        $form = $this->createFormBuilder($r)
            ->add('idAssurance', EntityType::class, [
                // looks for choices from this entity
                'class' => \GarantiaBundle\Entity\TypeAssurance::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'nom',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('champ1',TextType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('champ2',TextType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('champ3',TextType::class,array('attr'=>array('class'=>'form-control') ))

            ->add('champ4',TextType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('critere1', ChoiceType::class, [
                'choices' => [
                    'Oui' => True,
                    'Non' => False,
                ],
            ])

            ->add('critere2', ChoiceType::class, [
                'choices' => [
                    'Oui' => True,
                    'Non' => False,
                ],
            ])
            ->add('critere3', ChoiceType::class, [
                'choices' => [
                    'Oui' => True,
                    'Non' => False,
                ],
            ])
            ->add('critere4', ChoiceType::class, [
                'choices' => [
                    'Oui' => True,
                    'Non' => False,
                ],
            ])

            ->add('save',SubmitType::class,array('label'=>'Update Devis','attr'=>array('class'=>'btn btn-primary') ))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {


            $champ1=$form['champ1']->getData();
            $champ2=$form['champ2']->getData();
            $champ3=$form['champ3']->getData();
            $champ4=$form['champ4']->getData();
            $critere1=$form['critere1']->getData();
            $critere2=$form['critere2']->getData();
            $critere3=$form['critere3']->getData();
            $critere4=$form['critere4']->getData();
            $typeform=$form['idAssurance']->getData();

            $em=$this->getDoctrine()->getManager();
         //   $ty=$em->find('DevisBundle:Devis',5)->getIdAssurance();
          //  $r->setIdAssurance($ty);
            //$type = $this->getDoctrine()->getRepository('GarantiaBundle:TypeAssurance')->find($ty);
            $r=$em->getRepository('DevisBundle:Devis')->find($id);
          //  $us=$em->find('DevisBundle:Devis',5)->getIdAssurance();
         //   var_dump($typeform->getId());
            $r->setIdAssurance($typeform->getId());

         //   $us1=$em->find('DevisBundle:Devis',5)->getIdClient();

            $user = $this->getUser();
            $r->setIdClient($user->getId());
            $r->setchamp1($champ1);
            $r->setchamp2($champ2);
            $r->setchamp3($champ3);
            $r->setchamp4($champ4);
            $r->setcritere1($critere1);
            $r->setcritere2($critere2);
            $r->setcritere3($critere3);
            $r->setcritere4($critere4);
            $total=$typeform->getPrixInitial()+$typeform->getDevis1()*$r->getCritere1()+$r->getCritere2()*$typeform->getDevis2()+$r->getCritere3()*$typeform->getDevis3()+$r->getCritere4()*$typeform->getDevis4();
            $r->settotal($total);
            $r->setDateDevis(new \DateTime('now'));

            $em->flush();
            return $this->redirectToRoute('_ViewD', array('id' => $r->getId()));
        }
        $em=$this->getDoctrine()->getManager();
        // replace this example code with whatever you need
        $model = $em->getRepository("GarantiaBundle:CategorieActu")->findAll();
        $user=$this->getUser();
        return $this->render('Devis/update.html.twig',['form'=>$form->createView(),'categorieActu' => $model, 'user' => $user]);
    }


    public function pdfAction($id)
    {   $em = $this->getDoctrine()->getManager();
        $devis =$em->getRepository('DevisBundle:Devis')->find($id);
        $snappy = $this->get('knp_snappy.pdf');

        $type = $this->getDoctrine()->getRepository('GarantiaBundle:TypeAssurance')->find($devis->getIdAssurance());
        $user = $this->getDoctrine()->getRepository('UserBundle:User')->find($devis->getIdClient());
        $html = $this->renderView('Devis/pdf.html.twig', array('devis'=>$devis,'type'=>$type,'user'=>$user
            //..Send some data to your view if you need to //
        ));

        $filename = 'Devis';


        return new Response(

            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )
        )
            ;
    }


    public function chercherAction(Request $request)
    {     $em = $this->getDoctrine()->getManager();


       // $devis = $this->getDoctrine()->getRepository('DevisBundle:Devis')->find($id);
        $type = $this->getDoctrine()->getRepository('GarantiaBundle:TypeAssurance')->find($request->get('text'));
       // $user = $this->getDoctrine()->getRepository('UserBundle:User')->find($devis->getIdClient());
        if($request->isXmlHttpRequest() && $request->isMethod('post') && $request->get('text')!=null){

            $text =$request->get('text');
            $em = $this->getDoctrine()->getEntityManager();
            if($request->get("btns")!=null)
            {
                $query =$em->getRepository('PubliciteBundle:Article')->createQueryBuilder('u');
                $annonce= $query->where($query->expr()->like('u.titre',':p'))
                    ->setParameter('p','%'.$text.'%')
                    ->getQuery()->getResult();
                $response = $this->renderView('@Publicite/article/search.html.twig',array('articles'=>$annonce));
                return  new JsonResponse($response) ;



            }
            if($request->get("btnval")!=null)
            {
               //var_dump($request->get('text'));
                $serializer= new Serializer([new ObjectNormalizer()]);
                $formatted= $serializer->normalize($type);
                return  new JsonResponse( $formatted);
            }

        }elseif ( $request->get('text')==null && $request->get("btns")!=null){
            $em = $this->getDoctrine()->getEntityManager();
            $query =$em->getRepository('PubliciteBundle:Article')->createQueryBuilder('u');
            $annonce= $query
                ->getQuery()->getResult();
            $response = $this->renderView('@Publicite/article/search.html.twig',array('articles'=>$articles));
            return  new JsonResponse($response) ;


        }elseif ( $request->get('text')==null && $request->get("btnval")!=null ){
            $em = $this->getDoctrine()->getEntityManager();
            $query =$em->getRepository('PubliciteBundle:Article')->createQueryBuilder('u');
            $annonce= $query
                ->getQuery()->getResult();
            $response = $this->renderView('@Publicite/article/searchAll.html.twig',array('articles'=>$all));
            return  new JsonResponse($response) ;
        }

        return new JsonResponse(array("status"=>true));

    }


    public function createTypeAction(Request $request)
    {

        $r= new \GarantiaBundle\Entity\TypeAssurance();
        $form = $this->createFormBuilder($r)
            ->add('nom',TextType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('champ1',TextType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('champ2',TextType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('champ3',TextType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('champ4',TextType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('critere1',TextType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('devis1',IntegerType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('critere2',TextType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('devis2',IntegerType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('critere3',TextType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('devis3',IntegerType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('critere4',TextType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('devis4',IntegerType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('prix_initial',IntegerType::class,array('attr'=>array('class'=>'form-control') ))
            ->add('save',SubmitType::class,array('label'=>'Create Devis','attr'=>array('class'=>'btn btn-primary') ))


            ->getForm();


        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {
            $champ1=$form['champ1']->getData();
            $champ2=$form['champ2']->getData();
            $champ3=$form['champ3']->getData();
            $champ4=$form['champ4']->getData();
            $critere1=$form['critere1']->getData();
            $critere2=$form['critere2']->getData();
            $critere3=$form['critere3']->getData();
            $critere4=$form['critere4']->getData();
            $devis1=$form['devis1']->getData();
            $devis2=$form['devis2']->getData();
            $devis3=$form['devis3']->getData();
            $devis4=$form['devis4']->getData();
            $prix=$form['prix_initial']->getData();
            $nom=$form['nom']->getData();

            $em=$this->getDoctrine()->getManager();
            $type = new \GarantiaBundle\Entity\TypeAssurance();
            //  $ty=$em->find('DevisBundle:Devis',5)->getIdAssurance();

            // $type = $this->getDoctrine()->getRepository('GarantiaBundle:TypeAssurance')->find($ty);



            $user = $this->getUser();

            $r->setchamp1($champ1);
            $r->setchamp2($champ2);
            $r->setchamp3($champ3);
            $r->setchamp4($champ4);
            $r->setcritere1($critere1);
            $r->setcritere2($critere2);
            $r->setcritere3($critere3);
            $r->setcritere4($critere4);
            $r->setDevis1($devis1);
            $r->setDevis2($devis2);
            $r->setDevis3($devis3);
            $r->setDevis4($devis4);
            $r->setPrixInitial($prix);

            $em=$this->getDoctrine()->getManager();
            $em->persist($r);
            $em->flush();
            return $this->redirectToRoute('_ShowType');
        }
        $em=$this->getDoctrine()->getManager();
        $model = $em->getRepository("GarantiaBundle:CategorieActu")->findAll();
        $user=$this->getUser();
        return $this->render('Devis/createType.html.twig',['form'=>$form->createView(),'categorieActu' => $model, 'user' => $user]);
    }

    public function ShowTypeAction(Request $request)
    {
        // replace this example code with whatever you need
        $posts = $this->getDoctrine()->getRepository('GarantiaBundle:TypeAssurance')->findAll();
        $em=$this->getDoctrine()->getManager();
        $model = $em->getRepository("GarantiaBundle:CategorieActu")->findAll();
        $user=$this->getUser();
        return $this->render('Devis/indexType.html.twig',['posts'=>$posts,'categorieActu' => $model, 'user' => $user]);
    }
    public function TriAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = "SELECT * FROM devis WHERE DATEDIFF(CURDATE(),date_devis)>10";

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll();
        $em=$this->getDoctrine()->getManager();
        $model = $em->getRepository("GarantiaBundle:CategorieActu")->findAll();
        $user=$this->getUser();
        return $this->render('Devis/index.html.twig', ['posts' => $result,'categorieActu' => $model, 'user' => $user]);
    }


}
