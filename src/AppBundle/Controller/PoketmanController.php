<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Poketman;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Poketman controller.
 *
 * @Route("poketman")
 */
class PoketmanController extends Controller
{
    /**
     * Lists all poketman entities.
     *
     * @Route("/", name="poketman_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $poketmen = $em->getRepository('AppBundle:Poketman')->findAll();

        return $this->render('poketman/index.html.twig', array(
            'poketmen' => $poketmen,
        ));
    }

    /**
     * Creates a new poketman entity.
     *
     * @Route("/new", name="poketman_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $poketman = new Poketman();
        $form = $this->createForm('AppBundle\Form\PoketmanType', $poketman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($poketman);
            $em->flush();

            return $this->redirectToRoute('poketman_show', array('id' => $poketman->getId()));
        }
        
        return $this->render('poketman/new.html.twig', array(
            'poketman' => $poketman,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a poketman entity.
     *
     * @Route("/{id}", name="poketman_show")
     * @Method("GET")
     */
    public function showAction(Poketman $poketman)
    {
        $deleteForm = $this->createDeleteForm($poketman);

        return $this->render('poketman/show.html.twig', array(
            'poketman' => $poketman,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing poketman entity.
     *
     * @Route("/{id}/edit", name="poketman_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Poketman $poketman)
    {
        $deleteForm = $this->createDeleteForm($poketman);
        $editForm = $this->createForm('AppBundle\Form\PoketmanType', $poketman);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('poketman_edit', array('id' => $poketman->getId()));
        }

        return $this->render('poketman/edit.html.twig', array(
            'poketman' => $poketman,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a poketman entity.
     *
     * @Route("/{id}", name="poketman_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Poketman $poketman)
    {
        $form = $this->createDeleteForm($poketman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($poketman);
            $em->flush();
        }

        return $this->redirectToRoute('poketman_index');
    }

    /**
     * Creates a form to delete a poketman entity.
     *
     * @param Poketman $poketman The poketman entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Poketman $poketman)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('poketman_delete', array('id' => $poketman->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
