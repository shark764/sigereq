<?php

namespace SanRafael\RequerimientosBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ReqRequerimientoAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('titulo')
            ->add('fechaCreacion')
            ->add('fechaUltimaEdicion')
            ->add('fechaHoraInicio')
            ->add('fechaHoraFin')
            ->add('repetirPor')
            ->add('diaCompleto')
            ->add('color')
            ->add('trabajoRequerido')
            ->add('idEquipoSolicitud')
            ->add('idEmpleadoSolicita')
            ->add('idServicioSolicita')
            ->add('descripcionRequerimiento')
            ->add('solucion')
            ->add('fechaAsignacion')
            ->add('fechaRecibido')
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
            ->add('fechaCreacion')
            ->add('fechaUltimaEdicion')
            ->add('fechaHoraInicio')
            ->add('fechaHoraFin')
            ->add('repetirPor')
            ->add('diaCompleto')
            ->add('color')
            ->add('trabajoRequerido')
            ->add('idEquipoSolicitud')
            ->add('idEmpleadoSolicita')
            ->add('idServicioSolicita')
            ->add('descripcionRequerimiento')
            ->add('solucion')
            ->add('fechaAsignacion')
            ->add('fechaRecibido')
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
            ->add('fechaCreacion')
            ->add('fechaUltimaEdicion')
            ->add('fechaHoraInicio')
            ->add('fechaHoraFin')
            ->add('repetirPor')
            ->add('diaCompleto')
            ->add('color')
            ->add('trabajoRequerido')
            ->add('idEquipoSolicitud')
            ->add('idEmpleadoSolicita')
            ->add('idServicioSolicita')
            ->add('descripcionRequerimiento')
            ->add('solucion')
            ->add('fechaAsignacion')
            ->add('fechaRecibido')
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
            ->add('fechaCreacion')
            ->add('fechaUltimaEdicion')
            ->add('fechaHoraInicio')
            ->add('fechaHoraFin')
            ->add('repetirPor')
            ->add('diaCompleto')
            ->add('color')
            ->add('trabajoRequerido')
            ->add('idEquipoSolicitud')
            ->add('idEmpleadoSolicita')
            ->add('idServicioSolicita')
            ->add('descripcionRequerimiento')
            ->add('solucion')
            ->add('fechaAsignacion')
            ->add('fechaRecibido')
        ;
    }
}
