<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Comanda;
use AppBundle\Form\ComandaType;

/**
 * Comanda controller.
 *
 * @Route("/comanda")
 */
class ComandaController extends Controller
{
    /**
     * Lists all Comanda entities.
     *
     * @Route("/", name="comanda_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $comandas = $em->getRepository('AppBundle:Comanda')->findAll();

        return $this->render('comanda/index.html.twig', array(
            'comandas' => $comandas,
        ));
    }

    /**
     * Creates a new Comanda entity.
     *
     * @Route("/new", name="comanda_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $comanda = new Comanda();
        $form = $this->createForm('AppBundle\Form\ComandaType', $comanda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comanda);
            $em->flush();

            return $this->redirectToRoute('comanda_show', array('id' => $comanda->getId()));
        }

        return $this->render('comanda/new.html.twig', array(
            'comanda' => $comanda,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Comanda entity.
     *
     * @Route("/{id}", name="comanda_show")
     * @Method("GET")
     */
    public function showAction(Comanda $comanda)
    {
        $deleteForm = $this->createDeleteForm($comanda);

        return $this->render('comanda/show.html.twig', array(
            'comanda' => $comanda,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Comanda entity.
     *
     * @Route("/{id}/edit", name="comanda_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Comanda $comanda)
    {
        $deleteForm = $this->createDeleteForm($comanda);
        $editForm = $this->createForm('AppBundle\Form\ComandaType', $comanda);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comanda);
            $em->flush();

            return $this->redirectToRoute('comanda_edit', array('id' => $comanda->getId()));
        }

        dump($comanda);

        return $this->render('comanda/edit.html.twig', array(
            'comanda' => $comanda,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Comanda entity.
     *
     * @Route("/{id}", name="comanda_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Comanda $comanda)
    {
        $form = $this->createDeleteForm($comanda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($comanda);
            $em->flush();
        }

        return $this->redirectToRoute('comanda_index');
    }

    /**
     * Creates a form to delete a Comanda entity.
     *
     * @param Comanda $comanda The Comanda entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Comanda $comanda)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comanda_delete', array('id' => $comanda->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
