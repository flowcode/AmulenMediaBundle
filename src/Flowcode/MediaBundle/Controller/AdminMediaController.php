<?php

namespace Flowcode\MediaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Amulen\MediaBundle\Entity\Media;
use Flowcode\MediaBundle\Form\MediaType;

/**
 * Media controller.
 *
 * @Route("/admin/media")
 */
class AdminMediaController extends Controller {

    /**
     * Lists all Media entities.
     *
     * @Route("/dashboard", name="admin_media_dashboard")
     * @Method("GET")
     * @Template()
     */
    public function dashboardAction() {

        return array(
            'entities' => "hi",
        );
    }

    /**
     * Lists all Media entities.
     *
     * @Route("/browser", name="admin_media_browser")
     * @Method("GET")
     * @Template()
     */
    public function browserAction() {

        return array();
    }

    /**
     * Lists all Media entities.
     *
     * @Route("/", name="admin_media")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AmulenMediaBundle:Media')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Media entity.
     *
     * @Route("/{type}", name="admin_media_create")
     * @Method("POST")
     * @Template("AmulenMediaBundle:Media:new.html.twig")
     */
    public function createAction(Request $request, $type) {
        $entity = new Media();
        $entity->setMediaType($type);
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_media_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Media entity.
     *
     * @param Media $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Media $entity) {

        $types = $this->container->getParameter('flowcode_media.media_types');
        $class = $types[$entity->getMediaType()]["class_type"];

        $form = $this->createForm(new $class(), $entity, array(
            'action' => $this->generateUrl('admin_media_create', array("type" => $entity->getMediaType())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Media entity.
     *
     * @Route("/select-media-type", name="admin_media_select_media")
     * @Method("GET")
     * @Template()
     */
    public function selectMediaTypeAction() {

        return array();
    }

    /**
     * Displays a form to create a new Media entity.
     *
     * @Route("/new/{type}", name="admin_media_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($type) {
        $entity = new Media();
        $entity->setMediaType($type);
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Media entity.
     *
     * @Route("/{id}", name="admin_media_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AmulenMediaBundle:Media')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Media entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Media entity.
     *
     * @Route("/{id}/edit", name="admin_media_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AmulenMediaBundle:Media')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Media entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a Media entity.
     *
     * @param Media $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Media $entity) {
        $form = $this->createForm(new MediaType(), $entity, array(
            'action' => $this->generateUrl('admin_media_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Media entity.
     *
     * @Route("/{id}", name="admin_media_update")
     * @Method("PUT")
     * @Template("AmulenMediaBundle:Media:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AmulenMediaBundle:Media')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Media entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_media_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Media entity.
     *
     * @Route("/{id}", name="admin_media_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AmulenMediaBundle:Media')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Media entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_media'));
    }

    /**
     * Creates a form to delete a Media entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_media_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
