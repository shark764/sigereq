<?php

namespace Minsal\SiblhBundle\Admin;

// use Sonata\AdminBundle\Admin\Admin;
use Minsal\SiblhBundle\Admin\MinsalSiblhBundleGeneralAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;

class BlhDonacionAdmin extends MinsalSiblhBundleGeneralAdmin/*Admin*/
{
    protected $baseRouteName    = 'siblh_donacion';
    protected $baseRoutePattern = 'blh/donacion';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            // ->add('id')
            ->add('codigoDonante')
            ->add('fechaDonacion')
            ->add('responsableDonacion')
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
            ->add('codigoDonante')
            ->add('fechaDonacion')
            ->add('responsableDonacion')
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
            ->with('Registro de donación')
            // ->add('id')
                ->add('idBancoDeLeche', 'sonata_type_model_hidden')
                ->add('idCentroRecoleccion', 'sonata_type_model_hidden')
                ->add('idDonante', 'sonata_type_model_hidden')
                // ->add('codigoDonante', null, array(
                //                 'label' => 'Código',
                //                 'label_attr' => array('class' => 'label_form_sm'),
                //                 'required' => false,
                //                 'attr' => array(
                //                         'placeholder' => 'código...',
                //                         'class' => 'form-control input-sm',
                //                         'readonly' => 'readonly',
                //                         'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                //                         'data-add-input-addon' => 'true',
                //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-barcode',
                //                 )
                // ))
                ->add('codigo', null, array(
                                'label' => 'Código',
                                'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                                'required' => false,
                                'attr' => array(
                                        'placeholder' => 'código...',
                                        'class' => 'form-control input-sm',
                                        'readonly' => 'readonly',
                                        'data-form-inline-group' => 'start',
                                        'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                        'data-add-input-addon' => 'true',
                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-barcode',
                                )
                ))
                // ->add('idBancoDeLeche', null, array(
                //                 'label' => 'Banco de Leche',
                //                 'label_attr' => array('class' => 'label_form_sm'),
                //                 // 'required' => true,
                //                 // 'group_by' => 'idEstablecimiento',
                //                 'attr' => array(
                //                         'class' => 'form-control input-sm',

                //                         'data-add-input-addon' => 'true',
                //                         // 'data-add-input-addon-class' => 'primary-v4',
                //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-home',
                //                 )
                // ))
                // ->add('idCentroRecoleccion', null, array(
                //                 'label' => 'Centro de recolección',
                //                 'label_attr' => array('class' => 'label_form_sm'),
                //                 // 'required' => true,
                //                 'group_by' => 'idBancoDeLeche',
                //                 'attr' => array(
                //                         'class' => 'form-control input-sm',

                //                         'data-add-input-addon' => 'true',
                //                         // 'data-add-input-addon-class' => 'primary-v4',
                //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-home',
                //                 )
                // ))
                ->add('fechaDonacion', 'datetime', array(
                                'label' => 'Fecha de donación',
                                'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                                'required' => false,
                                'widget' => 'single_text',
                                'format' => 'dd/MM/yyyy',
                                'attr' => array(
                                        // 'readonly' => 'readonly',
                                        'placeholder' => 'DD/MM/YYYY',
                                        'class' => 'form-control input-sm',
                                        'data-input-transform' => 'datetimepicker',
                                        'data-datetimepicker-type' => 'date',
                                        'data-form-inline-group' => 'stop',
                                        'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                        'data-add-input-addon' => 'true',
                                        // 'data-add-input-addon-class' => 'primary-v4',
                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-time',

                                        // 'data-add-input-btn' => 'true',
                                        // 'data-add-input-btn-class' => 'display-datetimepicker',
                                        // 'data-add-input-btn-btn-class' => 'btn-sm btn-xray-awesome-blue background-opacity display-datetimepicker',
                                        // 'data-add-input-btn-addon' => 'glyphicon glyphicon-time',

                                        'data-fv-date' => 'true',
                                        'data-fv-date-format' => 'DD/MM/YYYY',
                                        'data-fv-date-message' => 'No es una fecha válida',
                                )
                ))
                ->add('idTipoColecta', null, array(
                                'label' => 'Tipo de colecta',
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
                ->add('idTipoLecheMaterna', null, array(
                                'label' => 'Tipo de leche donada',
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
                ->add('idResponsableDonacion', null, array(
                                'label' => 'Responsable de donación',
                                'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                                'required' => true,
                                'attr' => array(
                                        'class' => 'form-control input-sm',
                                        // 'data-form-inline-group' => 'start',
                                        'data-add-form-group-col-class' => 'col-lg-6 col-md-6 col-sm-6',

                                        'data-add-input-addon' => 'true',
                                        // 'data-add-input-addon-class' => 'primary-v4',
                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-user',
                                )
                ))
                // ->add('responsableDonacion', null, array(
                //                 'label' => 'Responsable de donación',
                //                 'label_attr' => array('class' => 'label_form_sm'),
                //                 'attr' => array(
                //                         'placeholder' => 'responsable de donación...',
                //                         'class' => 'form-control input-sm',

                //                         'data-add-input-addon' => 'true',
                //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-user',

                //                         'data-fv-stringlength' => 'true',
                //                         'data-fv-stringlength-min' => '1',
                //                         'data-fv-stringlength-max' => '60',
                //                         'data-fv-stringlength-message' => '1 caracteres mínimo',

                //                         'data-fv-regexp' => 'true',
                //                         'data-fv-regexp-regexp' => self::___CLASS_REGEX_GENERAL___,
                //                         'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                //                 )
                // ))
            ->end()
        ;

        $formMapper
            ->with('Frascos recolectados')
                ->add('donacionFrascoRecolectado', 'sonata_type_collection', array(
                                'label' => false,
                                'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                                'btn_add' => 'Agregar frasco',  // --| Prevents the "Add" option from being displayed
                                // 'btn_catalogue' => false,  // --| Prevents the "Catalogue" option from being displayed
                                'attr' => array(
                                        'class' => 'form-control input-sm',
                                        'data-add-form-group-col-class' => 'col-lg-12 col-md-12 col-sm-12',
                                ),
                                'cascade_validation' => true,
                                'type_options' => array(
                                    // 'btn_add' => false, // --| Prevents the "Add" option from being displayed
                                    // 'btn_delete' => false,  // --| Prevents the "Delete" option from being displayed
                                )
                        ),
                        array('edit' => 'inline', 'inline' => 'table')
                )
            ->end()
            // ->add('usuario')
            // ->add('fechaHoraReg')
            ->with('Agregar donación a frasco existente')
                ->add('donacionFrascoRecolectadoMezcla', 'sonata_type_collection', array(
                                'label' => false,
                                'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                                'btn_add' => 'Mezclar con frasco',  // --| Prevents the "Add" option from being displayed
                                // 'btn_catalogue' => false,  // --| Prevents the "Catalogue" option from being displayed
                                'attr' => array(
                                        'class' => 'form-control input-sm',
                                        'data-add-form-group-col-class' => 'col-lg-12 col-md-12 col-sm-12',
                                ),
                                'cascade_validation' => true,
                                'type_options' => array(
                                    // 'btn_add' => false, // --| Prevents the "Add" option from being displayed
                                    // 'btn_delete' => false,  // --| Prevents the "Delete" option from being displayed
                                )
                        ),
                        array('edit' => 'inline', 'inline' => 'table')
                )
            ->end()
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
            ->add('codigoDonante')
            ->add('fechaDonacion')
            ->add('responsableDonacion')
            // ->add('usuario')
            // ->add('fechaHoraReg')
        ;
    }
    
    public function getTemplate($name)
    {
        switch ($name)
        {
            case 'edit':
                return 'MinsalSiblhBundle:BlhDonacionAdmin:base_edit.html.twig';
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

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('MinsalSiblhBundle:BlhDonacionAdmin:doctrine_orm_form_admin_fields.html.twig')
       );
    }

    public function prePersist($entity)
    {
        //////// --| parent behavior
        parent::prePersist($entity);
        ////////

        foreach ($entity->getDonacionFrascoRecolectado() as $fR)
        {
            $fR->setIdDonante($entity->getIdDonante());
            $fR->setIdBancoDeLeche($entity->getIdBancoDeLeche());
            $fR->setIdCentroRecoleccion($entity->getIdCentroRecoleccion());
            $fR->setIdDonacion($entity);
        }
        foreach ($entity->getDonacionFrascoRecolectadoMezcla() as $fR)
        {
            $fR->setIdDonacion($entity);
        }
    }
    
    public function preUpdate($entity)
    {
        //////// --| parent behavior
        // parent::preUpdate($entity);
        ////////

        foreach ($entity->getDonacionFrascoRecolectado() as $fR)
        {
            $fR->setIdDonante($entity->getIdDonante());
            $fR->setIdBancoDeLeche($entity->getIdBancoDeLeche());
            $fR->setIdCentroRecoleccion($entity->getIdCentroRecoleccion());
            $fR->setIdDonacion($entity);
        }
        foreach ($entity->getDonacionFrascoRecolectadoMezcla() as $fR)
        {
            $fR->setIdDonacion($entity);
        }
    }
    
    public function getNewInstance()
    {
        $instance = parent::getNewInstance();

        $instance->setIdBancoDeLeche($this->___session_system_USER_LOGGED_MILK_BANK___);
        $instance->setIdCentroRecoleccion($this->___session_system_USER_LOGGED_COLLECTION_CENTER___);
        $instance->setIdResponsableDonacion($this->___session_system_USER_LOGGED_EMPLOYEE___);
        $instance->setIdTipoColecta($this->getModelManager()->findOneBy('MinsalSiblhBundle:BlhCtlTipoColecta', array('codigo' => 'BLH')));
        $instance->setIdTipoLecheMaterna($this->getModelManager()->findOneBy('MinsalSiblhBundle:BlhCtlTipoLecheMaterna', array('codigo' => 'LCL')));
        
        return $instance;
    }

}