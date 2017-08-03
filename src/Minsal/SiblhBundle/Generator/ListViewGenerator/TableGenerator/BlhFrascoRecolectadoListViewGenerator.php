<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Minsal\SiblhBundle\Generator\ListViewGenerator\TableGenerator;

use Minsal\SiblhBundle\Generator\ListViewGenerator\TableGenerator\BlhEntityListViewGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\UserInterface;
// use Minsal\SiblhBundle\Entity\EntityInterface;
use Sonata\AdminBundle\Route\RouteGeneratorInterface;

// use Minsal\SiblhBundle\Entity\BlhFrascoRecolectado;

/**
 * BlhFrascoRecolectadoListViewGenerator
 *
 * @author farid
 */
class BlhFrascoRecolectadoListViewGenerator extends BlhEntityListViewGenerator
{
    /**
     * Sets the array.
     *
     * @param array $columns An array instance
     *
     * @api
     */
    public function defineColumns()
    {
        if ($this->type === 'compact')
        {
            array_push($this->columns,
                    array(
                        'field' => 'id',
                        'sortable' => true,
                        'title' => 'ID',
                        'visible' => false,
                        'switchable' => false,
                    ),
                    array(
                        'field' => 'compact',
                        'title' => 'MODO DE VISTA COMPACTO &nbsp; <span class="glyphicon glyphicon-collapse-down"></span>',
                        'switchable' => false,
                        'align' => 'center',
                        'halign' => 'left',
                        // 'formatter' => '__fnc_worklistDetailFormatter',
                        'events' => 'operateEvents',
                    )
            );
        }
        elseif ($this->type === 'detail')
        {
            array_push($this->columns,
                    array(
                        'field' => 'id',
                        'sortable' => true,
                        'title' => 'ID',
                        'visible' => false,
                        'switchable' => false,
                    ),
                    array(
                        'field' => 'detail',
                        'title' => 'MODO DE VISTA DETALLADA &nbsp; <span class="glyphicon glyphicon-collapse-down"></span>',
                        'switchable' => false,
                        'align' => 'center',
                        'halign' => 'left',
                        // 'formatter' => '__fnc_worklistDetailFormatter',
                        'events' => 'operateEvents',
                    )
            );
        }
        else {
            array_push($this->columns,
                    array(
                        'field' => 'id',
                        'sortable' => true,
                        'title' => 'ID',
                        'visible' => false,
                        // 'switchable' => false,
                    ),
                    array(
                        'field' => 'origen',
                        'sortable' => true,
                        'title' => /*'<span class="glyphicon glyphicon-home"></span>'*/ 'Origen',
                        'visible' => false,
                        // 'formatter' => 'simagdOrigenFormatter',
                    ),
                    array(
                        'field' => 'paciente',
                        'sortable' => true,
                        'title' => /*'<span class="glyphicon glyphicon-user"></span>'*/ 'Paciente',
                        'switchable' => false,
                        // 'formatter' => 'simagdPacienteFormatter',
                    ),
                    array(
                        'field' => 'numero_expediente',
                        'sortable' => true,
                        'title' => /*'<span class="glyphicon glyphicon-tag"></span>'*/ 'Reg.',
                        'switchable' => false,
                        'class' => 'bstable-column-highlighted',
                        // 'formatter' => 'simagdPacienteFormatter',
                    ),
                    array(
                        'field' => 'area_atencion',
                        'sortable' => true,
                        'title' => /*'<span class="glyphicon glyphicon-paperclip"></span>'*/ 'Procedencia',
                    ),
                    array(
                        'field' => 'atencion',
                        'sortable' => true,
                        'title' => /*'<span class="glyphicon glyphicon-paperclip"></span>'*/ 'Servicio',
                        'visible' => false,
                    ),
                    array(
                        'field' => 'medico',
                        'sortable' => true,
                        'title' => /*'<span class="glyphicon glyphicon-user"></span>'*/ 'Médico',
                        // 'switchable' => false,
                        'visible' => false,
                    ),
                    array(
                        'field' => 'modalidad',
                        'sortable' => true,
                        'title' => /*'<span class="glyphicon glyphicon-list-alt"></span>'*/ 'Modalidad',
                    ),
                    array(
                        'field' => 'solicitud_detalle',
                        // 'sortable' => true,
                        'title' => '<span class="glyphicon glyphicon-list-alt"></span> Detalle',
                        'visible' => false,
                    ),
                    array(
                        'field' => 'triage',
                        'sortable' => true,
                        'title' => /*'<span class="glyphicon glyphicon-tag"></span>'*/ 'TRIAGE',
                        'class' => 'bstable-column-highlighted',
                        // 'visible' => false,
                        // 'switchable' => false,
                    ),
                    array(
                        'field' => 'tecnologo',
                        'sortable' => true,
                        'title' => 'Téc. / Lic. / Rdlg.',
                        'class' => 'bstable-column-highlighted',
                        'visible' => false,
                        // 'switchable' => false,
                    ),
                    array(
                        'field' => 'estado',
                        'sortable' => true,
                        'title' => 'Estado',
                        'class' => 'bstable-column-status',
                        'align' => 'center',
                        // 'visible' => false,
                        // 'switchable' => false,
                    ),
                    array(
                        'field' => 'fecha_examen',
                        'sortable' => true,
                        'title' => 'Fecha (Exm.)',
                        'visible' => false,
                        // 'formatter' => 'simagdDateTimeFormatter',
                    ),
                    array(
                        'field' => 'correlativo',
                        'sortable' => true,
                        'title' => 'Etiqueta',
                        'visible' => false,
                    ),
                    array(
                        'field' => 'radiologo',
                        'sortable' => true,
                        'title' => 'Radiólogo',
                        'class' => 'bstable-column-radiology',
                    ),
                    array(
                        'field' => 'fecha_lectura',
                        'sortable' => true,
                        'title' => 'Fecha (Lctr.)',
                        'visible' => false,
                        // 'formatter' => 'simagdDateTimeFormatter',
                    ),
                    // array(
                    //     'field' => 'context_menu',
                    //     'sortable' => false,
                    //     'align' => 'center',
                    //     'halign' => 'center',
                    //     'title' => '<span class="glyphicon glyphicon-cog"></span> OP.',
                    //     // 'formatter' => 'operateFormatter',
                    //     // 'events' => 'operateEvents',
                    // ),
                    array(
                        'field' => 'action',
                        'sortable' => false,
                        'align' => 'center',
                        'halign' => 'center',
                        'title' => '<span class="glyphicon glyphicon-cog"></span> OP.',
                        // 'formatter' => 'operateFormatter',
                        'events' => '__RADIOLOGICALRESULT_MENU_ACTIONEVENTS__',
                    )
            );
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
        $this->entityOptions['url']         = $this->routeGenerator->generate('siblh_frasco_recolectado_getForSensoryAnalysis', array('type' => $this->type, 'range' => $this->range));
        // $this->entityOptions['classes']     = 'table table-hover table-condensed table-striped table-darkblue-head';
        // $this->entityOptions['classes']     = 'table table-hover table-condensed table-striped table-black-head';
        $this->entityOptions['classes']     = 'table table-hover table-condensed table-xray-supreme-head'/*table-striped*/;
        $this->entityOptions['showToggle']  = false;
        $this->entityOptions['pageList']    = '[5, 10, 15, 25, 30]';
        $this->entityOptions['pageSize']    = 15;
        // $this->entityOptions['buttonsClass']   = 'primary-v4';
        // $this->entityOptions['pageSize']    = 50;
        // $this->entityOptions['sortName']    = 'undefined';
        if ($this->type === 'detail' || $this->type === 'compact') {
            $this->entityOptions['showToggle']  = false;
            $this->entityOptions['showColumns'] = false;
            $this->entityOptions['pageSize']    = 5;
        }
        // if ($this->type === 'compact') {
        //     $this->entityOptions['pageSize']    = 15;
        // }
        // $this->entityOptions['height']      = '1268';

        // $this->entityOptions['contextMenu']         = '#radiologicalresult-context-menu';
        // $this->entityOptions['contextMenuButton']   = '.radiologicalresult-button';
        // $this->entityOptions['contextMenuTrigger']  = 'both';
        // $this->entityOptions['onContextMenuItem']   = '__FUNCTIONS_CALL__.functions.onContextMenuItem';
        ////////
    }

}