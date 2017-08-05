<?php

namespace Minsal\SiblhBundle\Admin;

use Minsal\SiblhBundle\Admin\MinsalSiblhBundleGeneralAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;

class BlhReceptorAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'siblh_receptor';
    protected $baseRoutePattern = 'blh/receptor';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            // ->add('id')
            ->add('codigoReceptor')
            ->add('fechaRegistroBlh')
            ->add('procedencia')
            ->add('estadoReceptor')
            ->add('edadDias')
            ->add('pesoReceptor')
            ->add('duracionCpap')
            ->add('clasificacionLubchengo')
            ->add('diagnosticoIngreso')
            ->add('duracionNpt')
            ->add('apgarPrimerMinuto')
            ->add('edadGestFur')
            ->add('duracionVentilacion')
            ->add('edadGestBallard')
            ->add('pc')
            ->add('tallaIngreso')
            ->add('apgarQuintoMinuto')
            // ->add('usuario')
            // ->add('fechaHoraReg')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            // ->add('id')
            ->add('codigoReceptor')
            ->add('fechaRegistroBlh')
            ->add('procedencia')
            ->add('estadoReceptor')
            ->add('edadDias')
            ->add('pesoReceptor')
            ->add('duracionCpap')
            ->add('clasificacionLubchengo')
            ->add('diagnosticoIngreso')
            ->add('duracionNpt')
            ->add('apgarPrimerMinuto')
            ->add('edadGestFur')
            ->add('duracionVentilacion')
            ->add('edadGestBallard')
            ->add('pc')
            ->add('tallaIngreso')
            ->add('apgarQuintoMinuto')
            // ->add('usuario')
            // ->add('fechaHoraReg')
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
            // ->add('id')
//            ->add('idBancoDeLeche', null, array(
//                            'label' => 'Banco de Leche',
//                            'label_attr' => array('class' => 'label_form_sm'),
//                            // 'required' => true,
//                            // 'group_by' => 'idEstablecimiento',
//                            'attr' => array(
//                                    'class' => 'form-control input-sm',
//
//                                    'data-add-input-addon' => 'true',
//                                    // 'data-add-input-addon-class' => 'primary-v4',
//                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-home',
//                            )
//            ))
            ->add('idBancoDeLeche', 'sonata_type_model_hidden')
//            ->add('idPaciente', null, array(
//                            'label' => 'Paciente (de SIAP)',
//                            'label_attr' => array('class' => 'label_form_sm'),
//                            // 'required' => true,
//                            // 'group_by' => 'idEstablecimiento',
//                            'attr' => array(
//                                    'class' => 'form-control input-sm',
//
//                                    'data-add-input-addon' => 'true',
//                                    // 'data-add-input-addon-class' => 'primary-v4',
//                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-user',
//                            )
//            ))
            ->add('idPaciente', 'sonata_type_model_hidden')
            ->add('idExpediente', 'sonata_type_model_hidden')
            ->add('idMadreDonante', null, array(
                            'label' => 'Madre donante',
                            'label_attr' => array('class' => 'label_form_sm'),
                            // 'required' => true,
                            // 'group_by' => 'idEstablecimiento',
                            'attr' => array(
                                    'class' => 'form-control input-sm',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-user',
                            )
            ))
            ->add('codigoReceptor', null, array(
                            'label' => 'Código',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'código...',
                                    'class' => 'form-control input-sm',
                                    'readonly' => 'readonly',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-barcode',
                            )
            ))
            ->add('fechaRegistroBlh', 'datetime', array(
                            'label' => 'Fecha de ingreso',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'widget' => 'single_text',
                            'format' => 'dd/MM/yyyy',
                            'attr' => array(
                                    // 'readonly' => 'readonly',
                                    'placeholder' => 'DD/MM/YYYY',
                                    'class' => 'form-control input-sm',
                                    'data-input-transform' => 'datetimepicker',
                                    'data-datetimepicker-type' => 'date',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-time',

                                    // 'data-add-input-btn' => 'true',
                                    // 'data-add-input-btn-class' => 'display-datetimepicker',
                                    // 'data-add-input-btn-btn-class' => 'btn-sm btn-xray-awesome-blue background-opacity display-datetimepicker',
                                    // 'data-add-input-btn-addon' => 'glyphicon glyphicon-time',

                                    'data-fv-date' => 'true',
                                    'data-fv-date-format' => 'DD/MM/YYYY',
                                    'data-fv-date-message' => 'No es una fecha válida',
                            )
            ))
            /////////////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////////
            // PROCEDENCIA DEBERÍA ESTAR ASOCIADA A MNT_ATEN_AREA_MOD_ESTAB
            /////////////////////////////////////////////////////////////////////////
            // ->add('procedencia', 'choice',
            //        array('choices' => array('' => 'Seleccione una opcion','UCIN' => 'UCIN',
            //              'Intermedios' => 'Intermedios',
            //              'Otro' => 'Otro')))
            /////////////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////////
            ->add('procedencia', null, array(
                            'label' => 'Procedencia',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'procedencia...',
                                    'class' => 'form-control input-sm',
//                                    'readonly' => 'readonly',
//                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-barcode',
                            )
            ))
//            ->add('estadoReceptor', null, array(
//                            'label' => 'Estado',
//                            'label_attr' => array('class' => 'label_form_sm'),
//                            'required' => false,
//                            'attr' => array(
//                                    'placeholder' => 'estado...',
//                                    'class' => 'form-control input-sm',
////                                    'readonly' => 'readonly',
////                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',
//
//                                    'data-add-input-addon' => 'true',
//                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-barcode',
//                            )
//            ))
            ->add('edadDias', null, array(
                            'label' => 'Edad (días)',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'placeholder' => 'edad (días)...',
//                                    'readonly' => 'readonly',
                                    // 'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-time',

                                    'data-fv-integer' => 'true',
                                    'data-fv-integer-message' => 'El valor no es un entero',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            ->add('edadGestFur', null, array(
                            'label' => 'Edad de gestación según FUR',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => true,
                            'attr' => array(
                                    'placeholder' => 'edad de gestación según fur...',
                                    'class' => 'form-control input-sm',
                                    // 'readonly' => 'readonly',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            ->add('pesoReceptor', null, array(
                            'label' => 'Peso (kg)',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => true,
                            'attr' => array(
                                    'placeholder' => 'peso (kg)...',
                                    'class' => 'form-control input-sm',
                                    // 'readonly' => 'readonly',
                                    'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            ->add('tallaIngreso', null, array(
                            'label' => 'Talla (m)',
                            'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
                            'required' => true,
                            'attr' => array(
                                    'placeholder' => 'talla (m)...',
                                    'class' => 'form-control input-sm',
                                    // 'readonly' => 'readonly',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-3 col-md-3 col-sm-3',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            ->add('pc', null, array(
                            'label' => 'Perimetro cefálico',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => true,
                            'attr' => array(
                                    'placeholder' => 'perimetro cefálico...',
                                    'class' => 'form-control input-sm',
                                    // 'readonly' => 'readonly',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
//            ->add('clasificacionLubchengo', null, array(
//                            'label' => 'Clasificación Lubchengo',
//                            'label_attr' => array('class' => 'label_form_sm'),
//                            'required' => false,
//                            'attr' => array(
//                                    'placeholder' => 'clasificación lubchengo...',
//                                    'class' => 'form-control input-sm',
////                                    'readonly' => 'readonly',
////                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',
//
//                                    'data-add-input-addon' => 'true',
//                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-tag',
//                            )
//            ))
            ->add('apgarPrimerMinuto', null, array(
                            'label' => 'Apgar 1er minuto',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'apgar 1er minuto...',
                                    'class' => 'form-control input-sm',
                                    // 'readonly' => 'readonly',
                                    'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-3 col-md-3 col-sm-3',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            ->add('apgarQuintoMinuto', null, array(
                            'label' => 'Apgar 5to minuto',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'apgar 5to minuto...',
                                    'class' => 'form-control input-sm',
                                    // 'readonly' => 'readonly',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-3 col-md-3 col-sm-3',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            ->add('edadGestBallard', null, array(
                            'label' => 'Edad de gestación según Ballard',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => true,
                            'attr' => array(
                                    'placeholder' => 'edad de gestación según ballard...',
                                    'class' => 'form-control input-sm',
                                    // 'readonly' => 'readonly',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            ->add('idCurvaLubchenco', null, array(
                            'label' => 'Clasificación Lubchengo',
                            'label_attr' => array('class' => 'label_form_sm'),
                            // 'required' => true,
                            // 'group_by' => 'idEstablecimiento',
                            'attr' => array(
                                    'class' => 'form-control input-sm',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-tag',
                            )
            ))
            ->add('NOTMAPPEDduracionVentilacion', 'choice', array(
                            'label' => '¿Ventilacion mecánica?',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'mapped' => false,
                            'required' => true,
                            'expanded' => true,
                            'multiple' => false,
                            'choices' => array(
                                    'F' => 'No',
                                    'T' => 'Si',
                            ),
                            'data' => 'F',
                            'attr' => array(
                                    'class' => /*'form-control input-sm'*/ 'list-inline formstyle-radio-list-inline input-sm',
                                    'data-add-form-group-col-class' => 'col-lg-2 col-md-2 col-sm-2',
                                    // 'data-sonata-select2-escape-markup' => 'true',
                                    'data-form-inline-group' => 'start',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-skipicon' => 'true',
                            )
            ))
            ->add('duracionVentilacion', null, array(
                            'label' => 'Duración de ventilación',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'placeholder' => 'duración de ventilación...',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-time',

                                    'data-fv-integer' => 'true',
                                    'data-fv-integer-message' => 'El valor no es un entero',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            ->add('NOTMAPPEDduracionCpap', 'choice', array(
                            'label' => '¿CPAP?',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'mapped' => false,
                            'required' => true,
                            'expanded' => true,
                            'multiple' => false,
                            'choices' => array(
                                    'F' => 'No',
                                    'T' => 'Si',
                            ),
                            'data' => 'F',
                            'attr' => array(
                                    'class' => /*'form-control input-sm'*/ 'list-inline formstyle-radio-list-inline input-sm',
                                    'data-add-form-group-col-class' => 'col-lg-2 col-md-2 col-sm-2',
                                    // 'data-sonata-select2-escape-markup' => 'true',
                                    'data-form-inline-group' => 'start',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-skipicon' => 'true',
                            )
            ))
            ->add('duracionCpap', null, array(
                            'label' => 'Duración CPAP nasal',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'placeholder' => 'duración CPAP nasal...',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-time',

                                    'data-fv-integer' => 'true',
                                    'data-fv-integer-message' => 'El valor no es un entero',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            ->add('NOTMAPPEDduracionNpt', 'choice', array(
                            'label' => '¿Nutrición parenteral?',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'mapped' => false,
                            'required' => true,
                            'expanded' => true,
                            'multiple' => false,
                            'choices' => array(
                                    'F' => 'No',
                                    'T' => 'Si',
                            ),
                            'data' => 'F',
                            'attr' => array(
                                    'class' => /*'form-control input-sm'*/ 'list-inline formstyle-radio-list-inline input-sm',
                                    'data-add-form-group-col-class' => 'col-lg-2 col-md-2 col-sm-2',
                                    // 'data-sonata-select2-escape-markup' => 'true',
                                    'data-form-inline-group' => 'start',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-skipicon' => 'true',
                            )
            ))
            ->add('duracionNpt', null, array(
                            'label' => 'Duración NPT',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'placeholder' => 'duración NPT...',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart',

                                    'data-fv-integer' => 'true',
                                    'data-fv-integer-message' => 'El valor no es un entero',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            ->add('diagnosticoIngreso', null, array(
                            'label' => 'Diagnóstico de ingreso',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    // 'rows' => '2',
                                    // 'style' => 'resize:none',
                                    'placeholder' => 'diagnóstico de ingreso...',
                                    'class' => 'form-control input-sm',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '5',
                                    'data-fv-stringlength-message' => '5 caracteres mínimo',

                                    'data-fv-regexp' => 'true',
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_EXTENDED___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            // ->add('usuario')
            // ->add('fechaHoraReg')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            // ->add('id')
            ->add('codigoReceptor')
            ->add('fechaRegistroBlh')
            ->add('procedencia')
            ->add('estadoReceptor')
            ->add('edadDias')
            ->add('pesoReceptor')
            ->add('duracionCpap')
            ->add('clasificacionLubchengo')
            ->add('diagnosticoIngreso')
            ->add('duracionNpt')
            ->add('apgarPrimerMinuto')
            ->add('edadGestFur')
            ->add('duracionVentilacion')
            ->add('edadGestBallard')
            ->add('pc')
            ->add('tallaIngreso')
            ->add('apgarQuintoMinuto')
            // ->add('usuario')
            // ->add('fechaHoraReg')
        ;
    }
    
    public function getTemplate($name)
    {
        switch ($name)
        {
            case 'edit':
                return 'MinsalSiblhBundle:BlhReceptorAdmin:base_edit.html.twig';
                break;
            // case 'list':
            //     return 'MinsalSiblhBundle:CRUD:base_list.html.twig';
            //     break;
            // case 'show':
            //     return 'MinsalSiblhBundle:CRUD:base_show.html.twig';
            //     break;
            // case 'delete':
            //     return 'MinsalSiblhBundle:CRUD:delete.html.twig';
            //     break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

}