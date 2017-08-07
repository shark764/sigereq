<?php

namespace Minsal\SiapsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;

class MntExpedienteAdmin extends Admin
{
    protected $baseRouteName    = 'siblh_expediente';
    protected $baseRoutePattern = 'blh/siap/expediente';

    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);

        $collection->add('search', 'buscar', [], [], ['expose' => true]);
        $collection->add('searchBy', 'buscar-mas', [], [], ['expose' => true]);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('numero')
            ->add('habilitado')
            ->add('fechaCreacion')
            ->add('horaCreacion')
            ->add('numeroTemporal')
            ->add('expedienteFisicoEliminado')
            ->add('cun')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('numero')
            ->add('habilitado')
            ->add('fechaCreacion')
            ->add('horaCreacion')
            ->add('numeroTemporal')
            ->add('expedienteFisicoEliminado')
            ->add('cun')
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
            ->add('numero')
            ->add('habilitado')
            ->add('fechaCreacion')
            ->add('horaCreacion')
            ->add('numeroTemporal')
            ->add('expedienteFisicoEliminado')
            ->add('cun')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('numero')
            ->add('habilitado')
            ->add('fechaCreacion')
            ->add('horaCreacion')
            ->add('numeroTemporal')
            ->add('expedienteFisicoEliminado')
            ->add('cun')
        ;
    }
}
