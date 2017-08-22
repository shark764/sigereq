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

class BlhPasteurizacionAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'siblh_pasteurizacion';
    protected $baseRoutePattern = 'blh/pasteurizacion';

    protected $splitBatchBottlesMode = false;

    public function setSplitBatchBottlesMode($splitBatchBottlesMode = false)
    {
        $this->splitBatchBottlesMode = $splitBatchBottlesMode;
    }

    public function isOnSplitBatchBottlesMode()
    {
        return $this->splitBatchBottlesMode;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
        
        $collection->add('splitBottle', 'dividir-frasco', [], [], ['expose' => true]);
        $collection->add('splitBatchBottles', 'combinar-frascos', [], [], ['expose' => true]);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            // ->add('id')
            ->add('codigoPasteurizacion')
            ->add('numCiclo')
            ->add('volumenPasteurizado')
            ->add('numFrascosPasteurizados')
            ->add('fechaPasteurizacion')
            ->add('responsablePasteurizacion')
            // ->add('usuario')
            ->add('volumenTotal')
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
            ->add('codigoPasteurizacion')
            ->add('numCiclo')
            ->add('volumenPasteurizado')
            ->add('numFrascosPasteurizados')
            ->add('fechaPasteurizacion')
            ->add('responsablePasteurizacion')
            // ->add('usuario')
            ->add('volumenTotal')
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
        if (false !== $this->isOnSplitBatchBottlesMode()) {
            $formMapper
                ->with('Combinación de frascos')
                    ->add('idCurva', 'entity', array(
                                    'label' => 'Curva de pasteurización',
                                    'label_attr' => array('class' => 'label_form_sm'),
                                    'mapped' => false,
                                    'required' => false,
                                    'class' => 'MinsalSiblhBundle:BlhCurva',
                                    // 'query_builder' => function(EntityRepository $er) use ($session_USER_LOCATION) {
                                    //                         return $er->createQueryBuilder('ams')
                                    //                                     ->where('ams.idEstablecimiento = :id_std')
                                    //                                     ->setParameter('id_std', $session_USER_LOCATION->getId())
                                    //                                     ->orderBy('ams.idAreaAtencion', 'asc')
                                    //                                     ->addOrderBy('ams.idModalidadEstab', 'asc')
                                    //                                     ->distinct();
                                    //                     },
                                    'attr' => array(
                                            'class' => 'form-control input-sm',
                                            // 'data-form-inline-group' => 'start',
                                            // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                            'data-add-input-addon' => 'true',
                                            // 'data-add-input-addon-class' => 'primary-v4',
                                            'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',
                                    )
                    ))
                    // ->add('pasteurizacionFrascoProcesado', 'entity', array(
                    //                 'label' => false,
                    //                 'label_attr' => array('class' => 'label_form_sm'),
                    //                 // 'required' => true,
                    //                 'required' => false,
                    //                 'expanded' => true,
                    //                 'multiple' => true,
                    //                 'class' => 'MinsalSiblhBundle:BlhFrascoProcesado',
                    //                 // 'query_builder' => function(EntityRepository $er) use ($session_USER_LOCATION, $__XRAY_CLINICAL_SERVICE_ID__, $filter_modality_) {
                    //                 //                         return $er->createQueryBuilder('pryn')
                    //                 //                                     ->innerJoin('MinsalSiblhBundle:RyxCtlProyeccionEstablecimiento', 'prynhptl',
                    //                 //                                             \Doctrine\ORM\Query\Expr\Join::WITH,
                    //                 //                                             'pryn.id = prynhptl.idProyeccion')
                    //                 //                                     ->innerJoin('prynhptl.idAreaExamenEstab', 'mmxstd')
                    //                 //                                     ->innerJoin('mmxstd.idAreaServicioDiagnostico', 'mdld')
                    //                 //                                     ->where('mdld.idAtencion = :id_atn')
                    //                 //                                     ->setParameter('id_atn', $__XRAY_CLINICAL_SERVICE_ID__)  // --| 97 (Imagenología)
                    //                 //                                     ->andWhere('mmxstd.idEstablecimiento = :id_std')
                    //                 //                                     ->setParameter('id_std', $session_USER_LOCATION->getId())  // --| 97 (Hospital Local)
                    //                 //                                     ->andWhere('mmxstd.idAreaServicioDiagnostico = :id_mdld')
                    //                 //                                     ->setParameter('id_mdld', $filter_modality_)  // --| 97 (Modalidad filtro)
                    //                 //                                     ->andWhere('mmxstd.activo = TRUE')
                    //                 //                                     ->andWhere('prynhptl.habilitado = TRUE')
                    //                 //                                     ->orderBy('pryn.codigo')
                    //                 //                                     ->addOrderBy('pryn.nombre')
                    //                 //                                     ->distinct();
                    //                 //                     },
                    //                 // 'group_by' => 'idPasteurizacion',
                    //                 'help' => '<span class="text-primary-v4">Frascos a combinar para formar nuevo frasco para pasteurización</span>',
                    //                 'attr' => array(
                    //                         'class' => /*'form-control input-sm'*/ 'list-inline formstyle-radio-list-inline input-sm'/* ul-splitted-list'*/,
                    //                         'data-add-form-group-col-class' => 'col-lg-12 col-md-12 col-sm-12',
                    //                         'data-sonata-select2-escape-markup' => 'true',
                    //                         // 'style' => 'max-height: 500px; overflow-y: auto;'
                    //                 )
                    // ))
                    ->add('frascoRecolectadoFrascoProcesadoVolumenAgregado', 'entity', array(
                                    'label' => false,
                                    'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                                    // 'required' => true,
                                    'mapped' => false,
                                    'required' => false,
                                    'expanded' => true,
                                    'multiple' => true,
                                    'class' => 'MinsalSiblhBundle:BlhFrascoRecolectado',
                                    // 'query_builder' => function(EntityRepository $er) use ($session_USER_LOCATION, $__XRAY_CLINICAL_SERVICE_ID__, $filter_modality_) {
                                    //                         return $er->createQueryBuilder('pryn')
                                    //                                     ->innerJoin('MinsalSiblhBundle:RyxCtlProyeccionEstablecimiento', 'prynhptl',
                                    //                                             \Doctrine\ORM\Query\Expr\Join::WITH,
                                    //                                             'pryn.id = prynhptl.idProyeccion')
                                    //                                     ->innerJoin('prynhptl.idAreaExamenEstab', 'mmxstd')
                                    //                                     ->innerJoin('mmxstd.idAreaServicioDiagnostico', 'mdld')
                                    //                                     ->where('mdld.idAtencion = :id_atn')
                                    //                                     ->setParameter('id_atn', $__XRAY_CLINICAL_SERVICE_ID__)  // --| 97 (Imagenología)
                                    //                                     ->andWhere('mmxstd.idEstablecimiento = :id_std')
                                    //                                     ->setParameter('id_std', $session_USER_LOCATION->getId())  // --| 97 (Hospital Local)
                                    //                                     ->andWhere('mmxstd.idAreaServicioDiagnostico = :id_mdld')
                                    //                                     ->setParameter('id_mdld', $filter_modality_)  // --| 97 (Modalidad filtro)
                                    //                                     ->andWhere('mmxstd.activo = TRUE')
                                    //                                     ->andWhere('prynhptl.habilitado = TRUE')
                                    //                                     ->orderBy('pryn.codigo')
                                    //                                     ->addOrderBy('pryn.nombre')
                                    //                                     ->distinct();
                                    //                     },
                                    // 'group_by' => 'idDonacion',
                                    'help' => '<span class="text-primary-v4">Frascos a combinar para formar nuevo frasco para pasteurización</span>',
                                    'attr' => array(
                                            'class' => /*'form-control input-sm'*/ 'list-inline formstyle-radio-list-inline input-sm'/* ul-splitted-list'*/,
                                            'data-add-form-group-col-class' => 'col-lg-12 col-md-12 col-sm-12',
                                            'data-sonata-select2-escape-markup' => 'true',
                                            // 'style' => 'max-height: 500px; overflow-y: auto;'
                                    )
                    ))
                    ->add('pasteurizacionFrascoProcesado', 'sonata_type_collection', array(
                                    'label' => false,
                                    'label_attr' => array('class' => 'label_form_sm'),
                                    'required' => false,
                                    'btn_add' => false,  // --| Prevents the "Add" option from being displayed
                                    'btn_catalogue' => false,  // --| Prevents the "Catalogue" option from being displayed
                                    // 'class' => 'MinsalSiblhBundle:BlhFrascoProcesado',
                                    'attr' => array(
                                            'class' => 'form-control input-sm',
                                            'data-add-form-group-col-class' => 'col-lg-12 col-md-12 col-sm-12',
                                            'data-sonata-select2-escape-markup' => 'true',
                                    ),
                                    'help' => '<span class="text-primary-v4">Frascos resultantes para análisis y pasteurización</span>',
                                    'cascade_validation' => true,
                                    'type_options' => array(
                                        'btn_add' => false, // --| Prevents the "Add" option from being displayed
                                        'btn_delete' => false,  // --| Prevents the "Delete" option from being displayed
                                    )
                            ),
                            array('edit' => 'inline', 'inline' => 'table')
                    )
                ->end()
            ;

        }
        else
        {
            $formMapper
                ->with('Registro de donación')
                    // ->add('id')
                    ->add('idCurva', 'sonata_type_model_hidden')
                    // ->add('idCurva', null, array(
                    //                 'label' => 'Curva de pasteurización',
                    //                 'label_attr' => array('class' => 'label_form_sm'),
                    //                 'required' => true,
                    //                 'attr' => array(
                    //                         'class' => 'form-control input-sm',
                    //                         // 'data-form-inline-group' => 'start',
                    //                         // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                    //                         'data-add-input-addon' => 'true',
                    //                         // 'data-add-input-addon-class' => 'primary-v4',
                    //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-list',
                    //                 )
                    // ))
                    ->add('codigoPasteurizacion', null, array(
                                    'label' => 'Código',
                                    'label_attr' => array('class' => 'label_form_sm col-lg-3 col-md-3 col-sm-3'),
                                    'required' => false,
                                    'attr' => array(
                                            'placeholder' => 'código...',
                                            'class' => 'form-control input-sm',
                                            'readonly' => 'readonly',
                                            'data-form-inline-group' => 'start',
                                            'data-add-form-group-col-class' => 'col-lg-3 col-md-3 col-sm-3',

                                            'data-add-input-addon' => 'true',
                                            'data-add-input-addon-addon' => 'glyphicon glyphicon-barcode',
                                    )
                    ))
                    ->add('fechaPasteurizacion', 'datetime', array(
                                    'label' => 'Fecha de pasteurización',
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
                                            'data-add-form-group-col-class' => 'col-lg-3 col-md-3 col-sm-3',

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
                    ->add('idResponsablePasteurizacion', null, array(
                                    'label' => 'Responsable de pasteurización',
                                    'label_attr' => array('class' => 'label_form_sm col-lg-3 col-md-3 col-sm-3'),
                                    'required' => true,
                                    'attr' => array(
                                            'class' => 'form-control input-sm',
                                            // 'data-form-inline-group' => 'start',
                                            // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                            'data-add-input-addon' => 'true',
                                            // 'data-add-input-addon-class' => 'primary-v4',
                                            'data-add-input-addon-addon' => 'glyphicon glyphicon-user',
                                    )
                    ))
                    // ->add('responsablePasteurizacion', null, array(
                                    // 'label' => 'Responsable de pasteurización',
                    //                 'label_attr' => array('class' => 'label_form_sm'),
                    //                 'attr' => array(
                                            // 'placeholder' => 'responsable de pasteurización...',
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
                    ->add('numCiclo', null, array(
                                    'label' => 'Número de ciclo',
                                    'label_attr' => array('class' => 'label_form_sm col-lg-3 col-md-3 col-sm-3'),
                                    'attr' => array(
                                            'class' => 'form-control input-sm',
                                            'placeholder' => 'número de ciclo...',
                                            // 'readonly' => 'readonly',
                                            // 'data-form-inline-group' => 'start',
                                            'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                            'data-add-input-addon' => 'true',
                                            // 'data-add-input-addon-class' => 'primary-v4',
                                            'data-add-input-addon-addon' => 'glyphicon glyphicon-repeat',

                                            'data-fv-integer' => 'true',
                                            'data-fv-integer-message' => 'El valor no es un entero',

                                            'min' => '0',
                                            'max' => '32767',
                                            'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                                    )
                    ))
                    ->add('volumenPasteurizado', null, array(
                                    'label' => 'Vol. pasteurizado',
                                    'label_attr' => array('class' => 'label_form_sm col-lg-3 col-md-3 col-sm-3'),
                                    'required' => true,
                                    'attr' => array(
                                            'placeholder' => 'vol. pasteurizado...',
                                            'class' => 'form-control input-sm',
                                            // 'readonly' => 'readonly',
                                            'data-form-inline-group' => 'start',
                                            'data-add-form-group-col-class' => 'col-lg-2 col-md-2 col-sm-2',

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
                    ->add('numFrascosPasteurizados', null, array(
                                    'label' => 'fcos. pasteurizados',
                                    'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
                                    'attr' => array(
                                            'class' => 'form-control input-sm',
                                            'placeholder' => 'fcos. pasteurizados...',
                                            'data-form-inline-group' => 'continue',
                                            'data-add-form-group-col-class' => 'col-lg-2 col-md-2 col-sm-2',

                                            'data-add-input-addon' => 'true',
                                            // 'data-add-input-addon-class' => 'primary-v4',
                                            'data-add-input-addon-addon' => 'glyphicon glyphicon-tasks',

                                            'data-fv-integer' => 'true',
                                            'data-fv-integer-message' => 'El valor no es un entero',

                                            'min' => '0',
                                            'max' => '32767',
                                            'data-fv-between-message' => 'Número debe estar entre 0 y 32767',
                                    )
                    ))
                    ->add('volumenTotal', null, array(
                                    'label' => 'Vol. total',
                                    'label_attr' => array('class' => 'label_form_sm col-lg-1 col-md-1 col-sm-1'),
                                    'required' => true,
                                    'attr' => array(
                                            'placeholder' => 'vol. total...',
                                            'class' => 'form-control input-sm',
                                            // 'readonly' => 'readonly',
                                            'data-form-inline-group' => 'stop',
                                            'data-add-form-group-col-class' => 'col-lg-2 col-md-2 col-sm-2',

                                            'data-add-input-addon' => 'true',
                                            'data-add-input-addon-addon' => 'glyphicon glyphicon-tasks',

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
            //     ->end()
            // ;

            // $formMapper
            //     ->with('Selección de frascos pasteurizados')
                    // ->add('pasteurizacionFrascoProcesado', 'sonata_type_collection', array(
                    //                 'label' => false,
                    //                 'label_attr' => array('class' => 'label_form_sm'),
                    //                 'btn_add' => 'Agregar frasco',  // --| Prevents the "Add" option from being displayed
                    //                 // 'btn_catalogue' => false,  // --| Prevents the "Catalogue" option from being displayed
                    //                 'attr' => array(
                    //                         'class' => 'form-control input-sm',
                    //                         'data-add-form-group-col-class' => 'col-lg-12 col-md-12 col-sm-12',
                    //                 ),
                    //                 'cascade_validation' => true,
                    //                 'type_options' => array(
                    //                     // 'btn_add' => false, // --| Prevents the "Add" option from being displayed
                    //                     // 'btn_delete' => false,  // --| Prevents the "Delete" option from being displayed
                    //                 )
                    //         ),
                    //         array('edit' => 'inline', 'inline' => 'table')
                    // )
                    ->add('pasteurizacionFrascoProcesado', 'entity', array(
                                    'label' => false,
                                    'label_attr' => array('class' => 'label_form_sm'),
                                    // 'required' => true,
                                    'required' => false,
                                    'expanded' => true,
                                    'multiple' => true,
                                    'class' => 'MinsalSiblhBundle:BlhFrascoProcesado',
                                    // 'query_builder' => function(EntityRepository $er) use ($session_USER_LOCATION, $__XRAY_CLINICAL_SERVICE_ID__, $filter_modality_) {
                                    //                         return $er->createQueryBuilder('pryn')
                                    //                                     ->innerJoin('MinsalSiblhBundle:RyxCtlProyeccionEstablecimiento', 'prynhptl',
                                    //                                             \Doctrine\ORM\Query\Expr\Join::WITH,
                                    //                                             'pryn.id = prynhptl.idProyeccion')
                                    //                                     ->innerJoin('prynhptl.idAreaExamenEstab', 'mmxstd')
                                    //                                     ->innerJoin('mmxstd.idAreaServicioDiagnostico', 'mdld')
                                    //                                     ->where('mdld.idAtencion = :id_atn')
                                    //                                     ->setParameter('id_atn', $__XRAY_CLINICAL_SERVICE_ID__)  // --| 97 (Imagenología)
                                    //                                     ->andWhere('mmxstd.idEstablecimiento = :id_std')
                                    //                                     ->setParameter('id_std', $session_USER_LOCATION->getId())  // --| 97 (Hospital Local)
                                    //                                     ->andWhere('mmxstd.idAreaServicioDiagnostico = :id_mdld')
                                    //                                     ->setParameter('id_mdld', $filter_modality_)  // --| 97 (Modalidad filtro)
                                    //                                     ->andWhere('mmxstd.activo = TRUE')
                                    //                                     ->andWhere('prynhptl.habilitado = TRUE')
                                    //                                     ->orderBy('pryn.codigo')
                                    //                                     ->addOrderBy('pryn.nombre')
                                    //                                     ->distinct();
                                    //                     },
                                    // 'group_by' => 'idPasteurizacion',
                                    'help' => '<span class="text-primary-v4">Agregue frascos que fueron pasteurizados</span>',
                                    'attr' => array(
                                            'class' => /*'form-control input-sm'*/ 'list-inline formstyle-radio-list-inline input-sm'/* ul-splitted-list'*/,
                                            'data-add-form-group-col-class' => 'col-lg-12 col-md-12 col-sm-12',
                                            'data-sonata-select2-escape-markup' => 'true',
                                            // 'style' => 'max-height: 500px; overflow-y: auto;'
                                    )
                    ))
                ->end()
            ;

            $formMapper
                ->with('Temperatura de pasteurización')
                    ->add('pasteurizacionTemperaturaPasteurizacion', 'sonata_type_collection', array(
                                    'label' => false,
                                    'label_attr' => array('class' => 'label_form_sm'),
                                    'btn_add' => 'Registrar temperatura',  // --| Prevents the "Add" option from being displayed
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
            ;

            $formMapper
                ->with('Temperatura de enfriamiento')
                    ->add('pasteurizacionTemperaturaEnfriamiento', 'sonata_type_collection', array(
                                    'label' => false,
                                    'label_attr' => array('class' => 'label_form_sm'),
                                    'btn_add' => 'Registrar temperatura',  // --| Prevents the "Add" option from being displayed
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
            ;
        }
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            // ->add('id')
            ->add('codigoPasteurizacion')
            ->add('numCiclo')
            ->add('volumenPasteurizado')
            ->add('numFrascosPasteurizados')
            ->add('fechaPasteurizacion')
            ->add('responsablePasteurizacion')
            // ->add('usuario')
            ->add('volumenTotal')
            // ->add('fechaHoraReg')
        ;
    }
    
    public function getTemplate($name)
    {
        switch ($name)
        {
            case 'edit':
                return 'MinsalSiblhBundle:BlhPasteurizacionAdmin:base_edit.html.twig';
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
            // array('MinsalSiblhBundle:BlhPasteurizacionAdmin:doctrine_orm_form_admin_fields.html.twig'),
            array('MinsalSiblhBundle:BlhPasteurizacionAdmin:form_admin_fields.html.twig')
       );
    }

    public function prePersist($entity)
    {
        //////// --| parent behavior
        parent::prePersist($entity);
        ////////

        foreach ($entity->getPasteurizacionFrascoProcesado() as $frP)
        {
            $frP->setIdPasteurizacion($entity);
        }
    }

    public function preUpdate($entity)
    {
        //////// --| parent behavior
        parent::preUpdate($entity);
        ////////

        foreach ($entity->getPasteurizacionFrascoProcesado() as $frP)
        {
            $frP->setIdPasteurizacion($entity);
        }
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
//        return $instance;
//    }

}