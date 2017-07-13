<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Minsal\SiblhBundle\Generator\ListViewGenerator\Formatter\ListViewFormatter;

use Minsal\SiblhBundle\Generator\ListViewGenerator\Formatter\ListViewFormatter\BlhListViewFormatter;
// use Symfony\Component\DependencyInjection\ContainerInterface;
// use Doctrine\ORM\EntityManager;
// use FOS\UserBundle\Model\UserInterface;
// // use Minsal\SiblhBundle\Entity\EntityInterface;
// use Sonata\AdminBundle\Route\RouteGeneratorInterface;

// use Minsal\SiblhBundle\Entity\RyxCtlConexionPacsEstablecimiento;

///////////////////////////////////////////////////////
///////////////////////////////////////////////////////
// http://stackoverflow.com/questions/6956258/adding-onclick-event-to-dynamically-added-button
///////////////////////////////////////////////////////
///////////////////////////////////////////////////////

/**
 * RyxCtlConexionPacsEstablecimientoListViewFormatter
 *
 * @author farid
 */
class RyxCtlConexionPacsEstablecimientoListViewFormatter extends BlhListViewFormatter
{
    public function buildCompactList()
    {
        if (is_array($this->data) && count($this->data) > 0) {
            // $this->compactRow = $row;
        }
    }

    public function buildDetailList()
    {
        if (is_array($this->data) && count($this->data) > 0) {
            // $this->detailRow = $row;
        }
    }

    public function buildCompactRow()
    {
        if (is_array($this->row) && count($this->row) > 0) {
            // $this->compactRow = $row;
        }
    }

    public function buildDetailRow()
    {
        if (is_array($this->row) && count($this->row) > 0) {
            // $this->detailRow = $row;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function buildData()
    {
        //////// --| entity manager
        $em = $this->entityManager;
        //////// --|

        ////////
        $results = $em->getRepository($this->class)->datos();
        ////////

        // foreach ($results as $key => $result)
        // {
        //     $results[$key]['fecha'] = $result['fecha']->format('Y-m-d H:i:s A');
        // }

        ////////
        $this->data = $results;
        ////////

        // return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function initialize()
    {
        $this->setEntityOptions();
        $this->defineColumns();
        // $this->buildData();
        // $this->generateData();
    }

    /**
     * {@inheritdoc}
     */
    public function defineEntityOptions()
    {
        ////////
        $this->entityOptions['url']         = $this->routeGenerator->generate('simagd_pacs_generateData', array('type' => $this->type, 'range' => $this->range));
        // $this->entityOptions['classes']     = 'table table-hover table-condensed table-striped table-darkblue-head';
        // $this->entityOptions['classes']     = 'table table-hover table-condensed table-striped table-black-head';
        $this->entityOptions['classes']     = 'table table-hover table-condensed table-striped table-xray-supreme-head';
        $this->entityOptions['buttonsClass']   = 'primary-v4';
        $this->entityOptions['pageSize']    = '50';
        $this->entityOptions['toolbar']     = '#bstable_toolbar_ryx_ctl_conexion_pacs_establecimiento';
        // $this->entityOptions['sortName']    = 'undefined';
        if ($this->type === 'detail' || $this->type === 'compact') {
            $this->entityOptions['showToggle']  = false;
            $this->entityOptions['showColumns'] = false;
            $this->entityOptions['pageSize']    = '5';
        }
        if ($this->type === 'compact') {
            $this->entityOptions['pageSize']    = '15';
        }
        // $this->entityOptions['height']      = '1268';

        // $this->entityOptions['contextMenu']         = '#pacsserverconnections-context-menu';
        // $this->entityOptions['contextMenuButton']   = '.pacsserverconnections-button';
        // $this->entityOptions['contextMenuTrigger']  = 'both';
        // $this->entityOptions['onContextMenuItem']   = '__FUNCTIONS_CALL__.functions.onContextMenuItem';
        ////////
    }

}