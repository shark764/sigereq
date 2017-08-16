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

class BlhGrupoSolicitudAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'siblh_grupo_solicitud';
    protected $baseRoutePattern = 'blh/grupo-solicitud';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            // ->add('id')
            ->add('codigoGrupoSolicitud')
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
            ->add('codigoGrupoSolicitud')
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
                ->add('codigoGrupoSolicitud', null, array(
                                'label' => 'Código',
                                'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                                'required' => false,
                                'attr' => array(
                                        'placeholder' => 'código...',
                                        'class' => 'form-control input-sm',
                                        'readonly' => 'readonly',
                                        // 'data-form-inline-group' => 'start',
                                        'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                        'data-add-input-addon' => 'true',
                                        'data-add-input-addon-addon' => 'glyphicon glyphicon-barcode',
                                )
                ))
                // ->add('usuario')
                // ->add('fechaHoraReg')
                ->add('grupoSolicitudes', 'entity', array(
                                'label' => false,
                                'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                                // 'required' => true,
                                'required' => false,
                                'expanded' => true,
                                'multiple' => true,
                                'class' => 'MinsalSiblhBundle:BlhSolicitud',
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
                                // 'group_by' => 'idAcidezNecesaria',
                                'help' => '<span class="text-primary-v4">Solicitudes deben agruparse para realizar despacho</span>',
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
            ->add('codigoGrupoSolicitud')
            // ->add('usuario')
            // ->add('fechaHoraReg')
        ;
    }
    
    public function getTemplate($name)
    {
        switch ($name)
        {
            case 'edit':
                return 'MinsalSiblhBundle:BlhGrupoSolicitudAdmin:base_edit.html.twig';
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
            // array('MinsalSiblhBundle:BlhGrupoSolicitudAdmin:doctrine_orm_form_admin_fields.html.twig'),
            array('MinsalSiblhBundle:BlhGrupoSolicitudAdmin:form_admin_fields.html.twig')
       );
    }

    public function prePersist($entity)
    {
        //////// --| parent behavior
        parent::prePersist($entity);
        ////////

        foreach ($entity->getGrupoSolicitudes() as $rq)
        {
            $rq->setIdGrupoSolicitud($entity);
        }
    }

    public function preUpdate($entity)
    {
        //////// --| parent behavior
        parent::preUpdate($entity);
        ////////

        foreach ($entity->getGrupoSolicitudes() as $rq)
        {
            $rq->setIdGrupoSolicitud($entity);
        }
    }

}