<?php

namespace SanRafael\RequerimientosBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;

class ReqRequerimientoAdmin extends Admin
{
    protected $baseRouteName    = 'sigereq_requerimiento';
    protected $baseRoutePattern = 'catalogo/requerimiento';
    
    protected function configureRoutes(RouteCollection $collection)
    {
        // $collection->remove('delete');
        $collection->add('create', 'crear');
        $collection->add('edit', 'editar');
        $collection->add('list', 'listar');
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('titulo')
            ->add('fechaHoraReg')
            ->add('fechaHoraMod')
            ->add('fechaHoraInicio')
            ->add('fechaHoraFin')
            ->add('repetirPor')
            ->add('diaCompleto')
            ->add('color')
            ->add('descripcion')
            ->add('descripcionRequerimiento')
            ->add('solucion')
            ->add('fechaAsignacion')
            ->add('fechaRecibido')
            ->add('fechaDigitacion')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('titulo')
            ->add('fechaHoraReg')
            ->add('fechaHoraMod')
            ->add('fechaHoraInicio')
            ->add('fechaHoraFin')
            ->add('repetirPor')
            ->add('diaCompleto')
            ->add('color')
            ->add('descripcion')
            ->add('descripcionRequerimiento')
            ->add('solucion')
            ->add('fechaAsignacion')
            ->add('fechaRecibido')
            ->add('fechaDigitacion')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('titulo')
            ->add('fechaHoraReg')
            ->add('fechaHoraMod')
            ->add('fechaHoraInicio')
            ->add('fechaHoraFin')
            ->add('repetirPor')
            ->add('diaCompleto')
            ->add('color')
            ->add('descripcion')
            ->add('descripcionRequerimiento')
            ->add('solucion')
            ->add('fechaAsignacion')
            ->add('fechaRecibido')
            ->add('fechaDigitacion')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('titulo')
            ->add('fechaHoraReg')
            ->add('fechaHoraMod')
            ->add('fechaHoraInicio')
            ->add('fechaHoraFin')
            ->add('repetirPor')
            ->add('diaCompleto')
            ->add('color')
            ->add('descripcion')
            ->add('descripcionRequerimiento')
            ->add('solucion')
            ->add('fechaAsignacion')
            ->add('fechaRecibido')
            ->add('fechaDigitacion')
        ;
    }
}