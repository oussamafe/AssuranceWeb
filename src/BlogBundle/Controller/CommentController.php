<?php

namespace BlogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use UserBundle\Entity\comment;

class CommentController extends Controller
{
    public function AjoutCommentAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $BlogId = $request->get('BlogId');
        $blo = $em->getRepository('UserBundle:Blog')->find($BlogId);
        $com = $request->get('commentaire');
        $User = $this->getUser();


        $comment = new comment();
        $comment->setUser($User);
        $comment->setComment($com);
        $comment->setBlog($blo);

        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();
        return $this->redirectToRoute('commentArticle', array('id' => $BlogId));
    }

    public function modifierAction(Request $request)
    {
        $commentaire_id = $request->get('commentaire_id');
        $commentaire = $request->get('commentaire');

        $em = $this->getDoctrine()->getManager();
        $ancien_commentaire = $em->getRepository("UserBundle:comment")->find($commentaire_id);

        $ancien_commentaire->setComment($commentaire);

        $em->persist($ancien_commentaire);
        $em->flush();
        $ser = new Serializer(array(new ObjectNormalizer()));
        $data = $ser->normalize("done");
        return new JsonResponse($data);
    }

    public function SuppCommentAction($id, $blogId)
    {
        $em = $this->getDoctrine()->getManager();
        $blogs = $em->getRepository('UserBundle:Blog')->find($blogId);
        $comments = $em->getRepository('UserBundle:comment')->find($id);
        $em->remove($comments);
        $em->flush();
        return $this->redirectToRoute('commentArticle', array(
            'id' => $blogId,
            'blogs' => $blogs

        ));
    }
}
