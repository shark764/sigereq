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

class BlhPasteurizacionAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_pasteurizacion';
    protected $baseRoutePattern = 'blh/pasteurizacion';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('codigoPasteurizacion')
            ->add('numCiclo')
            ->add('volumenPasteurizado')
            ->add('numFrascosPasteurizados')
            ->add('fechaPasteurizacion')
            ->add('responsablePasteurizacion')
            ->add('usuario')
            ->add('fechaHoraReg')
            ->add('volumenTotal')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('codigoPasteurizacion')
            ->add('numCiclo')
            ->add('volumenPasteurizado')
            ->add('numFrascosPasteurizados')
            ->add('fechaPasteurizacion')
            ->add('responsablePasteurizacion')
            ->add('usuario')
            ->add('fechaHoraReg')
            ->add('volumenTotal')
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
            ->add('codigoPasteurizacion')
            ->add('numCiclo')
            ->add('volumenPasteurizado')
            ->add('numFrascosPasteurizados')
            ->add('fechaPasteurizacion')
            ->add('responsablePasteurizacion')
            ->add('usuario')
            ->add('fechaHoraReg')
            ->add('volumenTotal')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('codigoPasteurizacion')
            ->add('numCiclo')
            ->add('volumenPasteurizado')
            ->add('numFrascosPasteurizados')
            ->add('fechaPasteurizacion')
            ->add('responsablePasteurizacion')
            ->add('usuario')
            ->add('fechaHoraReg')
            ->add('volumenTotal')
        ;
    }

}