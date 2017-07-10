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

class BlhFrascoProcesadoAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'siblh_frasco_procesado';
    protected $baseRoutePattern = 'blh/frasco-procesado';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            // ->add('id')
            ->add('codigoFrascoProcesado')
            ->add('volumenFrascoPasteurizado')
            ->add('acidezTotal')
            ->add('kcaloriasTotales')
            ->add('observacionFrascoProcesado')
            ->add('volumenDisponibleFp')
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
            ->add('codigoFrascoProcesado')
            ->add('volumenFrascoPasteurizado')
            ->add('acidezTotal')
            ->add('kcaloriasTotales')
            ->add('observacionFrascoProcesado')
            ->add('volumenDisponibleFp')
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
            // ->add('idPasteurizacion', null, array(
            //                 'label' => 'Pasteurización',
            //                 'label_attr' => array('class' => 'label_form_sm'),
            //                 'required' => false,
            //                 'attr' => array(
            //                         'class' => 'form-control input-sm',
            //                         // 'data-form-inline-group' => 'start',
            //                         // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

            //                         'data-add-input-addon' => 'true',
            //                         // 'data-add-input-addon-class' => 'primary-v4',
            //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',
            //                 )
            // ))
            ->add('idEstado', null, array(
                            'label' => 'Estado',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'start',
                                    // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',
                            )
            ))
            ->add('codigoFrascoProcesado', null, array(
                            'label' => 'Código',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => true,
                            'attr' => array(
                                    'placeholder' => 'código...',
                                    'class' => 'form-control input-sm',
                                    'readonly' => 'readonly',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-barcode',
                            )
            ))
            ->add('volumenFrascoPasteurizado', null, array(
                            'label' => 'Vol. de frasco pasteurizado (ml)',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => true,
                            'attr' => array(
                                    'placeholder' => 'vol. de frasco pasteurizado (ml)...',
                                    'class' => 'form-control input-sm',
                                    // 'readonly' => 'readonly',
                                    'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-2 col-md-2 col-sm-2',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            ->add('acidezTotal', null, array(
                            'label' => 'Acidez total',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => true,
                            'attr' => array(
                                    'placeholder' => 'acidez total...',
                                    'class' => 'form-control input-sm',
                                    // 'readonly' => 'readonly',
                                    'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-2 col-md-2 col-sm-2',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            ->add('kcaloriasTotales', null, array(
                            'label' => 'Total de calorías',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => true,
                            'attr' => array(
                                    'placeholder' => 'total de calorías...',
                                    'class' => 'form-control input-sm',
                                    // 'readonly' => 'readonly',
                                    'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-2 col-md-2 col-sm-2',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            ->add('observacionFrascoProcesado', 'textarea', array(
                            'label' => 'Observaciones / Comentarios',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'rows' => '2',
                                    'style' => 'resize:none',
                                    'placeholder' => 'comentarios...',
                                    'class' => 'form-control input-sm',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '5',
                                    'data-fv-stringlength-message' => '5 caracteres mínimo',

                                    'data-fv-regexp' => 'true',
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_EXTENDED___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            ->add('volumenDisponibleFp', null, array(
                            'label' => 'Vol. disponible (ml)',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => true,
                            'attr' => array(
                                    'placeholder' => 'vol. disponible (ml)...',
                                    'class' => 'form-control input-sm',
                                    // 'readonly' => 'readonly',
                                    'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-2 col-md-2 col-sm-2',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
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
            ->add('codigoFrascoProcesado')
            ->add('volumenFrascoPasteurizado')
            ->add('acidezTotal')
            ->add('kcaloriasTotales')
            ->add('observacionFrascoProcesado')
            ->add('volumenDisponibleFp')
            // ->add('usuario')
            // ->add('fechaHoraReg')
        ;
    }

}