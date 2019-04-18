<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BlogBundle:Default:index.html.twig');
    }

    public function AdmindeleteArticleAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $blogs = $em->getRepository('UserBundle:Blog')->find($id);
        $em->remove($blogs);
        $em->flush();
        return $this->redirectToRoute('AdminForum');

    }

    public function AdminSuppCommentAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $comments = $em->getRepository('UserBundle:comment')->find($id);
        $em->remove($comments);
        $em->flush();
        return $this->redirectToRoute('AdminForum', array('id' => $id));
    }

    public function ForumAdminAction()
    {
        $em = $this->getDoctrine()->getManager();
        $blogs = $em->getRepository('UserBundle:Blog')->findAll();
        return $this->render('@User/Admin/Forum/ForumAdmin.html.twig', array(
            'blogs' => $blogs
        ));
    }

    public function ArticleCommAffAction($id)
    {
        $m = $this->getDoctrine()->getManager();
        $comments = $m->getRepository('UserBundle:comment')->findBy(array('blog' => $id));
        return $this->render('@User/Admin/Forum/listecomAdmin.html.twig', array(
            'comments' => $comments
        ));
    }
}
