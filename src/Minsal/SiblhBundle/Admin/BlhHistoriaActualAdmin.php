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

class BlhHistoriaActualAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'siblh_historia_actual';
    protected $baseRoutePattern = 'blh/historia-actual';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            // ->add('id')
            ->add('pesoDonante')
            ->add('tallaDonante')
            ->add('medicamento')
            ->add('motivoDonacion')
            ->add('imc')
            ->add('estadoDonante')
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
            ->add('pesoDonante')
            ->add('tallaDonante')
            ->add('medicamento')
            ->add('motivoDonacion')
            ->add('imc')
            ->add('estadoDonante')
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
            ->add('idDonante', 'sonata_type_model_hidden')
            // ->add('idDonante', null, array(
            //                 'label' => 'Donante',
            //                 'label_attr' => array('class' => 'label_form_sm'),
            //                 'required' => false,
            //                 'attr' => array(
            //                         'class' => 'form-control input-sm',
            //                         // 'data-form-inline-group' => 'start',
            //                         // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

            //                         'data-add-input-addon' => 'true',
            //                         // 'data-add-input-addon-class' => 'primary-v4',
            //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-user',
            //                 )
            // ))
            ->add('pesoDonante', null, array(
                            'label' => 'Peso (kg)',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'peso (kg)...',
                                    'class' => 'form-control input-sm',
                                    // 'readonly' => 'readonly',
                                    'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-2 col-md-2 col-sm-2',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart-empty',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            ->add('tallaDonante', null, array(
                            'label' => /*false*/'Talla (m)',
                            'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'talla (m)...',
                                    'class' => 'form-control input-sm',
                                    // 'readonly' => 'readonly',
                                    'data-form-inline-group' => 'continue',
                                    'data-add-form-group-col-class' => 'col-lg-2 col-md-2 col-sm-2',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart-empty',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            ->add('imc', null, array(
                            'label' => /*false*/'IMC',
                            'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'Imc...',
                                    'class' => 'form-control input-sm',
                                    'readonly' => 'readonly',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-2 col-md-2 col-sm-2',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart-empty',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            // ->add('motivoDonacion', null, array(
            //                 'label' => 'Motivo de donación',
            //                 'label_attr' => array('class' => 'label_form_sm'),
            //                 'required' => false,
            //                 'attr' => array(
            //                         // 'rows' => '2',
            //                         // 'style' => 'resize:none',
            //                         'placeholder' => 'motivo de donación...',
            //                         'class' => 'form-control input-sm',

            //                         'data-fv-stringlength' => 'true',
            //                         'data-fv-stringlength-min' => '5',
            //                         'data-fv-stringlength-message' => '5 caracteres mínimo',

            //                         'data-fv-regexp' => 'true',
            //                         'data-fv-regexp-regexp' => self::___CLASS_REGEX_EXTENDED___,
            //                         'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
            //                 )
            // ))
            ->add('idMotivoDonacion', null, array(
                            'label' => 'Motivo de donación',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => true,
                            'property' => 'presentacionEntidad',
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'start',
                                    // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart',
                            )
            ))
            ->add('NOTMAPPEDmedicamento', 'choice', array(
                            'label' => '¿Uso de medicamento?',
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
            ->add('medicamento', null, array(
                            'label' => 'Medicamento',
                            'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
                            'required' => false,
                            'attr' => array(
                                    // 'rows' => '2',
                                    // 'style' => 'resize:none',
                                    'placeholder' => 'medicamento...',
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
            ->add('NOTMAPPEDhabitoToxico', 'choice', array(
                            'label' => '¿Posee hábito tóxico?',
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
            ->add('habitoToxico', null, array(
                            'label' => 'Hábito tóxico',
                            'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
                            'required' => false,
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-5 col-md-5 col-sm-5',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart-empty',
                            )
            ))
            ->add('NOTMAPPEDpatologia', 'choice', array(
                            'label' => '¿Padece enfermedad actualmente?',
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
            ->add('patologia', null, array(
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
           ->add('estadoDonante', null, array(
                           'label' => 'Estado de donante',
                           'label_attr' => array('class' => 'label_form_sm'),
                           'required' => false,
                           'attr' => array(
                                   // 'rows' => '2',
                                   // 'style' => 'resize:none',
                                   'placeholder' => 'estado de donante...',
                                   'class' => 'form-control input-sm',

                                   'data-fv-stringlength' => 'true',
                                   'data-fv-stringlength-min' => '5',
                                   'data-fv-stringlength-message' => '5 caracteres mínimo',

                                   'data-fv-regexp' => 'true',
                                   'data-fv-regexp-regexp' => self::___CLASS_REGEX_EXTENDED___,
                                   'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                           )
           ))
            ->add('donanteApta', null, array(
                            'label' => '¿Es apta para donación?',
                            'label_attr' => array('class' => 'label_form_sm label_check col-lg-12 col-md-12 col-sm-12'),
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'data-bootstrap-switch' => 'true',
                                    'data-on-text' => 'Apta',
                                    'data-off-text' => 'No apta',
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
            ->add('pesoDonante')
            ->add('tallaDonante')
            ->add('medicamento')
            ->add('motivoDonacion')
            ->add('imc')
            ->add('estadoDonante')
            // ->add('usuario')
            // ->add('fechaHoraReg')
        ;
    }
    
    public function getTemplate($name)
    {
        switch ($name)
        {
            case 'edit':
                return 'MinsalSiblhBundle:BlhHistoriaActualAdmin:base_edit.html.twig';
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