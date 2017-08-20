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

class BlhSolicitudAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'siblh_solicitud';
    protected $baseRoutePattern = 'blh/solicitud';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            // ->add('id')
            ->add('codigoSolicitud')
            ->add('volumenPorDia')
            ->add('acidezNecesaria')
            ->add('caloriasNecesarias')
            ->add('pesoDia')
            ->add('volumenPorToma')
            ->add('tomaPorDia')
            ->add('fechaSolicitud')
            ->add('cuna')
            ->add('estado')
            ->add('responsable')
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
            ->add('codigoSolicitud')
            ->add('volumenPorDia')
            ->add('acidezNecesaria')
            ->add('caloriasNecesarias')
            ->add('pesoDia')
            ->add('volumenPorToma')
            ->add('tomaPorDia')
            ->add('fechaSolicitud')
            ->add('cuna')
            ->add('estado')
            ->add('responsable')
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
            ->add('idReceptor', 'sonata_type_model_hidden')
            // ->add('idReceptor', null, array(
            //                 'label' => 'Receptor',
            //                 'label_attr' => array('class' => 'label_form_sm'),
            //                 'required' => true,
            //                 'attr' => array(
            //                         'class' => 'form-control input-sm',
            //                         // 'data-form-inline-group' => 'start',
            //                         // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

            //                         'data-add-input-addon' => 'true',
            //                         // 'data-add-input-addon-class' => 'primary-v4',
            //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-heart',
            //                 )
            // ))
            ->add('codigoSolicitud', null, array(
                            'label' => 'Código',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'código...',
                                    'class' => 'form-control input-sm',
                                    'readonly' => 'readonly',
                                    'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-barcode',
                            )
            ))
            ->add('fechaSolicitud', 'datetime', array(
                            'label' => 'Fecha de solicitud',
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
            ->add('cuna', null, array(
                            'label' => 'Cuna',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'required' => false,
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'placeholder' => 'cuna...',
                                    // 'readonly' => 'readonly',
                                    // 'data-form-inline-group' => 'stop',
                                    'data-form-inline-group' => 'start',
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
            ->add('pesoDia', null, array(
                            'label' => 'Peso del receptor (g)',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'required' => true,
                            'attr' => array(
                                    'placeholder' => 'peso receptor (g)...',
                                    'class' => 'form-control input-sm',
                                    // 'readonly' => 'readonly',
                                    // 'data-form-inline-group' => 'stop',
                                    'data-form-inline-group' => 'stop',
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
            ->add('volumenPorToma', null, array(
                            'label' => 'Vol. por toma (ml)',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'required' => true,
                            'attr' => array(
                                    'placeholder' => 'vol. / toma...',
                                    'class' => 'form-control input-sm',
                                    // 'readonly' => 'readonly',
                                    'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-3 col-md-3 col-sm-3',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-tint',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            ->add('tomaPorDia', null, array(
                            'label' => 'Tomas por día',
                            'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
                            // 'help' => '<span class="text-primary-v4">Se calculará automáticamente.</span>',
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'placeholder' => 'tomas / día...',
                                    // 'readonly' => 'readonly',
                                    'data-form-inline-group' => 'continue',
                                    'data-add-form-group-col-class' => 'col-lg-2 col-md-2 col-sm-2',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-tint',

                                    'data-fv-integer' => 'true',
                                    'data-fv-integer-message' => 'El valor no es un entero',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            ->add('volumenPorDia', null, array(
                            'label' => 'Vol. total / día (ml)',
                            'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
                            'required' => true,
                            'attr' => array(
                                    'placeholder' => 'vol. total / día (ml)...',
                                    'class' => 'form-control input-sm',
                                    // 'readonly' => 'readonly',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-3 col-md-3 col-sm-3',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-tint',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            // ->add('caloriasNecesarias', null, array(
            //                 'label' => 'Calorías necesarias',
            //                 'label_attr' => array('class' => 'label_form_sm'),
            //                 'required' => false,
            //                 'attr' => array(
            //                         // 'rows' => '2',
            //                         // 'style' => 'resize:none',
            //                         'placeholder' => 'calorías necesarias...',
            //                         'class' => 'form-control input-sm',
            //                         'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

            //                         'data-fv-stringlength' => 'true',
            //                         'data-fv-stringlength-min' => '5',
            //                         'data-fv-stringlength-message' => '5 caracteres mínimo',

            //                         'data-fv-regexp' => 'true',
            //                         'data-fv-regexp-regexp' => self::___CLASS_REGEX_EXTENDED___,
            //                         'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
            //                 )
            // ))
            ->add('idCaloriasNecesarias', null, array(
                            'label' => 'Calorías necesarias',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'required' => true,
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart',
                            )
            ))
            // ->add('acidezNecesaria', null, array(
            //                 'label' => 'Acidez Dornic',
            //                 'label_attr' => array('class' => 'label_form_sm'),
            //                 'required' => false,
            //                 'attr' => array(
            //                         // 'rows' => '2',
            //                         // 'style' => 'resize:none',
            //                         'placeholder' => 'acidez dornic...',
            //                         'class' => 'form-control input-sm',
            //                         'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

            //                         'data-fv-stringlength' => 'true',
            //                         'data-fv-stringlength-min' => '5',
            //                         'data-fv-stringlength-message' => '5 caracteres mínimo',

            //                         'data-fv-regexp' => 'true',
            //                         'data-fv-regexp-regexp' => self::___CLASS_REGEX_EXTENDED___,
            //                         'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
            //                 )
            // ))
            ->add('idAcidezNecesaria', null, array(
                            'label' => 'Acidez Dornic',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'required' => true,
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart',
                            )
            ))
            ->add('estado', null, array(
                            'label' => 'Estado',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'required' => false,
                            'attr' => array(
                                    // 'rows' => '2',
                                    // 'style' => 'resize:none',
                                    'placeholder' => 'estado...',
                                    'class' => 'form-control input-sm',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '5',
                                    'data-fv-stringlength-message' => '5 caracteres mínimo',

                                    'data-fv-regexp' => 'true',
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_EXTENDED___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            // ->add('responsable', null, array(
            //                 'label' => 'Responsable',
            //                 'label_attr' => array('class' => 'label_form_sm'),
            //                 'required' => false,
            //                 'attr' => array(
            //                         // 'rows' => '2',
            //                         // 'style' => 'resize:none',
            //                         'placeholder' => 'responsable...',
            //                         'class' => 'form-control input-sm',

            //                         'data-fv-stringlength' => 'true',
            //                         'data-fv-stringlength-min' => '5',
            //                         'data-fv-stringlength-message' => '5 caracteres mínimo',

            //                         'data-fv-regexp' => 'true',
            //                         'data-fv-regexp-regexp' => self::___CLASS_REGEX_EXTENDED___,
            //                         'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
            //                 )
            // ))
            ->add('idResponsableSolicitud', null, array(
                            'label' => 'Responsable de solicitud',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'required' => true,
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'start',
                                    // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-user',
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
            ->add('codigoSolicitud')
            ->add('volumenPorDia')
            ->add('acidezNecesaria')
            ->add('caloriasNecesarias')
            ->add('pesoDia')
            ->add('volumenPorToma')
            ->add('tomaPorDia')
            ->add('fechaSolicitud')
            ->add('cuna')
            ->add('estado')
            ->add('responsable')
            // ->add('usuario')
            // ->add('fechaHoraReg')
        ;
    }
    
    public function getTemplate($name)
    {
        switch ($name)
        {
            case 'edit':
                return 'MinsalSiblhBundle:BlhSolicitudAdmin:base_edit.html.twig';
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