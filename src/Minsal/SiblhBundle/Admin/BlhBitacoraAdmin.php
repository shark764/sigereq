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

class BlhBitacoraAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_bitacora';
    protected $baseRoutePattern = 'blh/bitacora';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('fechaAccion')
            ->add('codigo')
            ->add('tabla')
            ->add('usuario')
            ->add('fechaHoraReg')
            ->add('accion')
            ->add('detalle')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('fechaAccion')
            ->add('codigo')
            ->add('tabla')
            ->add('usuario')
            ->add('fechaHoraReg')
            ->add('accion')
            ->add('detalle')
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
            ->add('fechaAccion')
            ->add('codigo')
            ->add('tabla')
            ->add('usuario')
            ->add('fechaHoraReg')
            ->add('accion')
            ->add('detalle')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('fechaAccion')
            ->add('codigo')
            ->add('tabla')
            ->add('usuario')
            ->add('fechaHoraReg')
            ->add('accion')
            ->add('detalle')
        ;
    }

}