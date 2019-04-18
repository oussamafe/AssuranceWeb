<?php

namespace PubliciteBundle\Controller;

use PiBundle\Entity\User;
use PubliciteBundle\Entity\Article;
use PubliciteBundle\Entity\Publicite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PubliciteBundle:Default:index.html.twig');
    }

    public function allAction(){
        $em= $this->getDoctrine()->getManager();
        $tasks= $this->getDoctrine()->getManager()
            ->getRepository('PubliciteBundle:Publicite')
            ->findAll();
        $query = $em->createQuery('SELECT u FROM PubliciteBundle:Publicite u ');
        $users = $query->getResult();

        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($users);
        return new JsonResponse($formatted);
    }

    public function allPersoAction(Request $request){
        $em= $this->getDoctrine()->getManager();
        $tasks= $this->getDoctrine()->getManager()
            ->getRepository('PubliciteBundle:Publicite')
            ->findAll();
        $query = $em->createQuery('SELECT u FROM PubliciteBundle:Publicite u WHERE u.user=:p ')
            ->setParameter('p',$request->get('idUser'));
        $users = $query->getResult();

        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($users);
        return new JsonResponse($formatted);
    }

    public function allPersoArticleAction(Request $request){
        $em= $this->getDoctrine()->getManager();
        $tasks= $this->getDoctrine()->getManager()
            ->getRepository('PubliciteBundle:Publicite')
            ->findAll();
        $query = $em->createQuery('SELECT u FROM PubliciteBundle:Article u WHERE u.user=:p ')
            ->setParameter('p',$request->get('idUser'));
        $users = $query->getResult();

        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($users);
        return new JsonResponse($formatted);
    }

    public function trendAction(){
        $em= $this->getDoctrine()->getManager();
        $tasks= $this->getDoctrine()->getManager()
            ->getRepository('PubliciteBundle:Rating')
            ->Trend();


        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function byidAction($id){
        $tasks= $this->getDoctrine()->getManager()
            ->getRepository('PubliciteBundle:Publicite')
            ->find($id);
        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function newAction(Request $request){
        $em= $this->getDoctrine()->getManager();
        $user=$em->getRepository('PiBundle:User')->find($request->get('idUser'));
        $task= new Publicite();
        $task->setText($request->get('text'));
        $task->setDescription($request->get('description'));
        $task->setSiteWeb($request->get('siteweb'));
        $task->setTags($request->get('tags'));
        $task->setImage($request->get('image'));
        $task->setUser($user);
        $user->setPointFidelite($user->getPointFidelite()-100);

        $em->persist($task);
        $em->flush();
        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($task);
        return new JsonResponse($formatted);
    }

    public function deleteAction(Publicite $publicite){
        $em=$this->getDoctrine()->getManager();
        //   $commentaire=$em->getRepository(Article::class)->find($id);

        $em->remove($publicite);
        $em->flush();

        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($publicite);
        return new JsonResponse($formatted);
    }

    public function newarticleAction(Request $request){
        $em= $this->getDoctrine()->getManager();
        $user=$em->getRepository('PiBundle:User')->find($request->get('idUser'));
        $task= new Article();
        $task->setTitre($request->get('titre'));
        $task->setContenu($request->get('contenu'));

        $task->setTags($request->get('tags'));
        $task->setImage($request->get('image'));
        $task->setUser($user);
        $task->setDatecreation(new \DateTime());
        $user->setPointFidelite($user->getPointFidelite()+50);
        $em->persist($task);
        $em->flush();
        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($task);
        return new JsonResponse($formatted);
    }

    public function deletearticleAction(Article $article){
        $em=$this->getDoctrine()->getManager();
        //   $commentaire=$em->getRepository(Article::class)->find($id);

        $em->remove($article);
        $em->flush();

        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($article);
        return new JsonResponse($formatted);
    }

    public function allArticleAction(){
        $em= $this->getDoctrine()->getManager();
        $tasks= $this->getDoctrine()->getManager()
            ->getRepository('PubliciteBundle:Article')
            ->findAll();
        $query = $em->createQuery('SELECT u.contenu FROM PubliciteBundle:Article u WHERE u.id=1 ');
        $users = $query->getResult();
        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function uploadImageAction(Request $request)
    {
        $imagename = $request->request->get('imagename');
        $Imagecode = $request->request->get('image');
        define('UPLOAD_DIR', 'C:/wamp64/www/planners/web/');
        $img = base64_decode($Imagecode);
        $uid = uniqid();
        $file = UPLOAD_DIR . $imagename . '.jpg';
        $success = file_put_contents($file, $img);
        if ($success) {
            return new JsonResponse(array('info' => $imagename . '.jpg'));
        } else {
            return new JsonResponse(array('info' => 'erreur'));
        }
    }

    public function clickAction($id){
        $em= $this->getDoctrine()->getManager();
        $tasks= $this->getDoctrine()->getManager()
            ->getRepository('PubliciteBundle:Publicite')
            ->find($id);
        $tasks->setNbClick($tasks->getNbClick()+1);
        $em->persist($tasks);
        $em->flush();
        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function newUserAction(Request $request){
        $em= $this->getDoctrine()->getManager();
       // $user=$em->getRepository('PiBundle:User')->find($request->get('idUser'));
        $task= new User();
        $task->setNom($request->get('nom'));
        $task->setPrenom($request->get('prenom'));

        $task->setEmail($request->get('email'));
        $task->setNbreSignal(0);
        $task->setPointFidelite(0);
        $task->setUsername($request->get('username'));
        $task->setPlainPassword($request->get('password'));

        $em= $this->getDoctrine()->getManager();
        $tasks= $this->getDoctrine()->getManager()
            ->getRepository('PiBundle:User')
            ->findAll();

        $em->persist($task);
        $em->flush();
        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function allUserAction(){

        $tasks= $this->getDoctrine()->getManager()
            ->getRepository('PiBundle:User')
            ->findAll();

        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }
}
