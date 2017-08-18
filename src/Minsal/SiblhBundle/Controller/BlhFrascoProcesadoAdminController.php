<?php

namespace Minsal\SiblhBundle\Controller;

use Minsal\SiblhBundle\Controller\MinsalSiblhBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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
                    ////////
                    // Mixed Bottles
                    ////////
                    foreach ($object->getFrascoRecolectadoFrascoProcesadoVolumenAgregado() as $collected_bottle_to_mixed_bottle_)
                    {
                        $request_collected_bottle_to_mixed_bottle_ = $this->get('request')->request->get($this->getRequest()->query->get('uniqid'), null);
                        var_dump($request_collected_bottle_to_mixed_bottle_);
                        echo "<br/><br/>";
                        $request_collected_bottle_to_mixed_bottle_ = $this->get('request')->request->get('MIX_BOTTLES_' . $this->getRequest()->query->get('uniqid'), null);
                        var_dump($request_collected_bottle_to_mixed_bottle_);
                        echo "<br/><br/>";
                        // if ($request_collected_bottle_to_mixed_bottle_ !== null)
                        // {
                            // foreach ($request_collected_bottle_to_mixed_bottle_['solicitudEstudioSintomatologiaMama'][0] as $key => $value)
                            // {
                            //     if ($key === 'idSolicitudEstudio' || $key === 'idSolicitudEstudioMamografia') {
                            //         continue;
                            //     }
                            //     $method_name_ = 'set' . ucfirst(str_replace('NOTMAPPED', '', $key));
                            //     if (count($value) > 1) {
                            //         $collected_bottle_to_mixed_bottle_->$method_name_('A');
                            //         continue;
                            //     }
                            //     $collected_bottle_to_mixed_bottle_->$method_name_($value[0]);
                            // }
                        // }
                    }
                    ////////
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

}