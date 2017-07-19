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

class BlhFrascoRecolectadoAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'siblh_frasco_recolectado';
    protected $baseRoutePattern = 'blh/frasco-recolectado';

    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
        
        $collection->add('getForSensoryAnalysis', 'analisis-sensorial', [], [], ['expose' => true]);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            // ->add('id')
            ->add('codigoFrascoRecolectado')
            ->add('volumenRecolectado')
            ->add('formaExtraccion')
            ->add('onzRecolectado')
            ->add('observacionFrascoRecolectado')
            ->add('volumenDisponibleFr')
            // ->add('usuario')
            ->add('volumenReal')
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
            ->add('codigoFrascoRecolectado')
            ->add('volumenRecolectado')
            ->add('formaExtraccion')
            ->add('onzRecolectado')
            ->add('observacionFrascoRecolectado')
            ->add('volumenDisponibleFr')
            // ->add('usuario')
            ->add('volumenReal')
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
            ->add('idFrascoRecolectado', 'sonata_type_model_hidden', array(
                            'label' => 'Alimentar frasco',
                            // 'label_attr' => array('class' => 'label_form_sm'),
                            'mapped' => false,
                            // 'required' => false,
                            'class' => 'MinsalSiblhBundle:BlhFrascoRecolectado',
                            // 'query_builder' => function(EntityRepository $er) use ($session_USER_LOCATION) {
                            //                         return $er->createQueryBuilder('ams')
                            //                                     ->where('ams.idEstablecimiento = :id_std')
                            //                                     ->setParameter('id_std', $session_USER_LOCATION->getId())
                            //                                     ->orderBy('ams.idAreaAtencion', 'asc')
                            //                                     ->addOrderBy('ams.idModalidadEstab', 'asc')
                            //                                     ->distinct();
                            //                     },
                            // 'group_by' => 'idLoteAnalisis',
                            // 'attr' => array(
                            //         'class' => 'form-control input-sm',
                            //         // 'data-form-inline-group' => 'start',
                            //         // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                            //         'data-add-input-addon' => 'true',
                            //         // 'data-add-input-addon-class' => 'primary-v4',
                            //         'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',
                            // )
            ))
            ->add('codigoFrascoRecolectado', null, array(
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
            // ->add('formaExtraccion', null, array(
            //                 'label' => 'Forma de extracción',
            //                 'label_attr' => array('class' => 'label_form_sm'),
            //                 'attr' => array(
            //                         'placeholder' => 'forma de extracción...',
            //                         'class' => 'form-control input-sm',

            //                         'data-add-input-addon' => 'true',
            //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-user',

            //                         'data-fv-stringlength' => 'true',
            //                         'data-fv-stringlength-min' => '1',
            //                         'data-fv-stringlength-max' => '8',
            //                         'data-fv-stringlength-message' => '1 caracteres mínimo',

            //                         'data-fv-regexp' => 'true',
            //                         'data-fv-regexp-regexp' => self::___CLASS_REGEX_GENERAL___,
            //                         'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
            //                 )
            // ))
            ->add('idFormaExtraccion', null, array(
                            'label' => 'Forma de extracción',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => true,
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'start',
                                    // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',
                            )
            ))
            ->add('volumenRecolectado', null, array(
                            'label' => 'Vol. recolectado (ml)',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'vol. recolectado (ml)...',
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'start',
                                    // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart-empty',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    // 'min' => '2.27',
                                    // 'max' => '226.80',
                                    // 'data-fv-between-message' => 'Peso en Kg debe ser entre 2.27Kg y 226.80Kg',
                            )
            ))
            ->add('onzRecolectado', null, array(
                            'label' => 'Vol. recolectado (oz)',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'vol. recolectado (oz)...',
                                    'class' => 'form-control input-sm',
                                    'readonly' => 'readonly',
                                    // 'data-form-inline-group' => 'start',
                                    // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart-empty',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    // 'min' => '2.27',
                                    // 'max' => '226.80',
                                    // 'data-fv-between-message' => 'Peso en Kg debe ser entre 2.27Kg y 226.80Kg',
                            )
            ))
//            ->add('volumenDisponibleFr', null, array(
//                            'label' => 'Vol. disponible en frasco',
//                            'label_attr' => array('class' => 'label_form_sm'),
//                            'required' => false,
//                            'attr' => array(
//                                    'placeholder' => 'vol. disponible en frasco...',
//                                    'class' => 'form-control input-sm',
//                                    // 'data-form-inline-group' => 'start',
//                                    // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',
//
//                                    'data-add-input-addon' => 'true',
//                                    // 'data-add-input-addon-class' => 'primary-v4',
//                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart-empty',
//
//                                    'data-fv-numeric' => 'true',
//                                    'data-fv-numeric-message' => 'El valor no es un número válido',
//                                    'data-fv-numeric-thousandsSeparator' => '',
//                                    'data-fv-numeric-decimalSeparator' => '.',
//
//                                    // 'min' => '2.27',
//                                    // 'max' => '226.80',
//                                    // 'data-fv-between-message' => 'Peso en Kg debe ser entre 2.27Kg y 226.80Kg',
//                            )
//            ))
            // ->add('usuario')
//            ->add('volumenReal', null, array(
//                            'label' => 'Vol. real',
//                            'label_attr' => array('class' => 'label_form_sm'),
//                            'required' => false,
//                            'attr' => array(
//                                    'placeholder' => 'vol. real...',
//                                    'class' => 'form-control input-sm',
//                                    // 'data-form-inline-group' => 'start',
//                                    // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',
//
//                                    'data-add-input-addon' => 'true',
//                                    // 'data-add-input-addon-class' => 'primary-v4',
//                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-heart-empty',
//
//                                    'data-fv-numeric' => 'true',
//                                    'data-fv-numeric-message' => 'El valor no es un número válido',
//                                    'data-fv-numeric-thousandsSeparator' => '',
//                                    'data-fv-numeric-decimalSeparator' => '.',
//
//                                    // 'min' => '2.27',
//                                    // 'max' => '226.80',
//                                    // 'data-fv-between-message' => 'Peso en Kg debe ser entre 2.27Kg y 226.80Kg',
//                            )
//            ))
            ->add('observacionFrascoRecolectado', 'textarea', array(
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
            ->add('codigoFrascoRecolectado')
            ->add('volumenRecolectado')
            ->add('formaExtraccion')
            ->add('onzRecolectado')
            ->add('observacionFrascoRecolectado')
            ->add('volumenDisponibleFr')
            // ->add('usuario')
            ->add('volumenReal')
            // ->add('fechaHoraReg')
        ;
    }
    
//    public function getNewInstance()
//    {
//        $instance = parent::getNewInstance();
//
////        $container = $this->getConfigurationPool()->getContainer();
////        $doctrine = $container->get('doctrine');
////
////        $securityContext = $container->get('security.context');
//
////        $instance->setIdCurva($this->getModelManager()->find('MinsalSiblhBundle:BlhCurva', 1));
//
//        //////// --| builder entity
////        $ENTITY_LOGIC_ = new RyxCtlConexionPacsEstablecimientoLogic($container, $instance);
////        $ENTITY_LOGIC_->builderEntity();
//        //////// --|
//
//        $instance->setIdFormaExtraccion($this->getModelManager()->findOneBy('MinsalSiblhBundle:BlhCtlFormaExtraccion', array('codigo' => 'MCN')));
//        
//        return $instance;
//    }

}