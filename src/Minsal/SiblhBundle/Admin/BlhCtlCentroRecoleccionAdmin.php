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

class BlhCtlCentroRecoleccionAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'siblh_centro_recoleccion';
    protected $baseRoutePattern = 'blh/centro-recoleccion';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            // ->add('id')
            ->add('nombre')
            ->add('telefono')
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
            ->add('nombre')
            ->add('telefono')
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
            ->add('nombre', null, array(
                            'label' => 'Nombre',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'nombre...',
                                    'class' => 'form-control input-sm',
                                    // 'readonly' => 'readonly',
                                    // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-home',
                            )
            ))
            ->add('codigo', null, array(
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
            ->add('telefono', null, array(
                            'label' => 'Teléfono',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'teléfono...',
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-earphone',
                            )
            ))
            ->add('direccion', 'textarea', array(
                            'label' => 'Dirección / Domicilio',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'rows' => '2',
                                    'style' => 'resize:none',
                                    'placeholder' => 'domicilio...',
                                    'class' => 'form-control input-sm',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '5',
                                    'data-fv-stringlength-message' => '5 caracteres mínimo',

                                    'data-fv-regexp' => 'true',
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_EXTENDED___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            ->add('idEstablecimiento', null, array(
                            'label' => 'Establecimiento',
                            'required' => true,
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
            ->add('idBancoDeLeche', null, array(
                            'label' => 'Banco de Leche',
                            'label_attr' => array('class' => 'label_form_sm'),
                            // 'required' => true,
                            // 'group_by' => 'idEstablecimiento',
                            'attr' => array(
                                    'class' => 'form-control input-sm',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-home',
                            )
            ))
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
            ->add('nombre')
            ->add('telefono')
            // ->add('fechaHoraReg')
        ;
    }

}