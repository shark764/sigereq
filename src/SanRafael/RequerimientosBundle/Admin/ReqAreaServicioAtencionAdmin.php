<?php

namespace SanRafael\RequerimientosBundle\Admin;

//use Sonata\AdminBundle\Admin\Admin;
use SanRafael\RequerimientosBundle\Admin\SanRafaelRequerimientosAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
//use Doctrine\ORM\EntityRepository;
//use Sonata\AdminBundle\Validator\ErrorElement;
//use Sonata\AdminBundle\Route\RouteCollection;

class ReqAreaServicioAtencionAdmin extends SanRafaelRequerimientosAdmin
{
    protected $baseRouteName    = 'sigereq_area_servicio_atencion';
    protected $baseRoutePattern = 'catalogo/area-servicio-atencion';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
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
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
        ;
    }

    // public function prePersist($entity)
    // {
    //     parent::prePersist($entity);
    // }
    
    // public function preUpdate($entity)
    // {
    //     parent::preUpdate($entity);
    // }
    
    public function getNewInstance()
    {
        $instance = parent::getNewInstance();
        
        /*
         * default values
         */
        /*$instance->setIdEstadoEquipo($this->getModelManager()->findOneBy('SanRafaelRequerimientosBundle:ReqCtlEstadoEquipo', array('codigo' => 'FNC')));
        $instance->setIdTipoEquipo($this->getModelManager()->findOneBy('SanRafaelRequerimientosBundle:ReqCtlTipoEquipo', array('codigo' => 'DKT')));
        $instance->setIdModeloEquipo($this->getModelManager()->findOneBy('SanRafaelRequerimientosBundle:ReqCtlModeloEquipo', array('codigo' => 'dlloptx9020')));*/
        
        return $instance;
    }

}