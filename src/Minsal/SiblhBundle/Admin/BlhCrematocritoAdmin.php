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

class BlhCrematocritoAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'siblh_crematocrito';
    protected $baseRoutePattern = 'blh/crematocrito';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            // ->add('id')
            ->add('crema1')
            ->add('crema2')
            ->add('crema3')
            ->add('ct1')
            ->add('ct2')
            ->add('ct3')
            ->add('mediaCrema')
            ->add('mediaCt')
            ->add('porcentajeCrema')
            ->add('kilocalorias')
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
            ->add('crema1')
            ->add('crema2')
            ->add('crema3')
            ->add('ct1')
            ->add('ct2')
            ->add('ct3')
            ->add('mediaCrema')
            ->add('mediaCt')
            ->add('porcentajeCrema')
            ->add('kilocalorias')
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
            // ->add('id')
            ->add('crema1')
            ->add('crema2')
            ->add('crema3')
            ->add('ct1')
            ->add('ct2')
            ->add('ct3')
            ->add('mediaCrema')
            ->add('mediaCt')
            ->add('porcentajeCrema')
            ->add('kilocalorias')
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
            ->add('crema1')
            ->add('crema2')
            ->add('crema3')
            ->add('ct1')
            ->add('ct2')
            ->add('ct3')
            ->add('mediaCrema')
            ->add('mediaCt')
            ->add('porcentajeCrema')
            ->add('kilocalorias')
            // ->add('usuario')
            // ->add('fechaHoraReg')
        ;
    }

}