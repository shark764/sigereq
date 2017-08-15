<?php

namespace Minsal\SiblhBundle\Controller;

use Minsal\SiblhBundle\Controller\MinsalSiblhBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class BlhFrascoRecolectadoAdminController extends MinsalSiblhBundleGeneralAdminController
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
        // $REQUEST_l__    = $this->get('request')->query->get('l', null);

        $em = $this->getDoctrine()->getManager();

        //////// --| << prepare >>
        $this->admin->prepareAdminInstance();
        ////////

        // if (!$REQUEST_l__) {
        $REQUEST_l__ = null;
        $REQUEST_t__ = null;
        if ($this->admin->getSessionSystemUserLoggedMilkBank() !== null) {
            $REQUEST_l__ = $this->admin->getSessionSystemUserLoggedMilkBank()->getId();
            $REQUEST_t__ = 'blh';
        }
        elseif ($this->admin->getSessionSystemUserLoggedCollectionCenter() !== null) {
            $REQUEST_l__ = $this->admin->getSessionSystemUserLoggedCollectionCenter()->getId();
            $REQUEST_t__ = 'ctr';
        }
        // }

        if (!$REQUEST_id__) {
            //////// --| search patients
            $results = $em->getRepository('MinsalSiblhBundle:BlhFrascoRecolectado')
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
            ));
        }

        //////// --| search patients
        $result = $em->getRepository('MinsalSiblhBundle:BlhFrascoRecolectado')
            ->searchById(
                // $this->admin->getSessionSystemUserLoggedLocation()->getId(),    // --| locale
                intval($REQUEST_l__),   // --| location
                $REQUEST_t__,   // --| type
                $REQUEST_id__   // --| id
            );
        //////// --|

        return $this->renderJson(array(
            'result'    => 'ok',
            'item'      => $result[0],
        ));
    }

    public function getForSensoryAnalysisAction(Request $request)
    {
        $request->isXmlHttpRequest();

        //////// --| << prepare >>
        $this->admin->prepareAdminInstance();
        ////////

        $em = $this->getDoctrine()->getManager();

        $results = $em->getRepository('MinsalSiblhBundle:BlhFrascoRecolectado')->findAll();

        foreach ($results as $key => $r)
        {
        }

        return $this->renderJson($results);
    }

}