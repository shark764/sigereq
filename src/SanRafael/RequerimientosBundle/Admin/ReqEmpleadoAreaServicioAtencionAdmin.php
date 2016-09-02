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

class ReqEmpleadoAreaServicioAtencionAdmin extends SanRafaelRequerimientosAdmin
{
    protected $baseRouteName    = 'sigereq_empleado_area_servicio_atencion';
    protected $baseRoutePattern = 'catalogo/empleado-servicio-atencion';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('habilitado')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('habilitado')
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
            ->add('habilitado')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('habilitado')
        ;
    }

    public function prePersist($entity)
    {
        /*if ($entity->getCodigo())
        {
            $entity->setCodigo(strtoupper($entity->getCodigo()));
        }*/
    }
    
    public function preUpdate($entity)
    {
        /*if ($entity->getCodigo())
        {
            $entity->setCodigo(strtoupper($entity->getCodigo()));
        }*/
    }
    
    public function getNewInstance()
    {
        $instance   = parent::getNewInstance();
        
        /*
         * default values
         */
        /*$instance->setIdSolucionPadre($this->getModelManager()->findOneBy('SanRafaelRequerimientosBundle:ReqCtlSolucionRequerimiento', array('codigo' => 'FNC')));*/
        
        return $instance;
    }

}