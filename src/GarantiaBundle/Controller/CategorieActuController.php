<?php

namespace GarantiaBundle\Controller;

use GarantiaBundle\Entity\CategorieActu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Categorieactu controller.
 *
 */
class CategorieActuController extends Controller
{
    /**
     * Lists all categorieActu entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categorieActus = $em->getRepository('GarantiaBundle:CategorieActu')->findAll();

        return $this->render('categorieactu/index.html.twig', array(
            'categorieActus' => $categorieActus,
        ));
    }

    /**
     * Creates a new categorieActu entity.
     *
     */
    public function newAction(Request $request)
    {
        $categorieActu = new Categorieactu();
        $form = $this->createForm('GarantiaBundle\Form\CategorieActuType', $categorieActu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorieActu);
            $em->flush();

            return $this->redirectToRoute('categorieactu_show', array('id' => $categorieActu->getId()));
        }

        return $this->render('categorieactu/new.html.twig', array(
            'categorieActu' => $categorieActu,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categorieActu entity.
     *
     */
    public function showAction(CategorieActu $categorieActu)
    {
        $deleteForm = $this->createDeleteForm($categorieActu);

        return $this->render('categorieactu/show.html.twig', array(
            'categorieActu' => $categorieActu,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categorieActu entity.
     *
     */
    public function editAction(Request $request, CategorieActu $categorieActu)
    {
        $deleteForm = $this->createDeleteForm($categorieActu);
        $editForm = $this->createForm('GarantiaBundle\Form\CategorieActuType', $categorieActu);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorieactu_edit', array('id' => $categorieActu->getId()));
        }

        return $this->render('categorieactu/edit.html.twig', array(
            'categorieActu' => $categorieActu,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categorieActu entity.
     *
     */
    public function deleteAction(Request $request, CategorieActu $categorieActu)
    {
        $form = $this->createDeleteForm($categorieActu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorieActu);
            $em->flush();
        }

        return $this->redirectToRoute('categorieactu_index');
    }

    /**
     * Creates a form to delete a categorieActu entity.
     *
     * @param CategorieActu $categorieActu The categorieActu entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CategorieActu $categorieActu)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categorieactu_delete', array('id' => $categorieActu->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
