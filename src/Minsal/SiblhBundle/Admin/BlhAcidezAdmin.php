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

class BlhAcidezAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'siblh_acidez';
    protected $baseRoutePattern = 'blh/acidez';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            // ->add('id')
            ->add('acidez1')
            ->add('acidez2')
            ->add('acidez3')
            ->add('factor')
            ->add('resultado')
            ->add('mediaAcidez')
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
            ->add('acidez1')
            ->add('acidez2')
            ->add('acidez3')
            ->add('factor')
            ->add('resultado')
            ->add('mediaAcidez')
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
            ->add('idFrascoRecolectado', 'sonata_type_model_hidden')
            // ->add('idFrascoRecolectado', null, array(
            //                 'label' => 'Frasco recolectado',
            //                 'label_attr' => array('class' => 'label_form_sm'),
            //                 'required' => false,
            //                 'group_by' => 'idLoteAnalisis',
            //                 'attr' => array(
            //                         'class' => 'form-control input-sm',
            //                         // 'data-form-inline-group' => 'start',
            //                         // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

            //                         'data-add-input-addon' => 'true',
            //                         // 'data-add-input-addon-class' => 'primary-v4',
            //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',
            //                 )
            // ))
            ->add('acidez1', null, array(
                            'label' => '1ra Acidez',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'placeholder' => '1ra acidez...',
                                    // 'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

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
            ->add('acidez2', null, array(
                            'label' => '2da Acidez',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'placeholder' => '2da acidez...',
                                    // 'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

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
            ->add('acidez3', null, array(
                            'label' => '3ra Acidez',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'placeholder' => '3ra acidez...',
                                    // 'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

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
            ->add('mediaAcidez', null, array(
                            'label' => 'Acidez promedio',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'acidez promedio...',
                                    'class' => 'form-control input-sm',
                                    'readonly' => 'readonly',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

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
            ->add('factor', null, array(
                            'label' => 'Factor',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'factor...',
                                    'class' => 'form-control input-sm',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-edit',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    'min' => '0',
                                    'max' => '32767',
                                    'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            ->add('resultado', null, array(
                            'label' => 'Resultado',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'resultado...',
                                    'class' => 'form-control input-sm',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-edit',

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
            ->add('acidez1')
            ->add('acidez2')
            ->add('acidez3')
            ->add('factor')
            ->add('resultado')
            ->add('mediaAcidez')
            // ->add('usuario')
            // ->add('fechaHoraReg')
        ;
    }
    
    public function getTemplate($name)
    {
        switch ($name)
        {
            case 'edit':
                return 'MinsalSiblhBundle:BlhAcidezAdmin:base_edit.html.twig';
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