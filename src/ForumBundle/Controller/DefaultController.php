<?php

namespace ForumBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Commentaire;
use AppBundle\Entity\Forum;
use AppBundle\Entity\Reclamation;
use AppBundle\Repository\CommentaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $forums = $em->getRepository('AppBundle:Forum')->findAll();

        foreach ($forums as $forum) {

            $comments = $em->getRepository('AppBundle:Commentaire')->findBy([
                "idF"=>$forum->getIdF()
            ]);

            $forum->setCountComments(count($comments));

        }



        $model = $em->getRepository("GarantiaBundle:CategorieActu")->findAll();
        return $this->render('@Forum/Default/index.html.twig',array(
            'forums' => $forums,
            'user' => $user,
            'categorieActu' => $model
        ));
    }

    public function addAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        // var_dump($user);
        $forum = new Forum();
        if ($request->isMethod('POST')) {
            $time = date("Y/m/d");

            $forum->setDescriptionF($request->get('description'));
            $forum->setDate(new \DateTime("now"));
            $user = $this->getUser();
            $forum->setIdUser($user);
            $em = $this->getDoctrine()->getManager();
            //   var_dump($time);
            $em->persist($forum);
            $em->flush();

            //send messages tel
            $basic  = new \Nexmo\Client\Credentials\Basic('b6885d8d', 'lMQmAeMapbtB8faz');
            $client = new \Nexmo\Client($basic);

       /*     $message = $client->message()->send([
                'to' => '21627651140',
                'from' => 'Nexmo',
                'text' => 'Votre Forum a été ajouté avec success !'
            ]);
*/
            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Le forum a été ajouté avec succées ...!');
            return $this->redirectToRoute('forum_homepage');
        }
        $em = $this->getDoctrine()->getManager();
        $model = $em->getRepository("GarantiaBundle:CategorieActu")->findAll();

        return $this->render('@Forum/Default/ajout.html.twig',array('categorieActu' => $model, 'user' => $user));

    }


    public function detailsAction(Request $request,$id)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $comments = $em->getRepository('AppBundle:Commentaire')->findBy([
            "idF"=>$id
        ]);

        // $em = $this->getDoctrine()->getManager();
        //  $nbrcom =$this->getDoctrine()->getRepository('AppBundle:Commentaire')->findParticipantDQL($id);
        //var_dump($nbrcom);
        $forum = $this->getDoctrine()->getRepository('AppBundle:Forum')->find($id);

        $comments = $em->getRepository('AppBundle:Commentaire')->findBy([
            "idF"=>$id
        ]);

        $forum->setCountComments(count($comments));

        $comment = new Commentaire();
        if ($request->isMethod('POST')) {
            $time = date("Y/m/d");
            $comment->setDescriptionCom($request->get('message'));
            $comment->setDateCom(new \DateTime("now"));
            $comment->setIdUser($user);
            $comment->setIdF($forum);
            // var_dump($comment);
            $em = $this->getDoctrine()->getManager();

            $em->persist($comment);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Commentaire a été ajouté avec succées ...!');

            return $this->redirectToRoute('detailsF',array('id' => $id));
        }


        // var_dump($comments);
        $em = $this->getDoctrine()->getManager();
        $model = $em->getRepository("GarantiaBundle:CategorieActu")->findAll();
        return $this->render('@Forum/Default/details.html.twig',array(
            'categorieActu' => $model,
            'forum' => $forum,
            'comments'=>$comments,
            'user' => $user
        ));
    }

    public function modifierAction(Request $request , $id)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        // $em = $this->getDoctrine()->getManager();
        $forum = $this->getDoctrine()->getRepository('AppBundle:Forum')->find($id);



        // var_dump($id);
        if ($request->isMethod('POST')) {
            $forum->setDescriptionF($request->get('description'));
            $forum->setDate(new \DateTime("now"));
            $forum->setIdUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($forum);
            $em->flush();
            //return $this->redirectToRoute('index_back');

            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Lévénement a été modifié avec succées ...!');


            $url = $this->generateUrl('forum_homepage');

            return $this->redirect($url);
        }
        $em = $this->getDoctrine()->getManager();
        $model = $em->getRepository("GarantiaBundle:CategorieActu")->findAll();
        return $this->render('@Forum/Default/modifier.html.twig',array(
            'categorieActu' => $model,
            'forum' => $forum,
            'user' => $user
        ));
    }

    public function supprimerAction($id,Request $request)
    {

        $user = $this->container->get('security.token_storage')->getToken()->getUser();


        $forum = $this->getDoctrine()->getRepository('AppBundle:Forum')->find($id);
       // var_dump($forum);

        $em =$this->getDoctrine()->getManager();
        $em->remove($forum);
        $em->flush();
        $request->getSession()
            ->getFlashBag()
            ->add('success', 'Le forum a été supprimer avec succées ...!');

        return $this->redirectToRoute('forum_homepage');
    }


    public function reclamerAction($id)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $forum = $this->getDoctrine()->getRepository('AppBundle:Forum')->find($id);

        $reclamation = new Reclamation();
        if ($request->isMethod('POST')) {

            $reclamation->setDescription($request->get('reclamation'));
            $reclamation->setDateRec(new \DateTime("now"));
            $reclamation->setIdUser($user);
            $reclamation->setIdForum($id);
            $reclamation->setEtat("En Cours");
            $reclamation->setNumTel("25059894");
            $reclamation->setSujet("sujet");



            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();
            //return $this->redirectToRoute('index_back');
            /*     $request->getSession()
                     ->getFlashBag()
                     ->add('success', 'Lévénement a été ajouté avec succées ...!');
            */

            $url = $this->generateUrl('forum_homepage');

            return $this->redirect($url);

        }


        return $this->render('@Forum/Default/reclamation.html.twig',array(
            'forum' => $forum
        ));
    }


    public function afficherRecAction($id)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $reclamations = $em->getRepository('AppBundle:Reclamation')->findBy([
            "idForum"=>$id
        ]);

        return $this->render('@Forum/Default/afficherRec.html.twig',array(
            'reclamations' => $reclamations,
            'user' => $user
        ));
    }

    public function mesForumsAction($id)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $forums = $em->getRepository('AppBundle:Forum')->findBy([
            "idUser"=>$user
        ]);

        foreach ($forums as $forum) {

            $comments = $em->getRepository('AppBundle:Commentaire')->findBy([
                "idF"=>$forum->getIdF()
            ]);

            $forum->setCountComments(count($comments));

        }



        $em = $this->getDoctrine()->getManager();
        $model = $em->getRepository("GarantiaBundle:CategorieActu")->findAll();
        return $this->render('@Forum/Default/mesforums.html.twig',array(
            'forums' => $forums,
            'user' => $user,
            'categorieActu' => $model
        ));
    }

    public function participeAction()
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $mesComments = $em->getRepository('AppBundle:Commentaire')->findBy([
            "idUser"=>$user
        ]);



        $forums= array();

        foreach ($mesComments as $comment) {

            $f = $em->getRepository('AppBundle:Forum')->findOneBy([
                "idF"=>$comment->getIdF()
            ]);


            $for = new Forum();
            $for->setIdF($f->getIdF());
            $for->setDate($f->getDate());
            $for->setDescriptionF($f->getDescriptionF());
            $for->setIdUser($f->getIdUser());
            $comments = $em->getRepository('AppBundle:Commentaire')->findBy([
                "idF"=>$for->getIdF()
            ]);

            $for->setCountComments(count($comments));
            //$for->setCountComments(4);
            //pour verifier redondance
            $existe = false ;



            foreach ($forums as $fff){
                if($fff == $for) $existe = true;
            }
            if(!$existe) array_push($forums,$for);




        }

        //   $forums = array_unique($forumsss);

//   var_dump(count($forums));

        $em = $this->getDoctrine()->getManager();
        $model = $em->getRepository("GarantiaBundle:CategorieActu")->findAll();
        return $this->render('@Forum/Default/participe.html.twig',array(
            'forums' => $forums,
            'user' => $user,
            'categorieActu' => $model
        ));
    }


    public function chartAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $forums = $em->getRepository('AppBundle:Forum')->findAll();

        foreach ($forums as $forum) {

            $comments = $em->getRepository('AppBundle:Commentaire')->findBy([
                "idF"=>$forum->getIdF()
            ]);

            $forum->setCountComments(count($comments));

        }
        $em = $this->getDoctrine()->getManager();
        $model = $em->getRepository("GarantiaBundle:CategorieActu")->findAll();
        return $this->render('@Forum/Default/chart.html.twig', array(
            'forums' => $forums,
            'categorieActu' => $model,
            'user' => $user,
        ));
    }


    public function backAction()
    {
        $em = $this->getDoctrine()->getManager();

        $publicites = $em->getRepository('AppBundle:Forum')->findBy(array('etat' =>0));
        // $publicites2 = $em->getRepository('PubliciteBundle:Publicite')->findBy(array('user' =>$this->getUser()));

        return $this->render('@Forum/Default/back.html.twig', array(
            'publicites' => $publicites,

        ));
    }

    public function validerAction(Request $request, Forum $forum)
    {
        $em = $this->getDoctrine()->getManager();
        $forum->setEtat(1);
        $this->getDoctrine()->getManager()->flush();
        $publicites = $em->getRepository('AppBundle:Forum')->findBy(array('etat' =>0));
        return $this->redirectToRoute('back_forum', array(
            'publicites' => $publicites,

        ));
    }

    public function refuserAction(Request $request, Forum $forum)
    {
        $em = $this->getDoctrine()->getManager();
        $forum->setEtat(-1);
        $this->getDoctrine()->getManager()->flush();
        $publicites = $em->getRepository('AppBundle:Forum')->findBy(array('etat' =>0));
        return $this->redirectToRoute('back_forum', array(
            'publicites' => $publicites,

        ));
    }








}
