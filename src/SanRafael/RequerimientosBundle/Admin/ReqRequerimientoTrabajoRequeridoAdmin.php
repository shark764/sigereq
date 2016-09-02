<?php

namespace SanRafael\RequerimientosBundle\Admin;

//use Sonata\AdminBundle\Admin\Admin;
use SanRafael\RequerimientosBundle\Admin\SanRafaelRequerimientosAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
//use Doctrine\ORM\EntityRepository;
//use Sonata\AdminBundle\Validator\ErrorElement;
//use Sonata\AdminBundle\Route\RouteCollection;

class ReqRequerimientoTrabajoRequeridoAdmin extends SanRafaelRequerimientosAdmin
{
    protected $baseRouteName    = 'sigereq_requerimiento_trabajo_requerido';
    protected $baseRoutePattern = 'catalogo/requerimiento-trabajo-requerido';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('fechaHoraReg')
            ->add('fechaHoraMod')
            ->add('fechaHoraInicio')
            ->add('fechaHoraFin')
            ->add('descripcion')
            ->add('solucion')
            ->add('comentarios')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('fechaHoraReg')
            ->add('fechaHoraMod')
            ->add('fechaHoraInicio')
            ->add('fechaHoraFin')
            ->add('descripcion')
            ->add('solucion')
            ->add('comentarios')
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
        $MAIN_BOX_LABEL = 'Nuevo registro';
        $admin_subject  = $this->getSubject();
        if ($this->id($admin_subject)) {
            $MAIN_BOX_LABEL = 'Editar registro';
        }

        $formMapper
            ->with($MAIN_BOX_LABEL, array('class' => 'col-lg-12 col-md-12 col-sm-12', 'description' => ''))
                // ->add('id')
                ->add('idRequerimiento', 'sonata_type_model_hidden')
                ->add('fechaHoraInicio', 'datetime', array(
                                        'label' => 'Fecha de inicio',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => false,
                                        'widget' => 'single_text',
                                        'format' => 'yyyy-MM-dd HH:mm',
                                        'attr' => array(/*'readonly' => 'readonly',*/
                                                        'placeholder' => 'YYYY-MM-DD HH:mm',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',
                                                        'class' => 'form-control input-sm',
                                                        'data-input-transform' => 'datetimepicker',
                                                        'data-datetimepicker-type' => 'date',

                                                        'data-add-input-btn' => 'true',
                                                        'data-add-input-btn-class' => 'display-datetimepicker',
                                                        'data-add-input-btn-btn-class' => 'btn-sm btn-primary-v4 display-datetimepicker',
                                                        'data-add-input-btn-addon' => 'glyphicon glyphicon-calendar',

                                                        'data-fv-date' => 'true',
                                                        'data-fv-date-format' => 'YYYY-MM-DD',
                                                        'data-fv-date-message' => 'Fecha no válida',
                                        )
                ))
                ->add('fechaHoraFin', 'datetime', array(
                                        'label' => 'Fecha de finalización',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => false,
                                        'widget' => 'single_text',
                                        'format' => 'yyyy-MM-dd HH:mm',
                                        'attr' => array(/*'readonly' => 'readonly',*/
                                                        'placeholder' => 'YYYY-MM-DD HH:mm',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',
                                                        'class' => 'form-control input-sm',
                                                        'data-input-transform' => 'datetimepicker',
                                                        'data-datetimepicker-type' => 'date',

                                                        'data-add-input-btn' => 'true',
                                                        'data-add-input-btn-class' => 'display-datetimepicker',
                                                        'data-add-input-btn-btn-class' => 'btn-sm btn-primary-v4 display-datetimepicker',
                                                        'data-add-input-btn-addon' => 'glyphicon glyphicon-calendar',

                                                        'data-fv-date' => 'true',
                                                        'data-fv-date-format' => 'YYYY-MM-DD',
                                                        'data-fv-date-message' => 'Fecha no válida',
                                        )
                ))
                ->add('idTipoTrabajo', null, array(
                                        'label' => 'Tipo de trabajo',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => true,
                                        'empty_value' => '',
                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-6 col-md-6 col-sm-6',
                                                        'class' => 'form-control input-sm',
                                                        'data-input-transform' => 'select2',
                                                        'data-apply-formatter' => 'user',
                                                        'data-apply-formatter-mode' => 'enabled',

                                                        'data-fv-notempty' => 'true',
                                                        'data-fv-notempty-message' => 'Seleccione un elemento',
                                        )
                ))
                ->add('idAreaTrabajo', null, array(
                                        'label' => 'Área de trabajo',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => true,
                                        'empty_value' => '',
                                        'group_by' => 'idAreaPadre',
                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-6 col-md-6 col-sm-6',
                                                        'class' => 'form-control input-sm',
                                                        'data-input-transform' => 'select2',
                                                        'data-apply-formatter' => 'user',
                                                        'data-apply-formatter-mode' => 'enabled',

                                                        'data-fv-notempty' => 'true',
                                                        'data-fv-notempty-message' => 'Seleccione un elemento',
                                        )
                ))
                ->add('idEquipoSolicitud', null, array(
                                        'label' => 'Equipo',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => true,
                                        'empty_value' => '',
                                        'group_by' => 'idModeloEquipo',
                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-6 col-md-6 col-sm-6',
                                                        'class' => 'form-control input-sm',
                                                        'data-input-transform' => 'select2',
                                                        'data-apply-formatter' => 'user',
                                                        'data-apply-formatter-mode' => 'enabled',

                                                        'data-fv-notempty' => 'true',
                                                        'data-fv-notempty-message' => 'Seleccione un elemento',
                                        )
                ))
                ->add('idEmpleadoRegistra', null, array(
                                        'label' => 'Registra',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => false,
                                        'empty_value' => '',
                                        'group_by' => 'idCargoEmpleado',
                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-6 col-md-6 col-sm-6',
                                                        'class' => 'form-control input-sm',
                                                        'data-input-transform' => 'select2',
                                                        'data-apply-formatter' => 'user',
                                                        'data-apply-formatter-mode' => 'enabled',

                                                        'data-fv-notempty' => 'true',
                                                        'data-fv-notempty-message' => 'Seleccione un elemento',
                                        )
                ))
                ->add('idAsignaRequerimiento', null, array(
                                        'label' => 'Asigna',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => false,
                                        'empty_value' => '',
                                        'group_by' => 'idCargoEmpleado',
                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-6 col-md-6 col-sm-6',
                                                        'class' => 'form-control input-sm',
                                                        'data-input-transform' => 'select2',
                                                        'data-apply-formatter' => 'user',
                                                        'data-apply-formatter-mode' => 'enabled',

                                                        'data-fv-notempty' => 'true',
                                                        'data-fv-notempty-message' => 'Seleccione un elemento',
                                        )
                ))
                ->add('idEmpleadoAsignado', null, array(
                                        'label' => 'Asignado a',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => true,
                                        'empty_value' => '',
                                        'group_by' => 'idCargoEmpleado',
                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-9 col-md-9 col-sm-9',
                                                        'class' => 'form-control input-sm',
                                                        'data-input-transform' => 'select2',
                                                        'data-apply-formatter' => 'user',
                                                        'data-apply-formatter-mode' => 'enabled',

                                                        'data-fv-notempty' => 'true',
                                                        'data-fv-notempty-message' => 'Seleccione un elemento',
                                        )
                ))
                ->add('idEstadoRequerimiento', null, array(
                                        'label' => 'Estado',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => true,
                                        'empty_value' => '',
                                        'group_by' => 'idEstadoPadre',
                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-9 col-md-9 col-sm-9',
                                                        'class' => 'form-control input-sm',
                                                        'data-input-transform' => 'select2',
                                                        'data-apply-formatter' => 'user',
                                                        'data-apply-formatter-mode' => 'enabled',

                                                        'data-fv-notempty' => 'true',
                                                        'data-fv-notempty-message' => 'Seleccione un elemento',
                                        )
                ))
                ->add('idTrabajoRequerido', null, array(
                                        'label' => 'Trabajo requerido',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => true,
                                        'empty_value' => '',
                                        'group_by' => 'idAreaTrabajo',
                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-9 col-md-9 col-sm-9',
                                                        'class' => 'form-control input-sm',
                                                        'data-input-transform' => 'select2',
                                                        'data-apply-formatter' => 'user',
                                                        'data-apply-formatter-mode' => 'enabled',

                                                        'data-fv-notempty' => 'true',
                                                        'data-fv-notempty-message' => 'Seleccione un elemento',
                                        )
                ))
                ->add('descripcion', null, array(
                                        'label' => 'Requerimiento / Actividad',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => false,
                                        'attr' => array('rows' => '3',
                                                        'style' => 'resize:none',
                                                        /*'maxlength' => '255',*/
                                                        'placeholder' => 'Descripción del requerimiento / Actividad',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-9 col-md-9 col-sm-9',
                                                        'class' => 'form-control input-sm',

                                                        'data-fv-stringlength' => 'true',
                                                        'data-fv-stringlength-min' => '5',
                                                        'data-fv-stringlength-max' => '255',
                                                        'data-fv-stringlength-message' => '5 caracteres mínimo',

                                                        'data-fv-regexp' => 'true',
                                                        'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
                                                        'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                                        )
                ))
                ->add('idSolucionaRequerimiento', null, array(
                                        'label' => 'Resuelto por',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => true,
                                        'empty_value' => '',
                                        'group_by' => 'idCargoEmpleado',
                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-9 col-md-9 col-sm-9',
                                                        'class' => 'form-control input-sm',
                                                        'data-input-transform' => 'select2',
                                                        'data-apply-formatter' => 'user',
                                                        'data-apply-formatter-mode' => 'enabled',

                                                        'data-fv-notempty' => 'true',
                                                        'data-fv-notempty-message' => 'Seleccione un elemento',
                                        )
                ))
                ->add('idSolucionRequerimiento', null, array(
                                        'label' => 'Solución',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => true,
                                        'empty_value' => '',
                                        'group_by' => 'idSolucionPadre',
                                        'attr' => array('style' => 'min-width: 100%; max-width: 100%;',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-9 col-md-9 col-sm-9',
                                                        'class' => 'form-control input-sm',
                                                        'data-input-transform' => 'select2',
                                                        'data-apply-formatter' => 'user',
                                                        'data-apply-formatter-mode' => 'enabled',

                                                        'data-fv-notempty' => 'true',
                                                        'data-fv-notempty-message' => 'Seleccione un elemento',
                                        )
                ))
                ->add('solucion', null, array(
                                        'label' => 'Solución / Trabajo realizado',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => false,
                                        'attr' => array('rows' => '3',
                                                        'style' => 'resize:none',
                                                        /*'maxlength' => '255',*/
                                                        'placeholder' => 'Descripción del requerimiento / Actividad',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-9 col-md-9 col-sm-9',
                                                        'class' => 'form-control input-sm',

                                                        'data-fv-stringlength' => 'true',
                                                        'data-fv-stringlength-min' => '5',
                                                        'data-fv-stringlength-max' => '255',
                                                        'data-fv-stringlength-message' => '5 caracteres mínimo',

                                                        'data-fv-regexp' => 'true',
                                                        'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
                                                        'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                                        )
                ))
                ->add('comentarios', /*TextareaType::class*/ 'textarea', array(
                                        'label' => 'Comentarios / Observaciones / Incidencias',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => false,
                                        'attr' => array('rows' => '2',
                                                        'style' => 'resize:none',
                                                        /*'maxlength' => '255',*/
                                                        'placeholder' => 'Descripción del requerimiento / Actividad',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-9 col-md-9 col-sm-9',
                                                        'class' => 'form-control input-sm',

                                                        'data-fv-stringlength' => 'true',
                                                        'data-fv-stringlength-min' => '5',
                                                        'data-fv-stringlength-max' => '255',
                                                        'data-fv-stringlength-message' => '5 caracteres mínimo',

                                                        'data-fv-regexp' => 'true',
                                                        'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
                                                        'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                                        )
                ))
            ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('fechaHoraReg')
            ->add('fechaHoraMod')
            ->add('fechaHoraInicio')
            ->add('fechaHoraFin')
            ->add('descripcion')
            ->add('solucion')
            ->add('comentarios')
        ;
    }

    public function prePersist($entity)
    {
        parent::prePersist($entity);
    }
    
    public function preUpdate($entity)
    {
        parent::preUpdate($entity);
    }
    
    public function getNewInstance()
    {
        $instance   = parent::getNewInstance();

        $securityContext    = $this->getConfigurationPool()->getContainer()->get('security.context');
        $sessionUser    = $securityContext->getToken()->getUser();
        $sessionUser_employee   = $sessionUser->getIdEmpleado();
        
        /*
         * default values
         */
        $instance->setIdAreaTrabajo($this->getModelManager()->findOneBy('SanRafaelRequerimientosBundle:ReqCtlAreaTrabajo', array('codigo' => 'DSI')));
        $instance->setIdTipoTrabajo($this->getModelManager()->findOneBy('SanRafaelRequerimientosBundle:ReqCtlTipoTrabajo', array('codigo' => 'C')));
        $instance->setIdTrabajoRequerido($this->getModelManager()->findOneBy('SanRafaelRequerimientosBundle:ReqCtlTrabajoRequerido', array('codigo' => '000000')));

        $instance->setIdEmpleadoRegistra($sessionUser_employee);
        $instance->setIdEmpleadoAsignado($sessionUser_employee);
        $instance->setIdAsignaRequerimiento($sessionUser_employee);
        $instance->setIdSolucionaRequerimiento($sessionUser_employee);

        $instance->setIdEquipoSolicitud($this->getModelManager()->findOneBy('SanRafaelRequerimientosBundle:ReqCtlEquipo', array('codigo' => '000000')));
        $instance->setIdEstadoRequerimiento($this->getModelManager()->findOneBy('SanRafaelRequerimientosBundle:ReqCtlEstadoRequerimiento', array('codigo' => 'RRC')));
        $instance->setIdSolucionRequerimiento($this->getModelManager()->findOneBy('SanRafaelRequerimientosBundle:ReqCtlSolucionRequerimiento', array('codigo' => 'IEI')));

        /*
         * REQUEST VALUES
         */
        if ($this->hasRequest())
        {
            $__PARAM_REQUEST__REQ = $this->getRequest()->get('__REQ', null);
            if ($__PARAM_REQUEST__REQ !== null)
            {
                $em = $this->getModelManager()->getEntityManager('SanRafael\RequerimientosBundle\Entity\ReqRequerimiento');
                $instance->setIdRequerimiento($em->getReference('SanRafael\RequerimientosBundle\Entity\ReqRequerimiento', $__PARAM_REQUEST__REQ));
            }
        }
        
        return $instance;
    }

}