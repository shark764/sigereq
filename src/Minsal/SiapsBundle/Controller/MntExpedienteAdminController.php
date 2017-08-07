<?php

namespace Minsal\SiapsBundle\Controller;

use Minsal\SiblhBundle\Controller\MinsalSiblhBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class MntExpedienteAdminController extends MinsalSiblhBundleGeneralAdminController
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
        $REQUEST_id__	= $this->get('request')->query->get('id', null);

        $em = $this->getDoctrine()->getManager();

        //////// --| << prepare >>
        $this->admin->prepareAdminInstance();
        ////////

        if (!$REQUEST_id__) {
            //////// --| search patients
            $results = $em->getRepository('MinsalSiapsBundle:MntExpediente')
                ->search(
                    $this->admin->getSessionSystemUserLoggedLocation()->getId(),    // --| locale
                    $REQUEST_q__   // --| query
                );
            //////// --|

            return $this->renderJson(array(
                'result'    => 'ok',
                'items'     => $results,
            ));
        }

        //////// --| search patients
        $result = $em->getRepository('MinsalSiapsBundle:MntExpediente')
            ->searchById(
                $this->admin->getSessionSystemUserLoggedLocation()->getId(),    // --| locale
                $REQUEST_id__   // --| id
            );
        //////// --|
        
        $patient_age = null;
        try {
            if ($result[0]['t02_fechaNacimiento'] !== null) {
                $patient_age = $result[0]['t02_fechaNacimiento']->diff(new \DateTime('now'));
            }
        } catch (Exception $e) {
        }

        return $this->renderJson(array(
            'result'    => 'ok',
            'item'      => $result[0],
            'PATIENT_AGE'   => $patient_age,
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
    }

}