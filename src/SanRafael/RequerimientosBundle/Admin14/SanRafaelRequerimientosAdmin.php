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

class SanRafaelRequerimientosAdmin extends Admin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        // $collection->remove('delete');
        $collection->add('create', 'crear');
        $collection->add('edit', 'editar');
        $collection->add('list', 'listar');
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
            /*array('SanRafaelRequerimientosBundle:CRUD:base_edit_form.html.twig'),
            array('SanRafaelRequerimientosBundle:CRUD:base_edit_form_macro.html.twig'),*/
            array('SanRafaelRequerimientosBundle:Form:sigereq_form_admin_fields.html.twig'),
            array('SanRafaelRequerimientosBundle:Form:sigereq_doctrine_orm_form_admin_fields.html.twig')
       );
    }

    public function prePersist($entity)
    {
        $securityContext    = $this->getConfigurationPool()->getContainer()->get('security.context');
        $sessionUser    = $securityContext->getToken()->getUser();
        /*$userLocation   = $sessionUser->getIdEstablecimiento();*/

        $entity->setIdUserReg($sessionUser);
        $entity->setFechaHoraReg(new \DateTime('now'));
    }
    
    public function preUpdate($entity)
    {
        $securityContext    = $this->getConfigurationPool()->getContainer()->get('security.context');
        $sessionUser    = $securityContext->getToken()->getUser();
        /*$userLocation   = $sessionUser->getIdEstablecimiento();*/

        $entity->setIdUserMod($sessionUser);
        $entity->setFechaHoraMod(new \DateTime('now'));
    }

}