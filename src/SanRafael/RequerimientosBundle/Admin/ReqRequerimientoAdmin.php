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

class ReqRequerimientoAdmin extends SanRafaelRequerimientosAdmin
{
    protected $baseRouteName    = 'sigereq_requerimiento';
    protected $baseRoutePattern = 'catalogo/requerimiento';

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
            ->add('comentarios')
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
            ->add('comentarios')
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
        $MAIN_BOX_LABEL = 'Nuevo registro';
        $admin_subject  = $this->getSubject();
        if ($this->id($admin_subject)) {
            $MAIN_BOX_LABEL = 'Editar registro';
        }

        $formMapper
            ->with($MAIN_BOX_LABEL, array('class' => 'col-lg-12 col-md-12 col-sm-12', 'description' => ''))
                // ->add('id')
                ->add('titulo', null, array(
                                        'label' => 'Título',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'attr' => array(/*'maxlength' => '100',*/
                                                        'placeholder' => 'Título del requerimiento',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-9 col-md-9 col-sm-9',
                                                        'class' => 'input-sm',

                                                        'data-add-input-addon' => 'true',
                                                        'data-add-input-addon-class' => 'primary-v4',
                                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-edit',

                                                        'data-fv-stringlength' => 'true',
                                                        'data-fv-stringlength-min' => '5',
                                                        'data-fv-stringlength-max' => '100',
                                                        'data-fv-stringlength-message' => '5 caracteres mínimo',

                                                        'data-fv-regexp' => 'true',
                                                        'data-fv-regexp-regexp' => '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$',
                                                        'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                                        )
                ))
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
                ->add('repetirPor', null, array(
                                        'label' => 'Repetir durante',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'attr' => array('min' => '0',
                                                        'max' => '32767',
                                                        'placeholder' => 'N° de días',
                                                        'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',
                                                        'class' => 'form-control input-sm',

                                                        'data-add-input-addon' => 'true',
                                                        'data-add-input-addon-class' => 'primary-v4',
                                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-repeat',

                                                        'data-fv-integer' => 'true',
                                                        'data-fv-integer-message' => 'El valor no es un entero',

                                                        'data-fv-greaterthan-inclusive' => 'true',
                                                        'data-fv-greaterthan-value' => '0',
                                                        'data-fv-greaterthan-message' => 'Debe ser mayor o igual a 0',

                                                        'data-fv-lessthan-inclusive' => 'true',
                                                        'data-fv-lessthan-value' => '32767',
                                                        'data-fv-lessthan-message' => 'Debe ser menor o igual a 32767',
                                        )
                ))
                ->add('diaCompleto', null, array(
                                        'label' => 'Día completo',
                                        'label_attr' => array('class' => 'label_form_sm label_check col-lg-4 col-md-4 col-sm-4'),
                                        'required' => false,
                                        'attr' => array('data-input-transform' => 'icheck',
                                                        'class' => 'form-control input-sm',
                                        )
                ))
                ->add('color', null, array(
                                        'label' => 'Título',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'attr' => array(/*'maxlength' => '100',*/
                                                        'placeholder' => 'Título del requerimiento',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',
                                                        'class' => 'form-control input-sm',

                                                        'data-add-input-addon' => 'true',
                                                        'data-add-input-addon-class' => 'primary-v4',
                                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-tint',

                                                        'data-fv-stringlength' => 'true',
                                                        'data-fv-stringlength-min' => '5',
                                                        'data-fv-stringlength-max' => '100',
                                                        'data-fv-stringlength-message' => '5 caracteres mínimo',

                                                        'data-fv-regexp' => 'true',
                                                        'data-fv-regexp-regexp' => '^[a-zA-Z0-9,:\.#()_-]+$',
                                                        'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
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
                ->add('fechaAsignacion', 'datetime', array(
                                        'label' => 'Fecha de asignación',
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
                ->add('fechaRecibido', 'datetime', array(
                                        'label' => 'Fecha de recibido',
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
                ->add('fechaDigitacion', 'datetime', array(
                                        'label' => 'Fecha de digitación',
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
                // ->add('requerimientoDetalles')
                ->add('requerimientoDetalles', 'sonata_type_collection', array(
                                        'label' =>'Detalle del requerimiento / Actividad',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'help' => 'Agregue los trabajos requeridos / Actividades realizadas'
                                        // 'cascade_validation' => true,),
                ) /*array('edit' => 'inline', 'inline' => 'table')*/ )
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
            ->add('titulo')
            ->add('fechaHoraReg')
            ->add('fechaHoraMod')
            ->add('fechaHoraInicio')
            ->add('fechaHoraFin')
            ->add('repetirPor')
            ->add('diaCompleto')
            ->add('color')
            ->add('descripcion')
            ->add('comentarios')
            ->add('solucion')
            ->add('fechaAsignacion')
            ->add('fechaRecibido')
            ->add('fechaDigitacion')
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
        
        /*
         * default values
         */
        /*$instance->setIdEstadoEquipo($this->getModelManager()->findOneBy('SanRafaelRequerimientosBundle:ReqCtlEstadoEquipo', array('codigo' => 'FNC')));
        $instance->setIdTipoEquipo($this->getModelManager()->findOneBy('SanRafaelRequerimientosBundle:ReqCtlTipoEquipo', array('codigo' => 'DKT')));
        $instance->setIdModeloEquipo($this->getModelManager()->findOneBy('SanRafaelRequerimientosBundle:ReqCtlModeloEquipo', array('codigo' => 'dlloptx9020')));*/
        
        return $instance;
    }

}