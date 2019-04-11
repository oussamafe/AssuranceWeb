<?php

namespace GarantiaBundle\Controller;

use GarantiaBundle\Entity\Actualite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GarantiaBundle\Entity\ImagesActu;


/**
 * Actualite controller.
 *
 */
class ActualiteController extends Controller
{
    /**
     * Lists all actualite entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $actualites = $em->getRepository('GarantiaBundle:Actualite')->findAll();

        return $this->render('actualite/index.html.twig', array(
            'actualites' => $actualites,
        ));
    }

    /**
     * Creates a new actualite entity.
     *
     */
    public function newAction(Request $request)
    {
        $actualite = new Actualite();
        $form = $this->createForm('GarantiaBundle\Form\ActualiteType', $actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $manager = $this->get('oneup_uploader.orphanage_manager')->get('gallery');
            $files = $manager->getFiles();
            $filesup = $manager->uploadFiles();


            foreach ($filesup as $value)
            {
                $actualite->setImage($value->getFilename());
            }

            $actualite->setDatePublication();
            $em = $this->getDoctrine()->getManager();
            $em->persist($actualite);
            $em->flush();


            $manager = $this->get('oneup_uploader.orphanage_manager')->get('albums');
            $files = $manager->getFiles();
            $filesup = $manager->uploadFiles();
            foreach ($filesup as $value)
            {
                $id_article = $em->getRepository('GarantiaBundle:Actualite')->findOneBy([], ['id' => 'desc']);
                $object = new ImagesActu();
                $object->setUrl($value->getFilename());
                $object->setIdActu($id_article);
                $em->persist($object);
                $em->flush();

            }

            return $this->redirectToRoute('admin_actualite_show', array('id' => $actualite->getId()));
        }

        return $this->render('actualite/new.html.twig', array(
            'actualite' => $actualite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a actualite entity.
     *
     */
    public function showAction(Actualite $actualite)
    {
        $deleteForm = $this->createDeleteForm($actualite);

        return $this->render('actualite/show.html.twig', array(
            'actualite' => $actualite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing actualite entity.
     *
     */
    public function editAction(Request $request, Actualite $actualite)
    {
        $deleteForm = $this->createDeleteForm($actualite);
        $editForm = $this->createForm('GarantiaBundle\Form\ActualiteType', $actualite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_actualite_edit', array('id' => $actualite->getId()));
        }

        return $this->render('actualite/edit.html.twig', array(
            'actualite' => $actualite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a actualite entity.
     *
     */
    public function deleteAction(Request $request, Actualite $actualite)
    {
        $form = $this->createDeleteForm($actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {



            $em = $this->getDoctrine()->getManager();
            $em->remove($actualite);
            $em->flush();
        }

        return $this->redirectToRoute('admin_actualite_index');
    }

    /**
     * Creates a form to delete a actualite entity.
     *
     * @param Actualite $actualite The actualite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Actualite $actualite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_actualite_delete', array('id' => $actualite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function affichertousAction()
    {
        $em = $this->getDoctrine()->getManager();
        $model = $em->getRepository("GarantiaBundle:Actualite")->findAll();
        return $this->render('actualite/affichertous.html.twig' , array('actualite' => $model));
    }

    public function afficherunarticleAction()
    {

    }
}
