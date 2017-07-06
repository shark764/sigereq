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

class BlhBancoDeLecheAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'siblh_banco_de_leche';
    protected $baseRoutePattern = 'blh/banco-de-leche';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            // ->add('id')
            ->add('codigoBancoDeLeche')
            ->add('estadoBanco')
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
            ->add('codigoBancoDeLeche')
            ->add('estadoBanco')
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
            ->add('codigoBancoDeLeche', null, array(
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
            ->add('estadoBanco', null, array(
                            'label' => 'Estado',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'estado...',
                                    'class' => 'form-control input-sm',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-home',
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
            ->add('codigoBancoDeLeche')
            ->add('estadoBanco')
            // ->add('usuario')
            // ->add('fechaHoraReg')
        ;
    }

}