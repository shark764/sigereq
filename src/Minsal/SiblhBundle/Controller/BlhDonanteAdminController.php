<?php

namespace Minsal\SiblhBundle\Controller;

use Minsal\SiblhBundle\Controller\MinsalSiblhBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class BlhDonanteAdminController extends MinsalSiblhBundleGeneralAdminController
{
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
            $results = $em->getRepository('MinsalSiblhBundle:BlhDonante')
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
        $result = $em->getRepository('MinsalSiblhBundle:BlhDonante')
            ->searchById(
                // $this->admin->getSessionSystemUserLoggedLocation()->getId(),    // --| locale
                intval($REQUEST_l__),   // --| location
                $REQUEST_t__,   // --| type
                $REQUEST_id__   // --| id
            );
        //////// --|
        
        $patient_age = null;
        try {
            if ($result[0]['t01_fechaNacimiento'] !== null) {
                $patient_age = $result[0]['t01_fechaNacimiento']->diff(new \DateTime('now'));
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
        $results = $em->getRepository('MinsalSiblhBundle:BlhDonante')
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

    /**
     * buscar establecimientos
     *
     * @param Request $request
     *
     * @return Response
     */
    public function searchLocationAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $REQUEST_q__    = $this->get('request')->query->get('q');
        $REQUEST_id__   = $this->get('request')->query->get('id');
        $REQUEST_t__    = $this->get('request')->query->get('t', 'blh');

        $em = $this->getDoctrine()->getManager();

        // //////// --| << prepare >>
        // $this->admin->prepareAdminInstance();
        // ////////

        $class_t_ = 'MinsalSiblhBundle:BlhBancoDeLeche';
        if ($REQUEST_t__ === 'ctr') {
            $class_t_ = 'MinsalSiblhBundle:BlhCtlCentroRecoleccion';
        }

        if (!$REQUEST_id__) {
            //////// --| search locations
            $results = $em->getRepository($class_t_)
                ->searchLocation(
                    $REQUEST_q__   // --| query
                );
            //////// --|

            return $this->renderJson(array(
                'result'    => 'ok',
                'items'     => $results,
            ));
        }

        //////// --| search locations
        $result = $em->getRepository($class_t_)
            ->searchLocationById(
                $REQUEST_id__   // --| id
            );
        //////// --|

        return $this->renderJson(array(
            'result'    => 'ok',
            'item'      => $result[0],
        ));
    }

}