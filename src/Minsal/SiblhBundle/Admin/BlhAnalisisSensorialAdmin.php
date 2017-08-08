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

class BlhAnalisisSensorialAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'siblh_analisis_sensorial';
    protected $baseRoutePattern = 'blh/analisis-sensorial';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            // ->add('id')
            ->add('embalaje')
            ->add('suciedad')
            ->add('color')
            ->add('flavor')
            ->add('observacion')
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
            ->add('embalaje')
            ->add('suciedad')
            ->add('color')
            ->add('flavor')
            ->add('observacion')
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
            // ->add('embalaje', null, array(
            //                 'label' => 'Embalaje',
            //                 'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
            //                 'attr' => array(
            //                         'placeholder' => 'embalaje...',
            //                         'class' => 'form-control input-sm',
            //                         'data-form-inline-group' => 'start',
            //                         'data-add-form-group-col-class' => 'col-lg-2 col-md-2 col-sm-2',

            //                         'data-add-input-addon' => 'true',
            //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-heart-empty',

            //                         'data-fv-stringlength' => 'true',
            //                         'data-fv-stringlength-min' => '1',
            //                         'data-fv-stringlength-max' => '9',
            //                         'data-fv-stringlength-message' => '1 caracteres mínimo',

            //                         'data-fv-regexp' => 'true',
            //                         'data-fv-regexp-regexp' => self::___CLASS_REGEX_GENERAL___,
            //                         'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
            //                 )
            // ))
            ->add('idResultadoEmbalaje', null, array(
                            'label' => 'Embalaje',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'required' => true,
                            'property' => 'presentacionEntidad',
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',
                            )
            ))
            // ->add('suciedad', null, array(
            //                 'label' => 'Suciedad',
            //                 'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
            //                 'attr' => array(
            //                         'placeholder' => 'suciedad...',
            //                         'class' => 'form-control input-sm',
            //                         'data-form-inline-group' => 'continue',
            //                         'data-add-form-group-col-class' => 'col-lg-2 col-md-2 col-sm-2',

            //                         'data-add-input-addon' => 'true',
            //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-heart-empty',

            //                         'data-fv-stringlength' => 'true',
            //                         'data-fv-stringlength-min' => '1',
            //                         'data-fv-stringlength-max' => '9',
            //                         'data-fv-stringlength-message' => '1 caracteres mínimo',

            //                         'data-fv-regexp' => 'true',
            //                         'data-fv-regexp-regexp' => self::___CLASS_REGEX_GENERAL___,
            //                         'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
            //                 )
            // ))
            ->add('idResultadoSuciedad', null, array(
                            'label' => 'Suciedad',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'required' => true,
                            'property' => 'presentacionEntidad',
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',
                            )
            ))
            // ->add('color', null, array(
            //                 'label' => 'Color',
            //                 'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
            //                 'attr' => array(
            //                         'placeholder' => 'color...',
            //                         'class' => 'form-control input-sm',
            //                         'data-form-inline-group' => 'continue',
            //                         'data-add-form-group-col-class' => 'col-lg-2 col-md-2 col-sm-2',

            //                         'data-add-input-addon' => 'true',
            //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-heart-empty',

            //                         'data-fv-stringlength' => 'true',
            //                         'data-fv-stringlength-min' => '1',
            //                         'data-fv-stringlength-max' => '9',
            //                         'data-fv-stringlength-message' => '1 caracteres mínimo',

            //                         'data-fv-regexp' => 'true',
            //                         'data-fv-regexp-regexp' => self::___CLASS_REGEX_GENERAL___,
            //                         'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
            //                 )
            // ))
            ->add('idResultadoColor', null, array(
                            'label' => 'Color',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'required' => true,
                            'property' => 'presentacionEntidad',
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',
                            )
            ))
            // ->add('flavor', null, array(
            //                 'label' => 'Flavor',
            //                 'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
            //                 'attr' => array(
            //                         'placeholder' => 'flavor...',
            //                         'class' => 'form-control input-sm',
            //                         'data-form-inline-group' => 'stop',
            //                         'data-add-form-group-col-class' => 'col-lg-2 col-md-2 col-sm-2',

            //                         'data-add-input-addon' => 'true',
            //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-heart-empty',

            //                         'data-fv-stringlength' => 'true',
            //                         'data-fv-stringlength-min' => '1',
            //                         'data-fv-stringlength-max' => '9',
            //                         'data-fv-stringlength-message' => '1 caracteres mínimo',

            //                         'data-fv-regexp' => 'true',
            //                         'data-fv-regexp-regexp' => self::___CLASS_REGEX_GENERAL___,
            //                         'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
            //                 )
            // ))
            ->add('idResultadoFlavor', null, array(
                            'label' => 'Flavor',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'required' => true,
                            'property' => 'presentacionEntidad',
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',
                            )
            ))
            ->add('observacion', 'textarea', array(
                            'label' => 'Observaciones / Comentarios',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'required' => false,
                            'attr' => array(
                                    'rows' => '2',
                                    'style' => 'resize:none',
                                    'placeholder' => 'comentarios...',
                                    'class' => 'form-control input-sm',
                                    'data-add-form-group-col-class' => 'col-lg-6 col-md-6 col-sm-6',

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
            ->add('embalaje')
            ->add('suciedad')
            ->add('color')
            ->add('flavor')
            ->add('observacion')
            // ->add('usuario')
            // ->add('fechaHoraReg')
        ;
    }

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            // array('MinsalSiblhBundle:BlhAnalisisSensorialAdmin:doctrine_orm_form_admin_fields.html.twig'),
            array('MinsalSiblhBundle:BlhAnalisisSensorialAdmin:form_admin_fields.html.twig')
       );
    }
    
    public function getTemplate($name)
    {
        switch ($name)
        {
            case 'edit':
                return 'MinsalSiblhBundle:BlhAnalisisSensorialAdmin:base_edit.html.twig';
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