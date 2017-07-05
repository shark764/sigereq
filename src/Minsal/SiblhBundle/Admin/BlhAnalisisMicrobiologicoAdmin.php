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
            ->add('idFrascoProcesado', null, array(
                            'label' => 'Frasco procesado',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => true,
                            'group_by' => 'idPasteurizacion',
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                            )
            ))
            ->add('codigoAnalisisMicrobiologico', null, array(
                            'label' => 'Código',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'código...',
                                    'class' => 'form-control input-sm',
                                    'readonly' => 'readonly',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-barcode',
                            )
            ))
            ->add('coliformesTotales', null, array(
                            'label' => 'Coliformes totales',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'attr' => array(
                                    'placeholder' => 'coliformes totales...',
                                    'class' => 'form-control input-sm',

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
                            'label_attr' => array('class' => 'label_form_sm'),
                            'attr' => array(
                                    'placeholder' => 'control...',
                                    'class' => 'form-control input-sm',

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
                            'label_attr' => array('class' => 'label_form_sm'),
                            'attr' => array(
                                    'placeholder' => 'situación...',
                                    'class' => 'form-control input-sm',

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

}