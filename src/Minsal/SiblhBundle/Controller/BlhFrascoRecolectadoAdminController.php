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