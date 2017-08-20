<?php

namespace Minsal\SiblhBundle\Controller;

use Minsal\SiblhBundle\Controller\MinsalSiblhBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Minsal\SiapsBundle\Entity\MntExpediente;
use Minsal\SiblhBundle\Generator\ListViewGenerator\TableGenerator\MntExpedienteListViewGenerator;

class BlhReceptorAdminController extends MinsalSiblhBundleGeneralAdminController
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

        // //////////////////////////////////////////////////////////////////////////////////////////////
        // //////// --| builder entity
        // //////////////////////////////////////////////////////////////////////////////////////////////
        // $ENTITY_LIST_VIEW_GENERATOR_ = new MntExpedienteListViewGenerator(
        //         $this->container,
        //         $this->admin->getRouteGenerator(),
        //         $this->admin->getClass()
        // );
        // //////// --|
        // $options = $ENTITY_LIST_VIEW_GENERATOR_->getTable();
        // //////////////////////////////////////////////////////////////////////////////////////////////

        return $this->render($this->admin->getTemplate($templateKey), array(
            'action' => 'create',
            'form'   => $view,
            'object' => $object,
            // 'DEFAULT_TABLE_OPTIONS' => $options,
        ));
    }

    /**
     * buscar expedientes
     *
     * @param Request $request
     *
     * @return Response
     */
    public function searchAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $REQUEST_q__    = $this->get('request')->query->get('q', null);
        $REQUEST_id__   = $this->get('request')->query->get('id', null);
        $REQUEST_t__    = $this->get('request')->query->get('t', 'blh');
        $REQUEST_l__    = $this->get('request')->query->get('l', null);

        $em = $this->getDoctrine()->getManager();

        //////// --| << prepare >>
        $this->admin->prepareAdminInstance();
        ////////

        if (!$REQUEST_l__) {
            if ($this->admin->getSessionSystemUserLoggedMilkBank() !== null) {
                $REQUEST_l__ = $this->admin->getSessionSystemUserLoggedMilkBank()->getId();
                $REQUEST_t__ = 'blh';
            }
            elseif ($this->admin->getSessionSystemUserLoggedCollectionCenter() !== null) {
                $REQUEST_l__ = $this->admin->getSessionSystemUserLoggedCollectionCenter()->getId();
                $REQUEST_t__ = 'ctr';
            }
        }

        if (!$REQUEST_id__) {
            //////// --| search patients
            $results = $em->getRepository('MinsalSiblhBundle:BlhReceptor')
                ->search(
                    // $this->admin->getSessionSystemUserLoggedLocation()->getId(),    // --| locale
                    intval($REQUEST_l__),   // --| location
                    $REQUEST_t__,   // --| type
                    $REQUEST_q__    // query
                );
            //////// --|

            return $this->renderJson(array(
                'result'    => 'ok',
                'items'     => $results,
                't'         => $REQUEST_t__
            ));
        }

        //////// --| search patients
        $result = $em->getRepository('MinsalSiblhBundle:BlhReceptor')
            ->searchById(
                // $this->admin->getSessionSystemUserLoggedLocation()->getId(),    // --| locale
                intval($REQUEST_l__),   // --| location
                $REQUEST_t__,   // --| type
                $REQUEST_id__   // --| id
            );
        //////// --|
        
        $patient_age = null;
        try {
            if ($result[0]['t03_fechaNacimiento'] !== null) {
                $patient_age = $result[0]['t03_fechaNacimiento']->diff(new \DateTime('now'));
            }
        } catch (Exception $e) {
        }

        return $this->renderJson(array(
            'result'    => 'ok',
            'item'      => $result[0],
            'PATIENT_AGE'   => $patient_age,
            't'         => $REQUEST_t__
        ));
    }

    /**
     * buscar expedientes
     *
     * @param Request $request
     *
     * @return Response
     */
    public function searchByAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $REQUEST_all__  = $this->get('request')->query->all();
        $REQUEST_t__    = $this->get('request')->query->get('t', 0);
        $REQUEST_l__    = $this->get('request')->query->get('l', null);

        $em = $this->getDoctrine()->getManager();

        //////// --| << prepare >>
        $this->admin->prepareAdminInstance();
        ////////

        if (!$REQUEST_l__) {
            $REQUEST_l__ = $this->admin->getSessionSystemUserLoggedLocation()->getId();
        }
        $REQUEST_t__ = intval(intval($REQUEST_l__) !== $this->admin->getSessionSystemUserLoggedLocation()->getId());

        unset($REQUEST_all__['_search_patient']);
        unset($REQUEST_all__['_search_type']);
        unset($REQUEST_all__['t']);

        foreach ($REQUEST_all__ as $k => $v)
        {
            if ($v === "" || $v === null) {
                unset($REQUEST_all__[$k]);
            }
        }

        //////////////////////////////////////////////////////////////////////////////////
        //////// --| search patients
        $results = $em->getRepository('MinsalSiblhBundle:BlhReceptor')
            ->searchBy(
                $this->admin->getSessionSystemUserLoggedLocation()->getId(),    // --| locale
                intval($REQUEST_l__),   // --| location
                $REQUEST_t__,   // --| type
                $REQUEST_all__  // --| parameters
            );
        //////// --|
        //////////////////////////////////////////////////////////////////////////////////

        //////////////////////////////////////////////////////////////////////////////////
        //////// results are more than one
        //////////////////////////////////////////////////////////////////////////////////
        if (count($results) > 1) {
            $ENTITY_LIST_VIEW_GENERATOR_ = null;
            $table_definition_ = null;

            if (!$REQUEST_t__) {
                //////// --| builder table
                $ENTITY_LIST_VIEW_GENERATOR_ = new MntExpedienteListViewGenerator(
                        $this->container,
                        $this->admin->getRouteGenerator(),
                        $this->admin->getClass()
                );
                //////// --|
                $ENTITY_LIST_VIEW_GENERATOR_->setData($results);
                $table_definition_ = $ENTITY_LIST_VIEW_GENERATOR_->getTable();
            }
            else {
                //////// --| builder table
                $ENTITY_LIST_VIEW_GENERATOR_ = new MntExpedienteReferidoListViewGenerator(
                        $this->container,
                        $this->admin->getRouteGenerator(),
                        $this->admin->getClass()
                );
                //////// --|
                $ENTITY_LIST_VIEW_GENERATOR_->setData($results);
                $table_definition_ = $ENTITY_LIST_VIEW_GENERATOR_->getTable();
            }

            return $this->renderJson(array(
                'result'    => 'ok',
                'options'   => $table_definition_,
                // 'items'     => $results,
                't'         => $REQUEST_t__,
                'all'       => $REQUEST_all__,
                '_all'      => $this->get('request')->query->all(),
            ));
        }
        //////////////////////////////////////////////////////////////////////////////////
        //////// result is just one
        //////////////////////////////////////////////////////////////////////////////////
        else if (count($results) === 1) {
            return $this->renderJson(array(
                'result'    => 'ok',
                'item'      => $results[0],
                't'         => $REQUEST_t__,
            ));
        }
        //////////////////////////////////////////////////////////////////////////////////
        //////// no results
        //////////////////////////////////////////////////////////////////////////////////
        return $this->renderJson(array('result' => 'error'));
    }

}