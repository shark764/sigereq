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

class BlhHistorialClinicoAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'siblh_historial_clinico';
    protected $baseRoutePattern = 'blh/historial-clinico';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            // ->add('id')
            ->add('controlPrenatal')
            ->add('edadGestFur')
            ->add('lugarControl')
            ->add('numeroControl')
            ->add('fechaParto')
            ->add('lugarParto')
            ->add('patologiaEmbarazo')
            ->add('periodoIntergenesico')
            ->add('fechaPartoAnterior')
            ->add('formulaObstetricaG')
            ->add('formulaObstetricaP1')
            ->add('formulaObstetricaP2')
            ->add('formulaObstetricaA')
            ->add('formulaObstetricaV')
            ->add('formulaObstetricaM')
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
            ->add('controlPrenatal')
            ->add('edadGestFur')
            ->add('lugarControl')
            ->add('numeroControl')
            ->add('fechaParto')
            ->add('lugarParto')
            ->add('patologiaEmbarazo')
            ->add('periodoIntergenesico')
            ->add('fechaPartoAnterior')
            ->add('formulaObstetricaG')
            ->add('formulaObstetricaP1')
            ->add('formulaObstetricaP2')
            ->add('formulaObstetricaA')
            ->add('formulaObstetricaV')
            ->add('formulaObstetricaM')
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
            ->add('idDonante', null, array(
                            'label' => 'Donante',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'start',
                                    // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-user',
                            )
            ))
            ->add('idEstablecimiento', null, array(
                            'label' => 'Establecimiento',
                            'required' => false,
                            // 'query_builder' => function(EntityRepository $er) {
                            //                         return $er->createQueryBuilder('std')
                            //                                         ->innerJoin('std.idTipoEstablecimiento', 'tipo')
                            //                                         ->where('tipo.codigo IN (:code_hospital_type)')
                            //                                         ->setParameter('code_hospital_type', array('HBSN', 'HDSN', 'HRSN', 'CERN'))
                            //                                         ->orderBy('std.nombre', 'asc')
                            //                                         ->distinct();
                            //                     },
                            'group_by' => 'idTipoEstablecimiento',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'stop',
                                    // 'data-add-form-group-col-class' => 'col-lg-7 col-md-7 col-sm-7',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-home',
                            )
            ))
            ->add('formulaObstetricaG', null, array(
                            'label' => 'G',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    // 'rows' => '2',
                                    // 'style' => 'resize:none',
                                    // 'placeholder' => 'patología en el embarazo...',
                                    'class' => 'form-control input-sm',
                                    'data-add-form-group-col-class' => 'col-lg-1 col-md-1 col-sm-1',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '5',
                                    'data-fv-stringlength-message' => '5 caracteres mínimo',

                                    'data-fv-regexp' => 'true',
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_EXTENDED___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            ->add('formulaObstetricaP1', null, array(
                            'label' => 'P1',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    // 'rows' => '2',
                                    // 'style' => 'resize:none',
                                    // 'placeholder' => 'patología en el embarazo...',
                                    'class' => 'form-control input-sm',
                                    'data-add-form-group-col-class' => 'col-lg-1 col-md-1 col-sm-1',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '5',
                                    'data-fv-stringlength-message' => '5 caracteres mínimo',

                                    'data-fv-regexp' => 'true',
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_EXTENDED___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            ->add('formulaObstetricaP2', null, array(
                            'label' => 'P2',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    // 'rows' => '2',
                                    // 'style' => 'resize:none',
                                    // 'placeholder' => 'patología en el embarazo...',
                                    'class' => 'form-control input-sm',
                                    'data-add-form-group-col-class' => 'col-lg-1 col-md-1 col-sm-1',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '5',
                                    'data-fv-stringlength-message' => '5 caracteres mínimo',

                                    'data-fv-regexp' => 'true',
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_EXTENDED___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            ->add('formulaObstetricaA', null, array(
                            'label' => 'A',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    // 'rows' => '2',
                                    // 'style' => 'resize:none',
                                    // 'placeholder' => 'patología en el embarazo...',
                                    'class' => 'form-control input-sm',
                                    'data-add-form-group-col-class' => 'col-lg-1 col-md-1 col-sm-1',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '5',
                                    'data-fv-stringlength-message' => '5 caracteres mínimo',

                                    'data-fv-regexp' => 'true',
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_EXTENDED___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            ->add('formulaObstetricaV', null, array(
                            'label' => 'V',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    // 'rows' => '2',
                                    // 'style' => 'resize:none',
                                    // 'placeholder' => 'patología en el embarazo...',
                                    'class' => 'form-control input-sm',
                                    'data-add-form-group-col-class' => 'col-lg-1 col-md-1 col-sm-1',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '5',
                                    'data-fv-stringlength-message' => '5 caracteres mínimo',

                                    'data-fv-regexp' => 'true',
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_EXTENDED___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            ->add('formulaObstetricaM', null, array(
                            'label' => 'M',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    // 'rows' => '2',
                                    // 'style' => 'resize:none',
                                    // 'placeholder' => 'patología en el embarazo...',
                                    'class' => 'form-control input-sm',
                                    'data-add-form-group-col-class' => 'col-lg-1 col-md-1 col-sm-1',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '5',
                                    'data-fv-stringlength-message' => '5 caracteres mínimo',

                                    'data-fv-regexp' => 'true',
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_EXTENDED___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            ->add('edadGestFur', null, array(
                            // 'label' => '1ra Crema',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    // 'placeholder' => '1ra crema...',
                                    'class' => 'form-control input-sm',
                                    // 'readonly' => 'readonly',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-time',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
//            ->add('controlPrenatal', null, array(
//                            'label' => 'Control prenatal',
//                            'label_attr' => array('class' => 'label_form_sm'),
//                            'required' => false,
//                            'attr' => array(
//                                    // 'rows' => '2',
//                                    // 'style' => 'resize:none',
//                                    'placeholder' => 'control prenatal...',
//                                    'class' => 'form-control input-sm',
//
//                                    'data-fv-stringlength' => 'true',
//                                    'data-fv-stringlength-min' => '5',
//                                    'data-fv-stringlength-message' => '5 caracteres mínimo',
//
//                                    'data-fv-regexp' => 'true',
//                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_EXTENDED___,
//                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
//                            )
//            ))
            ->add('controlPrenatalEmbarazo', 'choice', array(
                            'label' => '¿Control prenatal?',
                            'label_attr' => array('class' => 'label_form_sm'),
//                            'mapped' => false,
                            'required' => true,
                            'expanded' => true,
                            'multiple' => false,
                            'choices' => array(
                                    false => 'No',
                                    true => 'Si',
                            ),
                            'data' => false,
                            'attr' => array(
                                    'class' => /*'form-control input-sm'*/ 'list-inline formstyle-radio-list-inline input-sm',
                                    'data-add-form-group-col-class' => 'col-lg-2 col-md-2 col-sm-2',
                                    // 'data-sonata-select2-escape-markup' => 'true',
                                    'data-form-inline-group' => 'start',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart-empty',
                            )
            ))
//            ->add('lugarControl', null, array(
//                            'label' => 'Lugar del control',
//                            'label_attr' => array('class' => 'label_form_sm'),
//                            'required' => false,
//                            'attr' => array(
//                                    // 'rows' => '2',
//                                    // 'style' => 'resize:none',
//                                    'placeholder' => 'lugar del control...',
//                                    'class' => 'form-control input-sm',
//
//                                    'data-fv-stringlength' => 'true',
//                                    'data-fv-stringlength-min' => '5',
//                                    'data-fv-stringlength-message' => '5 caracteres mínimo',
//
//                                    'data-fv-regexp' => 'true',
//                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_EXTENDED___,
//                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
//                            )
//            ))
            ->add('numeroControl', null, array(
                            'label' => 'Número de control',
                            'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'placeholder' => 'número de control...',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-2 col-md-2 col-sm-2',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',

                                    'data-fv-integer' => 'true',
                                    'data-fv-integer-message' => 'El valor no es un entero',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            ->add('periodoIntergenesico', null, array(
                            'label' => 'Periodo intergenésico',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'placeholder' => 'periodo intergenésico...',
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
            ->add('fechaParto', 'datetime', array(
                            'label' => 'Fecha de parto',
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
            ->add('NOTMAPPEDpartoEnHospital', 'choice', array(
                            'label' => '¿Parto dentro del Hospital?',
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
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart-empty',
                            )
            ))
            ->add('lugarParto', null, array(
                            'label' => 'Lugar del parto',
                            'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
                            'required' => false,
                            'attr' => array(
                                    // 'rows' => '2',
                                    // 'style' => 'resize:none',
                                    'placeholder' => 'lugar del parto...',
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-5 col-md-5 col-sm-5',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '5',
                                    'data-fv-stringlength-message' => '5 caracteres mínimo',

                                    'data-fv-regexp' => 'true',
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_EXTENDED___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            ->add('NOTMAPPEDpatologiaEmbarazo', 'choice', array(
                            'label' => '¿Patología durante embarazo?',
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
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart-empty',
                            )
            ))
            ->add('idPatologiaEmbarazo', null, array(
                            'label' => 'Patología',
                            'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
                            'required' => false,
                            'group_by' => 'idPatologiaPadre',
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-5 col-md-5 col-sm-5',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart-empty',
                            )
            ))
//            ->add('patologiaEmbarazo', null, array(
//                            'label' => 'Patología',
//                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
//                            'required' => false,
//                            'attr' => array(
//                                    // 'rows' => '2',
//                                    // 'style' => 'resize:none',
//                                    'placeholder' => 'patología en el embarazo...',
//                                    'class' => 'form-control input-sm',
//                                    'data-form-inline-group' => 'stop',
//                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',
//
//                                    'data-fv-stringlength' => 'true',
//                                    'data-fv-stringlength-min' => '5',
//                                    'data-fv-stringlength-message' => '5 caracteres mínimo',
//
//                                    'data-fv-regexp' => 'true',
//                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_EXTENDED___,
//                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
//                            )
//            ))
            ->add('NOTMAPPEDpartoAnterior', 'choice', array(
                            'label' => '¿Partos anteriores?',
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
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart-empty',
                            )
            ))
            ->add('fechaPartoAnterior', 'datetime', array(
                            'label' => 'Fecha (Parto anterior)',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'required' => false,
                            'widget' => 'single_text',
                            'format' => 'dd/MM/yyyy',
                            'attr' => array(
                                    // 'readonly' => 'readonly',
                                    'placeholder' => 'DD/MM/YYYY',
                                    'class' => 'form-control input-sm',
                                    'data-input-transform' => 'datetimepicker',
                                    'data-datetimepicker-type' => 'date',
                                    'data-form-inline-group' => 'stop',
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
            ->add('controlPrenatal')
            ->add('edadGestFur')
            ->add('lugarControl')
            ->add('numeroControl')
            ->add('fechaParto')
            ->add('lugarParto')
            ->add('patologiaEmbarazo')
            ->add('periodoIntergenesico')
            ->add('fechaPartoAnterior')
            ->add('formulaObstetricaG')
            ->add('formulaObstetricaP1')
            ->add('formulaObstetricaP2')
            ->add('formulaObstetricaA')
            ->add('formulaObstetricaV')
            ->add('formulaObstetricaM')
            // ->add('usuario')
            // ->add('fechaHoraReg')
        ;
    }
    
    public function getTemplate($name)
    {
        switch ($name)
        {
            case 'edit':
                return 'MinsalSiblhBundle:BlhHistorialClinicoAdmin:base_edit.html.twig';
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