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

class BlhCurvaAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'siblh_curva';
    protected $baseRoutePattern = 'blh/curva';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            // ->add('id')
            ->add('tiempo1')
            ->add('tiempo2')
            ->add('tiempo3')
            ->add('valorCurva')
            ->add('fechaCurva')
            ->add('cantidadFrascos')
            ->add('volumenPorFrasco')
            ->add('horaInicioCurva')
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
            ->add('tiempo1')
            ->add('tiempo2')
            ->add('tiempo3')
            ->add('valorCurva')
            ->add('fechaCurva')
            ->add('cantidadFrascos')
            ->add('volumenPorFrasco')
            ->add('horaInicioCurva')
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
        $formMapper
            // ->add('id')
            ->add('tiempo1')
            ->add('tiempo2')
            ->add('tiempo3')
            ->add('valorCurva')
            ->add('fechaCurva')
            ->add('cantidadFrascos')
            ->add('volumenPorFrasco')
            ->add('horaInicioCurva')
            // ->add('usuario')
            ->add('volumenTotal')
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
            ->add('tiempo1')
            ->add('tiempo2')
            ->add('tiempo3')
            ->add('valorCurva')
            ->add('fechaCurva')
            ->add('cantidadFrascos')
            ->add('volumenPorFrasco')
            ->add('horaInicioCurva')
            // ->add('usuario')
            ->add('volumenTotal')
            // ->add('fechaHoraReg')
        ;
    }

}