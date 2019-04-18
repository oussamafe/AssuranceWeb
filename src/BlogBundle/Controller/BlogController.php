<?php

namespace BlogBundle\Controller;

use BlogBundle\Form\BlogType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Blog;
use UserBundle\Entity\dislikes;
use UserBundle\Entity\likes;
use UserBundle\Entity\Vue;

class BlogController extends Controller
{
    public function articleAction(Request $request, $id)
    {
        $isdisliked="";
        $isliked="";
        $m = $this->getDoctrine()->getManager();
        $blog = $m->getRepository('UserBundle:Blog')->find($id);
        if (is_object($this->getUser())) {
            $listvues = $m->getRepository('UserBundle:Vue')->findBy(array('blog' => $id, 'user' => $this->getUser()->getId()));

            if (!$listvues) {

                $User = $this->getUser();


                $vue = new Vue();

                $vue->setUser($User);

                $vue->setBlog($blog);

                $m->persist($vue);
                $m->flush();
            }



            $isliked = $m->getRepository('UserBundle:likes')->findBy(array('blog' => $id, "user" => $this->getUser()->getId()));
            $isdisliked = $m->getRepository('UserBundle:dislikes')->findBy(array('blog' => $id, "user" => $this->getUser()->getId()));
            $isliked = !empty($isliked);
            $isdisliked = !empty($isdisliked);
        }
        $listlikes = $m->getRepository('UserBundle:likes')->findBy(array('blog' => $id));
        $listdislikes = $m->getRepository('UserBundle:dislikes')->findBy(array('blog' => $id));
        $comments = $m->getRepository('UserBundle:comment')->findAll();
        $vues = $m->getRepository('UserBundle:Vue')->findBy(array('blog' => $id));

        $listblogs = $m->getRepository('UserBundle:Blog')->findById($id);
        $client = $m->getRepository('UserBundle:User')->findAll();
        $blogs = $this->get('knp_paginator')->paginate(
            $listblogs,
            $request->query->get('page', 1)/*page number*/
            ,
            1/*limit per page*/
        );


        return $this->render('@Blog/Forum/articleComment.html.twig', array(
            'blogs' => $blogs,
            'comments' => $comments,
            'client' => $client,
            'likes' => $listlikes,
            'dislikes' => $listdislikes,
            'vues' => $vues,
            'isliked' => $isliked,
            'isdisliked' => $isdisliked


        ));

    }

    public
    function AddArticleAction(Request $request)
    {
        $Blog = new Blog();
        $form = $this->createForm(BlogType::class, $Blog);
        $em = $this->getDoctrine()->getManager();
        $blogs = $em->getRepository('UserBundle:Blog')->findAll();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $Blog->uploadProfilePicture();

            $em->persist($Blog);
            $em->flush();
            return $this->redirectToRoute('forum');
        }

        return $this->render('@Blog/Forum/ajoutArticle.html.twig', array('form' => $form->createView(),
            'blogs' => $blogs,
        ));
    }

    public
    function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $blogs = $em->getRepository('UserBundle:Blog')->find($id);
        $form = $this->createForm(BlogType::class, $blogs);
        if ($form->handleRequest($request)->isValid()) {
            $blogs->uploadProfilePicture();
            $em->persist($blogs);
            $em->flush();
            return $this->redirectToRoute('forum');
        }
        return $this->render('@Blog/Forum/updateArticle.html.twig', array(
            'form' => $form->createView(),
            'blogs' => $blogs,
        ));

    }

    public
    function deleteArticleAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $blogs = $em->getRepository('UserBundle:Blog')->find($id);
        $em->remove($blogs);
        $em->flush();
        return $this->redirectToRoute('forum');

    }

    public
    function bloquerClientAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('UserBundle:User')->find($id);
        $client->setEnabled(0);
        $em->persist($client);
        $em->flush();
        return $this->redirectToRoute('commentArticle');

    }

    public
    function debloquerClientAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('UserBundle:User')->find($id);
        $client->setEnabled(1);
        $em->persist($client);
        $em->flush();
        return $this->redirectToRoute('commentArticle');

    }

    public
    function AddLikeAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $isliked = $em->getRepository('UserBundle:likes')->findBy(array('blog' => $id, "user" => $this->getUser()->getId()));

        if (empty($isliked)) {

            $dislike = $em->getRepository('UserBundle:dislikes')->findOneBy(array('blog' => $id, "user" => $this->getUser()->getId()));
            if ($dislike != null) {
                $em->remove($dislike);
                $em->flush();
            }

            $BlogId = $request->get('BlogId');

            $blo = $em->getRepository('UserBundle:Blog')->find($id);

            $User = $this->getUser();


            $lik = new likes();

            $lik->setUser($User);

            $lik->setBlog($blo);

            $em = $this->getDoctrine()->getManager();
            $em->persist($lik);
            $em->flush();
        }

        return $this->redirectToRoute('commentArticle', array('id' => $id));


    }

    public
    function AddDislikeAction(Request $request, $id)
    {


        $em = $this->getDoctrine()->getManager();
        $isdisliked = $em->getRepository('UserBundle:dislikes')->findBy(array('blog' => $id, "user" => $this->getUser()->getId()));
        if (empty($isdisliked)) {

            $like = $em->getRepository('UserBundle:likes')->findOneBy(array('blog' => $id, "user" => $this->getUser()->getId()));
            if ($like != null) {
                $em->remove($like);
                $em->flush();
            }
            $BlogId = $request->get('BlogId');

            $blo = $em->getRepository('UserBundle:Blog')->find($id);

            $User = $this->getUser();


            $dislik = new dislikes();

            $dislik->setUser($User);

            $dislik->setBlog($blo);

            $em = $this->getDoctrine()->getManager();
            $em->persist($dislik);
            $em->flush();
        }

        return $this->redirectToRoute('commentArticle', array('id' => $id));


    }

    public
    function AddViewAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $BlogId = $request->get('BlogId');

        $blo = $em->getRepository('UserBundle:Blog')->find($id);

        $User = $this->getUser();


        $vue = new Vue();

        $vue->setUser($User);

        $vue->setBlog($blo);

        $em = $this->getDoctrine()->getManager();
        $em->persist($vue);
        $em->flush();
        return $this->redirectToRoute('commentArticle', array('id' => $id));
    }
}
