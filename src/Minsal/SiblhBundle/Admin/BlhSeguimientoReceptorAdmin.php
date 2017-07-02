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

class BlhSeguimientoReceptorAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_seguimiento_receptor';
    protected $baseRoutePattern = 'blh/seguimiento-receptor';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('tallaReceptor')
            ->add('pesoSeguimiento')
            ->add('pcSeguimiento')
            ->add('gananciaDiaPeso')
            ->add('semana')
            ->add('fechaSeguimiento')
            ->add('gananciaDiaTalla')
            ->add('complicaciones')
            ->add('observacion')
            ->add('periodoEvaluacion')
            ->add('gananciaDiaPc')
            ->add('usuario')
            ->add('fechaHoraReg')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('tallaReceptor')
            ->add('pesoSeguimiento')
            ->add('pcSeguimiento')
            ->add('gananciaDiaPeso')
            ->add('semana')
            ->add('fechaSeguimiento')
            ->add('gananciaDiaTalla')
            ->add('complicaciones')
            ->add('observacion')
            ->add('periodoEvaluacion')
            ->add('gananciaDiaPc')
            ->add('usuario')
            ->add('fechaHoraReg')
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
            ->add('tallaReceptor')
            ->add('pesoSeguimiento')
            ->add('pcSeguimiento')
            ->add('gananciaDiaPeso')
            ->add('semana')
            ->add('fechaSeguimiento')
            ->add('gananciaDiaTalla')
            ->add('complicaciones')
            ->add('observacion')
            ->add('periodoEvaluacion')
            ->add('gananciaDiaPc')
            ->add('usuario')
            ->add('fechaHoraReg')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('tallaReceptor')
            ->add('pesoSeguimiento')
            ->add('pcSeguimiento')
            ->add('gananciaDiaPeso')
            ->add('semana')
            ->add('fechaSeguimiento')
            ->add('gananciaDiaTalla')
            ->add('complicaciones')
            ->add('observacion')
            ->add('periodoEvaluacion')
            ->add('gananciaDiaPc')
            ->add('usuario')
            ->add('fechaHoraReg')
        ;
    }

}