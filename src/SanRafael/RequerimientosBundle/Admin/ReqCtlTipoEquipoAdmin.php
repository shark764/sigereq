<?php

namespace SanRafael\RequerimientosBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;

class ReqCtlTipoEquipoAdmin extends Admin
{
    protected $baseRouteName    = 'sigereq_tipo_equipo';
    protected $baseRoutePattern = 'catalogo/tipo-equipo';
    
    protected function configureRoutes(RouteCollection $collection)
    {
        // $collection->remove('delete');
        $collection->add('create', 'crear');
        $collection->add('edit', 'editar');
        $collection->add('list', 'listar');
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('nombre')
            ->add('codigo')
            ->add('caracteristicas')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('nombre')
            ->add('codigo')
            ->add('caracteristicas')
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
            ->add('nombre')
            ->add('codigo')
            ->add('caracteristicas')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('nombre')
            ->add('codigo')
            ->add('caracteristicas')
        ;
    }
}