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

class BlhHistorialClinicoAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_historial_clinico';
    protected $baseRoutePattern = 'blh/historial-clinico';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('controlPrenatal')
            ->add('edadGestFur')
            ->add('lugarControl')
            ->add('numeroControl')
            ->add('fechaParto')
            ->add('lugarParto')
            ->add('patologiaEmbarazo')
            ->add('periodoIntergenesico')
            ->add('fechaPartoAnterior')
            ->add('formulaObstetricaG')
            ->add('formulaObstetricaP1')
            ->add('formulaObstetricaP2')
            ->add('formulaObstetricaA')
            ->add('formulaObstetricaV')
            ->add('formulaObstetricaM')
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
            ->add('controlPrenatal')
            ->add('edadGestFur')
            ->add('lugarControl')
            ->add('numeroControl')
            ->add('fechaParto')
            ->add('lugarParto')
            ->add('patologiaEmbarazo')
            ->add('periodoIntergenesico')
            ->add('fechaPartoAnterior')
            ->add('formulaObstetricaG')
            ->add('formulaObstetricaP1')
            ->add('formulaObstetricaP2')
            ->add('formulaObstetricaA')
            ->add('formulaObstetricaV')
            ->add('formulaObstetricaM')
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
            ->add('controlPrenatal')
            ->add('edadGestFur')
            ->add('lugarControl')
            ->add('numeroControl')
            ->add('fechaParto')
            ->add('lugarParto')
            ->add('patologiaEmbarazo')
            ->add('periodoIntergenesico')
            ->add('fechaPartoAnterior')
            ->add('formulaObstetricaG')
            ->add('formulaObstetricaP1')
            ->add('formulaObstetricaP2')
            ->add('formulaObstetricaA')
            ->add('formulaObstetricaV')
            ->add('formulaObstetricaM')
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
            ->add('controlPrenatal')
            ->add('edadGestFur')
            ->add('lugarControl')
            ->add('numeroControl')
            ->add('fechaParto')
            ->add('lugarParto')
            ->add('patologiaEmbarazo')
            ->add('periodoIntergenesico')
            ->add('fechaPartoAnterior')
            ->add('formulaObstetricaG')
            ->add('formulaObstetricaP1')
            ->add('formulaObstetricaP2')
            ->add('formulaObstetricaA')
            ->add('formulaObstetricaV')
            ->add('formulaObstetricaM')
            ->add('usuario')
            ->add('fechaHoraReg')
        ;
    }

}