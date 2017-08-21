<?php

namespace Minsal\SiblhBundle\Controller;

use Minsal\SiblhBundle\Controller\MinsalSiblhBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Minsal\SiblhBundle\Entity\BlhFrascoRecolectado;
use Minsal\SiblhBundle\Entity\BlhFrascoRecolectadoFrascoP;

class BlhFrascoProcesadoAdminController extends MinsalSiblhBundleGeneralAdminController
{
    /**
     * return the Response object associated to the create action
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return Response
     */
    public function createAction()
    {
        // the key used to lookup the template
        $templateKey = 'edit';

        if (false === $this->admin->isGranted('CREATE')) {
            return new RedirectResponse($this->generateUrl('siblh_solicitud_accessDenied'));
        }

        //////// --| << prepare >>
        $this->admin->prepareAdminInstance();
        ////////

        $object = $this->admin->getNewInstance();

        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);

        if ($this->getRestMethod() == 'POST') {
            $form->submit($this->get('request'));

            $isFormValid = $form->isValid();

            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {
                
                if (false === $this->admin->isGranted('CREATE', $object)) {
                    return new RedirectResponse($this->generateUrl('siblh_solicitud_accessDenied'));
                }

                try {
                    ////////////////////////////////////////////////////////////////////////////////////////
                    //////// Mixed Bottles
                    ////////////////////////////////////////////////////////////////////////////////////////
                    $REQUEST_COLLECTED_BOTTLE_TO_MIXED_BOTTLE_ = $this->get('request')->request->get('MIX_BOTTLES_' . $this->getRequest()->query->get('uniqid'), null);
                    foreach ($object->getFrascoRecolectadoFrascoProcesadoVolumenAgregado() as $COLLECTED_BOTTLE_TO_MIXED_BOTTLE_)
                    {
                        $frRP = new BlhFrascoRecolectadoFrascoP();
                        $frRP->setIdFrascoRecolectado($COLLECTED_BOTTLE_TO_MIXED_BOTTLE_);
                        $frRP->setIdFrascoProcesado($object);
                        $frRP->setVolumenAgregado($REQUEST_COLLECTED_BOTTLE_TO_MIXED_BOTTLE_['volumenAgregado'][$COLLECTED_BOTTLE_TO_MIXED_BOTTLE_->getId()]);
                        $frRP->setIdUserReg($this->admin->getSessionSystemUserLogged());
                        $object->addFrascoProcesadoFrascoRecolectadoCombinado($frRP);

                        $object->removeFrascoRecolectadoFrascoProcesadoVolumenAgregado($COLLECTED_BOTTLE_TO_MIXED_BOTTLE_);
                    }
                    ////////////////////////////////////////////////////////////////////////////////////////

                    $this->admin->create($object);

                    if ($this->isXmlHttpRequest()) {
                        return $this->renderJson(array(
                            'result'    => 'ok',
                            'objectId'  => $this->admin->getNormalizedIdentifier($object)
                        ));
                    }

                    $this->addFlash('sonata_flash_success', $this->admin->trans('flash_create_success', array('%name%' => $this->admin->toString($object)), 'SonataAdminBundle'));

                    // redirect to edit mode
                    return $this->redirectTo($object);
                } catch (ModelManagerException $e) {
                    $isFormValid = false;
                } catch (Exception $e) {
                    $isFormValid = false;
                }
            }

            // show an error message if the form failed validation
            if (!$isFormValid) {
                if (!$this->isXmlHttpRequest()) {
                    $this->addFlash('sonata_flash_error', $this->admin->trans('flash_create_error', array('%name%' => $this->admin->toString($object)), 'SonataAdminBundle'));
                }
            } elseif ($this->isPreviewRequested()) {
                // pick the preview template if the form was valid and preview was requested
                $templateKey = 'preview';
                $this->admin->getShow();
            }
        }

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        return $this->render($this->admin->getTemplate($templateKey), array(
            'action' => 'create',
            'form'   => $view,
            'object' => $object,
        ));
    }

    /**
     * return the Response object associated to the edit action
     *
     *
     * @param mixed $id
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return Response
     */
    public function editAction($id = null)
    {
        // the key used to lookup the template
        $templateKey = 'edit';

        $id = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);

        if (!$object) {
            return new RedirectResponse($this->generateUrl('siblh_solicitud_objectNotFound'));
        }

        if (false === $this->admin->isGranted('EDIT', $object)) {
            return new RedirectResponse($this->generateUrl('siblh_solicitud_accessDenied'));
        }

        //////// --| << prepare >>
        $this->admin->prepareAdminInstance();
        ////////

        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);

        if ($this->getRestMethod() == 'POST') {
            $form->submit($this->get('request'));

            $isFormValid = $form->isValid();

            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {
                try {
                    ////////////////////////////////////////////////////////////////////////////////////////
                    //////// Mixed Bottles
                    ////////////////////////////////////////////////////////////////////////////////////////
                    $REQUEST_COLLECTED_BOTTLE_TO_MIXED_BOTTLE_ = $this->get('request')->request->get('MIX_BOTTLES_' . $this->getRequest()->query->get('uniqid'), null);
                    // foreach ($object->getFrascoProcesadoFrascoRecolectadoCombinado() as $MIXED_BOTTLE_)
                    // {
                    //     $MIXED_BOTTLE_->setVolumenAgregado($REQUEST_COLLECTED_BOTTLE_TO_MIXED_BOTTLE_['volumenAgregado'][$MIXED_BOTTLE_->getIdFrascoRecolectado()->getId()]);
                    // }
                    foreach ($object->getFrascoRecolectadoFrascoProcesadoVolumenAgregado() as $COLLECTED_BOTTLE_TO_MIXED_BOTTLE_)
                    {
                        foreach ($object->getFrascoProcesadoFrascoRecolectadoCombinado() as $MIXED_BOTTLE_)
                        {
                            if ($COLLECTED_BOTTLE_TO_MIXED_BOTTLE_->getId() === $MIXED_BOTTLE_->getIdFrascoRecolectado()->getId()) {
                                $MIXED_BOTTLE_->setVolumenAgregado($REQUEST_COLLECTED_BOTTLE_TO_MIXED_BOTTLE_['volumenAgregado'][$MIXED_BOTTLE_->getIdFrascoRecolectado()->getId()]);
                                continue 2;
                            }
                        }
                        $frRP = new BlhFrascoRecolectadoFrascoP();
                        $frRP->setIdFrascoRecolectado($COLLECTED_BOTTLE_TO_MIXED_BOTTLE_);
                        $frRP->setIdFrascoProcesado($object);
                        $frRP->setVolumenAgregado($REQUEST_COLLECTED_BOTTLE_TO_MIXED_BOTTLE_['volumenAgregado'][$COLLECTED_BOTTLE_TO_MIXED_BOTTLE_->getId()]);
                        $frRP->setIdUserReg($this->admin->getSessionSystemUserLogged());
                        $object->addFrascoProcesadoFrascoRecolectadoCombinado($frRP);

                        $object->removeFrascoRecolectadoFrascoProcesadoVolumenAgregado($COLLECTED_BOTTLE_TO_MIXED_BOTTLE_);
                    }
                    ////////////////////////////////////////////////////////////////////////////////////////
                    
                    $this->admin->update($object);

                    if ($this->isXmlHttpRequest()) {
                        return $this->renderJson(array(
                            'result'    => 'ok',
                            'objectId'  => $this->admin->getNormalizedIdentifier($object)
                        ));
                    }

                    $this->addFlash('sonata_flash_success', $this->admin->trans('flash_edit_success', array('%name%' => $this->admin->toString($object)), 'SonataAdminBundle'));

                    // redirect to edit mode
                    return $this->redirectTo($object);
                } catch (ModelManagerException $e) {
                    $isFormValid = false;
                } catch (Exception $e) {
                    $isFormValid = false;
                }
            }

            // show an error message if the form failed validation
            if (!$isFormValid) {
                if (!$this->isXmlHttpRequest()) {
                    $this->addFlash('sonata_flash_error', $this->admin->trans('flash_edit_error', array('%name%' => $this->admin->toString($object)), 'SonataAdminBundle'));
                }
            } elseif ($this->isPreviewRequested()) {
                // enable the preview template if the form was valid and preview was requested
                $templateKey = 'preview';
                $this->admin->getShow();
            }
        }

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        return $this->render($this->admin->getTemplate($templateKey), array(
            'action' => 'edit',
            'form'   => $view,
            'object' => $object,
        ));
    }

    /**
     * return the Response object associated to the create action
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return Response
     */
    public function splitBottleAction()
    {
        // the key used to lookup the template
        $templateKey = 'edit';

        if (false === $this->admin->isGranted('CREATE')) {
            return new RedirectResponse($this->generateUrl('siblh_solicitud_accessDenied'));
        }

        //////// --| << prepare >>
        $this->admin->prepareAdminInstance();
        ////////

        if ($this->getRestMethod() == 'POST') {
            if (false === $this->admin->isGranted('CREATE')) {
                return new RedirectResponse($this->generateUrl('siblh_solicitud_accessDenied'));
            }

            try {
                $em = $this->getDoctrine()->getManager();

                ////////////////////////////////////////////////////////////////////////////////////////
                //////// Mixed Bottles
                ////////////////////////////////////////////////////////////////////////////////////////
                $REQUEST_COLLECTED_BOTTLE_TO_MIXED_BOTTLE_ = $this->get('request')->request->get('BATCH_MIX_BOTTLES_' . $this->getRequest()->query->get('uniqid'), null);
                var_dump($REQUEST_COLLECTED_BOTTLE_TO_MIXED_BOTTLE_);



                foreach ($REQUEST_COLLECTED_BOTTLE_TO_MIXED_BOTTLE_['idFrascoRecolectado'] as $k => $r) {
                    echo "<br/>";
                    var_dump($k);
                    echo "<br/>";
                    $object = $this->admin->getNewInstance();
                    // $object->setIdFrascoRecolectado($em->getRepository('MinsalSiblhBundle:BlhFrascoRecolectado')->find($REQUEST_COLLECTED_BOTTLE_TO_MIXED_BOTTLE_['idFrascoRecolectado']));
                    // $this->admin->create($object);
                }




                throw new \RuntimeException(sprintf('The `%s` batch action is not defined', $this->getRequest()->query->get('uniqid')));
                // $frRP->setVolumenAgregado($REQUEST_COLLECTED_BOTTLE_TO_MIXED_BOTTLE_['volumenAgregado'][$COLLECTED_BOTTLE_TO_MIXED_BOTTLE_->getId()]);
                ////////////////////////////////////////////////////////////////////////////////////////

                // $this->addFlash('sonata_flash_success', $this->admin->trans('flash_create_success', array('%name%' => $this->admin->toString($object)), 'SonataAdminBundle'));

            } catch (ModelManagerException $e) {
                // $this->addFlash('sonata_flash_success', $this->admin->trans('flash_create_success', array('%name%' => $this->admin->toString($object)), 'SonataAdminBundle'));
            } catch (Exception $e) {
                // $this->addFlash('sonata_flash_success', $this->admin->trans('flash_create_success', array('%name%' => $this->admin->toString($object)), 'SonataAdminBundle'));
            }
        }

        $params = array();
        if ($this->admin->hasActiveSubClass()) {
            $params['subclass'] = $this->get('request')->get('subclass');
        }
        $url = $this->admin->generateUrl('create', $params);
        
        // redirect to edit mode
        return new RedirectResponse($url);
    }

}