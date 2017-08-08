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

class BlhDonacionFrascoRecolectadoAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'siblh_donacion_frasco_recolectado_mezcla';
    protected $baseRoutePattern = 'blh/donacion-frasco-recolectado-mezcla';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            // ->add('id')
            ->add('volumenAgregado')
            ->add('volumenRealAgregado')
            ->add('fechaMezcla')
            ->add('observacion')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            // ->add('id')
            ->add('volumenAgregado')
            ->add('volumenRealAgregado')
            ->add('fechaMezcla')
            ->add('observacion')
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
            //                 'label' => 'Alimentar frasco',
            //                 'label_attr' => array('class' => 'label_form_sm'),
            //                 // 'mapped' => false,
            //                 'required' => true,
            //                 // 'class' => 'MinsalSiblhBundle:BlhFrascoRecolectado',
            //                 // 'query_builder' => function(EntityRepository $er) use ($session_USER_LOCATION) {
            //                 //                         return $er->createQueryBuilder('ams')
            //                 //                                     ->where('ams.idEstablecimiento = :id_std')
            //                 //                                     ->setParameter('id_std', $session_USER_LOCATION->getId())
            //                 //                                     ->orderBy('ams.idAreaAtencion', 'asc')
            //                 //                                     ->addOrderBy('ams.idModalidadEstab', 'asc')
            //                 //                                     ->distinct();
            //                 //                     },
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
            ->add('volumenAgregado', null, array(
                            'label' => 'Vol. agregado (ml)',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'vol. agregado (ml)...',
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'start',
                                    // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    // 'min' => '2.27',
                                    // 'max' => '226.80',
                                    // 'data-fv-between-message' => 'Peso en Kg debe ser entre 2.27Kg y 226.80Kg',
                            )
            ))
            ->add('onzRecolectado', 'number', array(
                            'label' => 'Vol. agregado (oz)',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'mapped' => false,
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'vol. agregado (oz)...',
                                    'class' => 'form-control input-sm',
                                    'readonly' => 'readonly',
                                    // 'data-form-inline-group' => 'start',
                                    // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    // 'min' => '2.27',
                                    // 'max' => '226.80',
                                    // 'data-fv-between-message' => 'Peso en Kg debe ser entre 2.27Kg y 226.80Kg',
                            )
            ))
            ->add('volumenRealAgregado', null, array(
                            'label' => 'Vol. real agregado (ml)',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'vol. real agregado (ml)...',
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'start',
                                    // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',

                                    'data-fv-numeric' => 'true',
                                    'data-fv-numeric-message' => 'El valor no es un número válido',
                                    'data-fv-numeric-thousandsSeparator' => '',
                                    'data-fv-numeric-decimalSeparator' => '.',

                                    // 'min' => '2.27',
                                    // 'max' => '226.80',
                                    // 'data-fv-between-message' => 'Peso en Kg debe ser entre 2.27Kg y 226.80Kg',
                            )
            ))
            ->add('observacion', 'textarea', array(
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
            // ->add('fechaMezcla')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            // ->add('id')
            ->add('volumenAgregado')
            ->add('volumenRealAgregado')
            ->add('fechaMezcla')
            ->add('observacion')
        ;
    }
    
    public function prePersist($entity)
    {
        // parent::prePersist($entity);
    }
    
    public function preUpdate($entity)
    {
        // parent::preUpdate($entity);
    }

    /**
     * {@inheritdoc}
     */
    public function getNewInstance()
    {
        $object = $this->getModelManager()->getModelInstance($this->getClass());
        foreach ($this->getExtensions() as $extension)
        {
            $extension->alterNewInstance($this, $object);
        }

        return $object;
    }

}