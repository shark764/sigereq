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
    protected $baseRouteName    = 'simagd_frasco_procesado';
    protected $baseRoutePattern = 'blh/frasco-procesado';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('codigoFrascoProcesado')
            ->add('volumenFrascoPasteurizado')
            ->add('acidezTotal')
            ->add('kcaloriasTotales')
            ->add('observacionFrascoProcesado')
            ->add('volumenDisponibleFp')
            ->add('usuario')
            ->add('fechaHoraReg')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('codigoFrascoProcesado')
            ->add('volumenFrascoPasteurizado')
            ->add('acidezTotal')
            ->add('kcaloriasTotales')
            ->add('observacionFrascoProcesado')
            ->add('volumenDisponibleFp')
            ->add('usuario')
            ->add('fechaHoraReg')
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
            ->add('id')
            ->add('codigoFrascoProcesado')
            ->add('volumenFrascoPasteurizado')
            ->add('acidezTotal')
            ->add('kcaloriasTotales')
            ->add('observacionFrascoProcesado')
            ->add('volumenDisponibleFp')
            ->add('usuario')
            ->add('fechaHoraReg')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('codigoFrascoProcesado')
            ->add('volumenFrascoPasteurizado')
            ->add('acidezTotal')
            ->add('kcaloriasTotales')
            ->add('observacionFrascoProcesado')
            ->add('volumenDisponibleFp')
            ->add('usuario')
            ->add('fechaHoraReg')
        ;
    }

}