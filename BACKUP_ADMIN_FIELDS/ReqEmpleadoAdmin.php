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

class ReqEmpleadoAdmin extends SanRafaelRequerimientosAdmin
{
    protected $baseRouteName    = 'sigereq_empleado';
    protected $baseRoutePattern = 'catalogo/empleado';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('nombre')
            ->add('apellido')
            ->add('habilitado')
            ->add('correoElectronico')
            ->add('telefonoCasa')
            ->add('telefonoCelular')
            ->add('fechaNacimiento')
            ->add('fechaHoraReg')
            ->add('fechaHoraMod')
            ->add('horaNacimiento')
            ->add('idSexo')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('nombre')
            ->add('apellido')
            ->add('habilitado')
            ->add('correoElectronico')
            ->add('telefonoCasa')
            ->add('telefonoCelular')
            ->add('fechaNacimiento')
            ->add('fechaHoraReg')
            ->add('fechaHoraMod')
            ->add('horaNacimiento')
            ->add('idSexo')
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
                ->add('nombre', null, array(
                                        'label' => 'Nombre',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'attr' => array(/*'maxlength' => '100',*/
                                                        'placeholder' => 'Nombre',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-6 col-md-6 col-sm-6',
                                                        'class' => 'input-sm',

                                                        'data-add-input-addon' => 'true',
                                                        'data-add-input-addon-class' => 'primary-v4',
                                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-user',

                                                        'data-fv-stringlength' => 'true',
                                                        'data-fv-stringlength-min' => '5',
                                                        'data-fv-stringlength-max' => '100',
                                                        'data-fv-stringlength-message' => '5 caracteres mínimo',

                                                        'data-fv-regexp' => 'true',
                                                        'data-fv-regexp-regexp' => '^[a-zA-Z_-,\.\s]+$',
                                                        'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                                        )
                ))
                ->add('apellido', null, array(
                                        'label' => 'Apellido',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'attr' => array(/*'maxlength' => '100',*/
                                                        'placeholder' => 'Apellido',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-6 col-md-6 col-sm-6',
                                                        'class' => 'input-sm',

                                                        'data-add-input-addon' => 'true',
                                                        'data-add-input-addon-class' => 'primary-v4',
                                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-user',

                                                        'data-fv-stringlength' => 'true',
                                                        'data-fv-stringlength-min' => '5',
                                                        'data-fv-stringlength-max' => '100',
                                                        'data-fv-stringlength-message' => '5 caracteres mínimo',

                                                        'data-fv-regexp' => 'true',
                                                        'data-fv-regexp-regexp' => '^[a-zA-Z_-,\.\s]+$',
                                                        'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                                        )
                ))
                ->add('habilitado', null, array(
                                        'label' => 'Habilitado',
                                        'label_attr' => array('class' => 'label_form_sm label_check'),
                                        'required' => false,
                                        'attr' => array('data-input-transform' => 'icheck',
                                                        'class' => 'form-control input-sm',
                                        )
                ))
                ->add('correoInstitucional', null, array(
                                        'label' => 'Correo institucional',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'attr' => array(/*'maxlength' => '75',*/
                                                        'placeholder' => 'correo.electrónico@dominio.gob.sv',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-6 col-md-6 col-sm-6',
                                                        'class' => 'form-control input-sm',

                                                        'data-add-input-addon' => 'true',
                                                        'data-add-input-addon-class' => 'primary-v4',
                                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-envelope',

                                                        'data-fv-stringlength' => 'true',
                                                        'data-fv-stringlength-min' => '5',
                                                        'data-fv-stringlength-max' => '75',
                                                        'data-fv-stringlength-message' => '5 caracteres mínimo',

                                                        'data-fv-callback' => 'true',
                                                        'data-fv-callback-message' => 'Dato introducido no es válido',
                                                        'data-fv-callback-callback' => 'checkValidInfoContacto',
                                        )
                ))
                ->add('correoElectronico', null, array(
                                        'label' => 'Correo personal',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'attr' => array(/*'maxlength' => '75',*/
                                                        'placeholder' => 'correo.electrónico@dominio',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-6 col-md-6 col-sm-6',
                                                        'class' => 'form-control input-sm',

                                                        'data-add-input-addon' => 'true',
                                                        'data-add-input-addon-class' => 'primary-v4',
                                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-envelope',

                                                        'data-fv-stringlength' => 'true',
                                                        'data-fv-stringlength-min' => '5',
                                                        'data-fv-stringlength-max' => '75',
                                                        'data-fv-stringlength-message' => '5 caracteres mínimo',

                                                        'data-fv-callback' => 'true',
                                                        'data-fv-callback-message' => 'Dato introducido no es válido',
                                                        'data-fv-callback-callback' => 'checkValidInfoContacto',
                                        )
                ))
                ->add('telefonoCasa', null, array(
                                        'label' => 'Teléfono casa',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'attr' => array(/*'maxlength' => '75',*/
                                                        'placeholder' => '9-999-9999',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',
                                                        'class' => 'form-control input-sm',

                                                        'data-add-input-addon' => 'true',
                                                        'data-add-input-addon-class' => 'primary-v4',
                                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-phone-alt',

                                                        'data-fv-stringlength' => 'true',
                                                        'data-fv-stringlength-min' => '5',
                                                        'data-fv-stringlength-max' => '75',
                                                        'data-fv-stringlength-message' => '5 caracteres mínimo',

                                                        'data-fv-callback' => 'true',
                                                        'data-fv-callback-message' => 'Dato introducido no es válido',
                                                        'data-fv-callback-callback' => 'checkValidInfoContacto',
                                        )
                ))
                ->add('telefonoCelular', null, array(
                                        'label' => 'Teléfono celular',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'attr' => array(/*'maxlength' => '75',*/
                                                        'placeholder' => '9-999-9999',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',
                                                        'class' => 'form-control input-sm',

                                                        'data-add-input-addon' => 'true',
                                                        'data-add-input-addon-class' => 'primary-v4',
                                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-phone-alt',

                                                        'data-fv-stringlength' => 'true',
                                                        'data-fv-stringlength-min' => '5',
                                                        'data-fv-stringlength-max' => '75',
                                                        'data-fv-stringlength-message' => '5 caracteres mínimo',

                                                        'data-fv-callback' => 'true',
                                                        'data-fv-callback-message' => 'Dato introducido no es válido',
                                                        'data-fv-callback-callback' => 'checkValidInfoContacto',
                                        )
                ))
                ->add('fechaNacimiento', 'datetime', array(
                                        'label' => 'Fecha de Nacimiento',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => false,
                                        'widget' => 'single_text',
                                        'format' => 'yyyy-MM-dd',
                                        'attr' => array(/*'readonly' => 'readonly',*/
                                                        'placeholder' => 'YYYY-MM-DD',
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
                ->add('horaNacimiento', 'datetime', array(
                                        'label' => 'Hora de Nacimiento',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => false,
                                        'widget' => 'single_text',
                                        'format' => 'HH:mm',
                                        'attr' => array(/*'readonly' => 'readonly',*/
                                                        'placeholder' => 'HH:mm',
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',
                                                        'class' => 'form-control input-sm',
                                                        'data-input-transform' => 'datetimepicker',
                                                        'data-datetimepicker-type' => 'time',

                                                        'data-add-input-btn' => 'true',
                                                        'data-add-input-btn-class' => 'display-datetimepicker',
                                                        'data-add-input-btn-btn-class' => 'btn-sm btn-primary-v4 display-datetimepicker',
                                                        'data-add-input-btn-addon' => 'glyphicon glyphicon-time',

                                                        'data-fv-date' => 'true',
                                                        'data-fv-date-format' => 'YYYY-MM-DD',
                                                        'data-fv-date-message' => 'Fecha no válida',
                                        )
                ))
                ->add('fechaContratacion', 'datetime', array(
                                        'label' => 'Fecha de Contratación',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => false,
                                        'widget' => 'single_text',
                                        'format' => 'yyyy-MM-dd',
                                        'attr' => array(/*'readonly' => 'readonly',*/
                                                        'placeholder' => 'YYYY-MM-DD',
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
                ->add('fechaIniciaLabores', 'datetime', array(
                                        'label' => 'Fecha de inicio de labores',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => false,
                                        'widget' => 'single_text',
                                        'format' => 'yyyy-MM-dd',
                                        'attr' => array(/*'readonly' => 'readonly',*/
                                                        'placeholder' => 'YYYY-MM-DD',
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
                ->add('fechaFinalizaLabores', 'datetime', array(
                                        'label' => 'Fecha de finalización de labores',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => false,
                                        'widget' => 'single_text',
                                        'format' => 'yyyy-MM-dd',
                                        'attr' => array(/*'readonly' => 'readonly',*/
                                                        'placeholder' => 'YYYY-MM-DD',
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
                ->add('idSexo', null, array(
                                        'label' => 'Sexo',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => true,
                                        // 'empty_value' => '',
                                        'expanded' => true,
                                        'multiple' => false,
                                        'attr' => array(/*'style' => 'min-width: 100%; max-width: 100%;',*/
                                                        'data-add-form-group-col' => 'true',
                                                        'data-add-form-group-col-class' => 'col-lg-9 col-md-9 col-sm-9',
                                                        'data-radio-display-form' => 'inline',
                                                        'class' => 'form-control input-sm',
                                                        'data-input-transform' => 'select2',
                                                        'data-apply-formatter' => 'user',
                                                        'data-apply-formatter-mode' => 'enabled',

                                                        'data-fv-notempty' => 'true',
                                                        'data-fv-notempty-message' => 'Seleccione un elemento',
                                        )
                ))
                ->add('idTipoEmpleado', null, array(
                                        'label' => 'Tipo / Clasificación',
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
                ->add('idCargoEmpleado', null, array(
                                        'label' => 'Cargo',
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
                ->add('idAreaServicioAtencion', null, array(
                                        'label' => 'Departamento',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => false,
                                        'empty_value' => '',
                                        'group_by' => 'idAreaAtencion',
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
                ->add('idJefeInmediato', null, array(
                                        'label' => 'Jefe inmediato',
                                        'label_attr' => array('class' => 'label_form_sm'),
                                        'required' => false,
                                        'empty_value' => '',
                                        'group_by' => 'idAreaServicioAtencion',
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
            ->add('nombre')
            ->add('apellido')
            ->add('habilitado')
            ->add('correoElectronico')
            ->add('telefonoCasa')
            ->add('telefonoCelular')
            ->add('fechaNacimiento')
            ->add('fechaHoraReg')
            ->add('fechaHoraMod')
            ->add('horaNacimiento')
            ->add('idSexo')
        ;
    }
    
    public function getNewInstance()
    {
        $instance   = parent::getNewInstance();
        
        /*
         * default values
         */
        $instance->setIdSexo($this->getModelManager()->findOneBy('SanRafaelRequerimientosBundle:ReqCtlSexo', array('codigo' => 'M')));
        $instance->setIdCargoEmpleado($this->getModelManager()->findOneBy('SanRafaelRequerimientosBundle:ReqCtlCargoEmpleado', array('codigo' => 'DHP')));
        $instance->setIdTipoEmpleado($this->getModelManager()->findOneBy('SanRafaelRequerimientosBundle:ReqCtlTipoEmpleado', array('codigo' => 'MED')));
        
        return $instance;
    }

}