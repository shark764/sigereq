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

class BlhAnalisisMicrobiologicoAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'siblh_analisis_microbiologico';
    protected $baseRoutePattern = 'blh/analisis-microbiologico';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            // ->add('id')
            ->add('codigoAnalisisMicrobiologico')
            ->add('coliformesTotales')
            ->add('control')
            ->add('situacion')
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
            ->add('codigoAnalisisMicrobiologico')
            ->add('coliformesTotales')
            ->add('control')
            ->add('situacion')
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
            // ->add('idFrascoProcesado', 'sonata_type_model_hidden')
            ->add('idFrascoProcesado', null, array(
                            'label' => false,
                            'label_attr' => array('class' => 'label_form_sm'),
                            // 'required' => true,
                            'required' => false,
                            'expanded' => true,
                            'multiple' => false,
                            'class' => 'MinsalSiblhBundle:BlhFrascoProcesado',
                            // 'query_builder' => function(EntityRepository $er) use ($session_USER_LOCATION, $resultId, $patientId, $rType) {
                            //                         return $er->pendingStudies($session_USER_LOCATION->getId(), $resultId, $patientId, null, $rType);
                            //                     },
                            'group_by' => 'idLoteAnalisis',
                            'attr' => array(
                                    'class' => /*'form-control input-sm'*/ /*'list-inline*/' formstyle-radio-list-inline input-sm',
                                    'data-add-form-group-col-class' => 'col-lg-12 col-md-12 col-sm-12',

                                    'data-fv-notempty' => 'true',
                                    'data-fv-notempty-message' => 'Seleccione un elemento',
                            )
            ))
            // ->add('idFrascoProcesado', null, array(
            //                 'label' => 'Frasco procesado',
            //                 'label_attr' => array('class' => 'label_form_sm'),
            //                 'required' => false,
            //                 'group_by' => 'idPasteurizacion',
            //                 'attr' => array(
            //                         'class' => 'form-control input-sm',
            //                         // 'data-form-inline-group' => 'start',
            //                         // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

            //                         'data-add-input-addon' => 'true',
            //                         // 'data-add-input-addon-class' => 'primary-v4',
            //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',
            //                 )
            // ))
            ->add('codigoAnalisisMicrobiologico', null, array(
                            'label' => 'Código',
                            'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
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
            ->add('coliformesTotales', null, array(
                            'label' => 'Coliformes totales',
                            'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
                            'attr' => array(
                                    'placeholder' => 'coliformes totales...',
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-3 col-md-3 col-sm-3',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart-empty',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '1',
                                    'data-fv-stringlength-max' => '8',
                                    'data-fv-stringlength-message' => '1 caracteres mínimo',

                                    'data-fv-regexp' => 'true',
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_GENERAL___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            ->add('control', null, array(
                            'label' => 'Control',
                            'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
                            'attr' => array(
                                    'placeholder' => 'control...',
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'continue',
                                    'data-add-form-group-col-class' => 'col-lg-3 col-md-3 col-sm-3',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart-empty',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '1',
                                    'data-fv-stringlength-max' => '8',
                                    'data-fv-stringlength-message' => '1 caracteres mínimo',

                                    'data-fv-regexp' => 'true',
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_GENERAL___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            ->add('situacion', null, array(
                            'label' => 'Situación',
                            'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
                            'attr' => array(
                                    'placeholder' => 'situación...',
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-3 col-md-3 col-sm-3',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart-empty',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '1',
                                    'data-fv-stringlength-max' => '9',
                                    'data-fv-stringlength-message' => '1 caracteres mínimo',

                                    'data-fv-regexp' => 'true',
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_GENERAL___,
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
            ->add('codigoAnalisisMicrobiologico')
            ->add('coliformesTotales')
            ->add('control')
            ->add('situacion')
            // ->add('usuario')
            // ->add('fechaHoraReg')
        ;
    }

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            // array('MinsalSiblhBundle:BlhAnalisisMicrobiologicoAdmin:doctrine_orm_form_admin_fields.html.twig'),
            array('MinsalSiblhBundle:BlhAnalisisMicrobiologicoAdmin:form_admin_fields.html.twig')
       );
    }
    
    public function getTemplate($name)
    {
        switch ($name)
        {
            case 'edit':
                return 'MinsalSiblhBundle:BlhAnalisisMicrobiologicoAdmin:base_edit.html.twig';
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