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

class ReqAreaServicioAtencionAdmin extends Admin
{
    protected $baseRouteName    = 'sigereq_area_servicio_atencion';
    protected $baseRoutePattern = 'catalogo/area-servicio-atencion';
    
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
    
    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'SanRafaelRequerimientosBundle:CRUD:base_edit.html.twig';
                break;
            case 'list':
                return 'SanRafaelRequerimientosBundle:CRUD:base_list.html.twig';
                break;
            case 'show':
                return 'SanRafaelRequerimientosBundle:CRUD:base_show.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('SanRafaelRequerimientosBundle:Form:sigereq_form_admin_fields.html.twig'),
            array('SanRafaelRequerimientosBundle:Form:sigereq_doctrine_orm_form_admin_fields.html.twig')
       );
    }

}