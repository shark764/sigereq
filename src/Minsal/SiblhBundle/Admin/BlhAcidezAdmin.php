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
            // ->add('idFrascoRecolectado', 'sonata_type_model_hidden')
            ->add('idFrascoRecolectado', null, array(
                            'label' => false,
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => true,
                            // 'required' => false,
                            'expanded' => true,
                            'multiple' => false,
                            'class' => 'MinsalSiblhBundle:BlhFrascoRecolectado',
                            // 'query_builder' => function(EntityRepository $er) use ($session_USER_LOCATION, $resultId, $patientId, $rType) {
                            //                         return $er->pendingStudies($session_USER_LOCATION->getId(), $resultId, $patientId, null, $rType);
                            //                     },
                            'group_by' => 'idLoteAnalisis',
                            'attr' => array(
                                    'class' => /*'form-control input-sm'*/ /*'list-inline*/' formstyle-radio-list-inline input-sm',
                                    'data-add-form-group-col-class' => 'col-lg-12 col-md-12 col-sm-12',
                            )
            ))
            ->add('acidez1', null, array(
                            'label' => '1ra Acidez',
                            'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'placeholder' => '1ra acidez...',
                                    'data-form-inline-group' => 'start',
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
            ->add('acidez2', null, array(
                            'label' => '2da Acidez',
                            'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'placeholder' => '2da acidez...',
                                    'data-form-inline-group' => 'continue',
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
            ->add('acidez3', null, array(
                            'label' => '3ra Acidez',
                            'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'placeholder' => '3ra acidez...',
                                    'data-form-inline-group' => 'continue',
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
            ->add('mediaAcidez', null, array(
                            'label' => 'Acidez promedio',
                            'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'acidez promedio...',
                                    'class' => 'form-control input-sm',
                                    'readonly' => 'readonly',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-2 col-md-2 col-sm-2',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',

                                    // 'data-fv-numeric' => 'true',
                                    // 'data-fv-numeric-message' => 'El valor no es un número válido',
                                    // 'data-fv-numeric-thousandsSeparator' => '',
                                    // 'data-fv-numeric-decimalSeparator' => '.',

                                    // 'min' => '0',
                                    // 'max' => '32767',
                                    // 'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                            )
            ))
            ->add('factor', null, array(
                            'label' => 'Factor',
                            'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'factor...',
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-3 col-md-3 col-sm-3',

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
                            'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'resultado...',
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-3 col-md-3 col-sm-3',

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

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            // array('MinsalSiblhBundle:BlhAcidezAdmin:doctrine_orm_form_admin_fields.html.twig'),
            array('MinsalSiblhBundle:BlhAcidezAdmin:form_admin_fields.html.twig')
       );
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