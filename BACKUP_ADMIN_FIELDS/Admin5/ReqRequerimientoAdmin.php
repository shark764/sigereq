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
            ->add('fechaDigitacion')
            /*->add('fechaHoraReg')*/
            /*->add('fechaHoraMod')*/
            ->add('fechaHoraInicio')
            ->add('fechaHoraFin')
            ->add('repetirPor')
            ->add('diaCompleto')
            ->add('color')
            ->add('descripcion')
            ->add('idEquipoSolicitud')
            ->add('idEmpleadoSolicita')
            ->add('idServicioSolicita')
            ->add('comentarios')
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
            ->add('fechaDigitacion')
            /*->add('fechaHoraReg')*/
            /*->add('fechaHoraMod')*/
            ->add('fechaHoraInicio')
            ->add('fechaHoraFin')
            ->add('repetirPor')
            ->add('diaCompleto')
            ->add('color')
            ->add('descripcion')
            ->add('idEquipoSolicitud')
            ->add('idEmpleadoSolicita')
            ->add('idServicioSolicita')
            ->add('comentarios')
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
            /*->add('id')*/
            ->add('titulo', null, array(
                                        'label' => 'Título / Nombre',
                                        'label_attr' => array('class' => 'input-sm'),
                                        'help' => 'Nombre que describe al trabajo solicitado / realizado',
                                        'attr' => array(/*'maxlength' => '10',*/
                                                        'placeholder' => 'Correlativo para transcripción',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-6 col-md-6 col-sm-6',
                                                        'class' => 'form-control input-sm',

                                                        'data-add-input-addon' => 'true',
                                                        'data-add-input-addon-class' => 'primary-v3',
                                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-cog',
                                            
                                                        'data-fv-stringlength' => 'true',
                                                        'data-fv-stringlength-min' => '5',
                                                        'data-fv-stringlength-max' => '255',
                                                        'data-fv-stringlength-message' => '5 caracteres mínimo',

                                                        'data-fv-regexp' => 'true',
                                                        'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
                                                        'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                                        )
            ))
            ->add('fechaDigitacion')
            /*->add('fechaHoraReg')*/
            /*->add('fechaHoraMod')*/
            ->add('fechaHoraInicio')
            ->add('fechaHoraFin')
            ->add('repetirPor')
            ->add('diaCompleto')
            ->add('color')
            ->add('descripcion')
            ->add('idEquipoSolicitud')
            ->add('idEmpleadoSolicita')
            ->add('idServicioSolicita')
            ->add('comentarios')
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
            ->add('fechaDigitacion')
            /*->add('fechaHoraReg')*/
            /*->add('fechaHoraMod')*/
            ->add('fechaHoraInicio')
            ->add('fechaHoraFin')
            ->add('repetirPor')
            ->add('diaCompleto')
            ->add('color')
            ->add('descripcion')
            ->add('idEquipoSolicitud')
            ->add('idEmpleadoSolicita')
            ->add('idServicioSolicita')
            ->add('comentarios')
            ->add('solucion')
            ->add('fechaAsignacion')
            ->add('fechaRecibido')
        ;
    }
}
