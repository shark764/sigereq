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

class BlhLoteAnalisisAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'siblh_lote_analisis';
    protected $baseRoutePattern = 'blh/lote-analisis';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            // ->add('id')
            ->add('codigoLoteAnalisis')
            ->add('fechaAnalisisFisicoQuimico')
            ->add('responsableAnalisis')
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
            ->add('codigoLoteAnalisis')
            ->add('fechaAnalisisFisicoQuimico')
            ->add('responsableAnalisis')
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
            ->with('Nuevo lote')
                // ->add('id')
                ->add('codigoLoteAnalisis', null, array(
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
                ->add('fechaAnalisisFisicoQuimico', 'datetime', array(
                                'label' => 'Fecha de análisis Físico-Químico',
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
                // ->add('responsableAnalisis')
                ->add('idResponsableAnalisis', null, array(
                                'label' => 'Responsable de análisis',
                                'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                                'required' => false,
                                'attr' => array(
                                        'class' => 'form-control input-sm',
                                        // 'data-form-inline-group' => 'start',
                                        'data-add-form-group-col-class' => 'col-lg-6 col-md-6 col-sm-6',

                                        'data-add-input-addon' => 'true',
                                        // 'data-add-input-addon-class' => 'primary-v4',
                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-user',
                                )
                ))
                // ->add('usuario')
                // ->add('fechaHoraReg')
                ->add('loteAnalisisFrascoRecolectado', 'entity', array(
                                'label' => false,
                                'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                                'required' => true,
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
                                'group_by' => 'idDonacion',
                                'help' => '<span class="text-primary-v4">Complete el lote para iniciar el análisis</span>',
                                'attr' => array(
                                        'class' => /*'form-control input-sm'*/ 'list-inline formstyle-radio-list-inline input-sm'/* ul-splitted-list'*/,
                                        'data-add-form-group-col-class' => 'col-lg-12 col-md-12 col-sm-12',
                                        'data-sonata-select2-escape-markup' => 'true',
                                        // 'style' => 'max-height: 500px; overflow-y: auto;'
                                )
                ))
            ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            // ->add('id')
            ->add('codigoLoteAnalisis')
            ->add('fechaAnalisisFisicoQuimico')
            ->add('responsableAnalisis')
            // ->add('usuario')
            // ->add('fechaHoraReg')
        ;
    }
    
    public function getTemplate($name)
    {
        switch ($name)
        {
            case 'edit':
                return 'MinsalSiblhBundle:BlhLoteAnalisisAdmin:base_edit.html.twig';
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
            // array('MinsalSiblhBundle:BlhLoteAnalisisAdmin:doctrine_orm_form_admin_fields.html.twig'),
            array('MinsalSiblhBundle:BlhLoteAnalisisAdmin:form_admin_fields.html.twig')
       );
    }

    public function prePersist($entity)
    {
        //////// --| parent behavior
        parent::prePersist($entity);
        ////////

        foreach ($entity->getLoteAnalisisFrascoRecolectado() as $subEntity)
        {
            $subEntity->setIdLoteAnalisis($entity);
        }
    }

    public function preUpdate($entity)
    {
        //////// --| parent behavior
        parent::preUpdate($entity);
        ////////

        foreach ($entity->getLoteAnalisisFrascoRecolectado() as $subEntity)
        {
            $subEntity->setIdLoteAnalisis($entity);
        }
    }

}