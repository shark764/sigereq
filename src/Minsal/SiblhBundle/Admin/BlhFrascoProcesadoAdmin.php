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

class BlhFrascoProcesadoAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'siblh_frasco_procesado';
    protected $baseRoutePattern = 'blh/frasco-procesado';

    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
        
        $collection->add('splitBottle', 'dividir-frasco', [], [], ['expose' => true]);
        $collection->add('search', 'buscar', [], [], ['expose' => true]);
        $collection->add('searchBy', 'buscar-mas', [], [], ['expose' => true]);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            // ->add('id')
            ->add('codigoFrascoProcesado')
            ->add('volumenFrascoPasteurizado')
            ->add('acidezTotal')
            ->add('kcaloriasTotales')
            ->add('observacionFrascoProcesado')
            ->add('volumenDisponibleFp')
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
            ->add('codigoFrascoProcesado')
            ->add('volumenFrascoPasteurizado')
            ->add('acidezTotal')
            ->add('kcaloriasTotales')
            ->add('observacionFrascoProcesado')
            ->add('volumenDisponibleFp')
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
            // ->with('Selección de Curva de Pasteurización')
            ->with('Combinación de frascos')
                // ->add('id')
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
                                'property' => 'formatoPresentacionEntidad',
                                'attr' => array(
                                        'class' => 'form-control input-sm',
                                        // 'data-form-inline-group' => 'start',
                                        // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',
                                        'data-sonata-select2-escape-markup' => 'true',

                                        'data-add-input-addon' => 'true',
                                        // 'data-add-input-addon-class' => 'primary-v4',
                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',
                                )
                ))
            // ->end()
            // ->with('Combinación de frascos')
                ->add('idPasteurizacion', 'sonata_type_model_hidden')
                // ->add('idPasteurizacion', null, array(
                //                 'label' => 'Pasteurización',
                //                 'label_attr' => array('class' => 'label_form_sm'),
                //                 'required' => false,
                //                 'attr' => array(
                //                         'class' => 'form-control input-sm',
                //                         // 'data-form-inline-group' => 'start',
                //                         // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                //                         'data-add-input-addon' => 'true',
                //                         // 'data-add-input-addon-class' => 'primary-v4',
                //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',
                //                 )
                // ))
                ->add('frascoRecolectadoFrascoProcesadoVolumenAgregado', 'entity', array(
                                'label' => false,
                                'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                                // 'required' => true,
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
                ->add('codigoFrascoProcesado', null, array(
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
                ->add('volumenFrascoPasteurizado', null, array(
                                'label' => 'Vol. frasco pasteurizado (ml)',
                                'label_attr' => array('class' => 'label_form_sm'),
                                'required' => true,
                                'attr' => array(
                                        'placeholder' => 'vol. de frasco pasteurizado (ml)...',
                                        'class' => 'form-control input-sm',
                                        // 'readonly' => 'readonly',
                                        'data-form-inline-group' => 'start',
                                        'data-add-form-group-col-class' => 'col-lg-3 col-md-3 col-sm-3',

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
                ->add('volumenDisponibleFp', null, array(
                                'label' => 'Vol. disponible (ml)',
                                'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                                'required' => true,
                                'attr' => array(
                                        'placeholder' => 'vol. disponible (ml)...',
                                        'class' => 'form-control input-sm',
                                        // 'readonly' => 'readonly',
                                        'data-form-inline-group' => 'stop',
                                        'data-add-form-group-col-class' => 'col-lg-3 col-md-3 col-sm-3',

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
                ->add('acidezTotal', null, array(
                                'label' => 'Acidez total',
                                'label_attr' => array('class' => 'label_form_sm'),
                                'required' => true,
                                'attr' => array(
                                        'placeholder' => 'acidez total...',
                                        'class' => 'form-control input-sm',
                                        // 'readonly' => 'readonly',
                                        'data-form-inline-group' => 'start',
                                        'data-add-form-group-col-class' => 'col-lg-3 col-md-3 col-sm-3',

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
                ->add('kcaloriasTotales', null, array(
                                'label' => 'Total de calorías',
                                'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                                'required' => true,
                                'attr' => array(
                                        'placeholder' => 'total de calorías...',
                                        'class' => 'form-control input-sm',
                                        // 'readonly' => 'readonly',
                                        'data-form-inline-group' => 'stop',
                                        'data-add-form-group-col-class' => 'col-lg-3 col-md-3 col-sm-3',

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
                // ->add('idEstado', null, array(
                //                 'label' => 'Estado',
                //                 'label_attr' => array('class' => 'label_form_sm'),
                //                 'required' => false,
                //                 'attr' => array(
                //                         'class' => 'form-control input-sm',
                //                         // 'data-form-inline-group' => 'start',
                //                         // 'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                //                         'data-add-input-addon' => 'true',
                //                         // 'data-add-input-addon-class' => 'primary-v4',
                //                         'data-add-input-addon-addon' => 'glyphicon glyphicon-pushpin',
                //                 )
                // ))
                ->add('observacionFrascoProcesado', 'textarea', array(
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
                // ->add('usuario')
                // ->add('fechaHoraReg')
            ->end()
            // ->with('Combinar frascos')
            //     ->add('frascoProcesadoFrascoRecolectadoCombinado', 'sonata_type_collection', array(
            //                     'label' => false,
            //                     'label_attr' => array('class' => 'label_form_sm'),
            //                     'btn_add' => 'Agregar frasco recolectado',  // --| Prevents the "Add" option from being displayed
            //                     // 'btn_catalogue' => false,  // --| Prevents the "Catalogue" option from being displayed
            //                     'attr' => array(
            //                             'class' => 'form-control input-sm',
            //                             'data-add-form-group-col-class' => 'col-lg-12 col-md-12 col-sm-12',
            //                     ),
            //                     'cascade_validation' => true,
            //                     'type_options' => array(
            //                         // 'btn_add' => false, // --| Prevents the "Add" option from being displayed
            //                         // 'btn_delete' => false,  // --| Prevents the "Delete" option from being displayed
            //                     )
            //             ),
            //             array('edit' => 'inline', 'inline' => 'table')
            //     )
            // ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            // ->add('id')
            ->add('codigoFrascoProcesado')
            ->add('volumenFrascoPasteurizado')
            ->add('acidezTotal')
            ->add('kcaloriasTotales')
            ->add('observacionFrascoProcesado')
            ->add('volumenDisponibleFp')
            // ->add('usuario')
            // ->add('fechaHoraReg')
        ;
    }
    
    public function getTemplate($name)
    {
        switch ($name)
        {
            case 'edit':
                return 'MinsalSiblhBundle:BlhFrascoProcesadoAdmin:base_edit.html.twig';
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
            // array('MinsalSiblhBundle:BlhFrascoProcesadoAdmin:doctrine_orm_form_admin_fields.html.twig'),
            array('MinsalSiblhBundle:BlhFrascoProcesadoAdmin:form_admin_fields.html.twig')
       );
    }

    public function prePersist($entity)
    {
        //////// --| parent behavior
        parent::prePersist($entity);
        ////////

        // foreach ($entity->getLoteAnalisisFrascoRecolectado() as $subEntity)
        // {
        //     $subEntity->setIdLoteAnalisis($entity);
        // }
    }

    public function preUpdate($entity)
    {
        //////// --| parent behavior
        // parent::preUpdate($entity);
        ////////

        // foreach ($entity->getLoteAnalisisFrascoRecolectado() as $subEntity)
        // {
        //     $subEntity->setIdLoteAnalisis($entity);
        // }
    }

}