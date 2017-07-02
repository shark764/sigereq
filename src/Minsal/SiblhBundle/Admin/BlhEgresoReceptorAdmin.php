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

class BlhEgresoReceptorAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_egreso_receptor';
    protected $baseRoutePattern = 'blh/egreso-receptor';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('diagnosticoEgreso')
            ->add('madreCanguro')
            ->add('tipoEgreso')
            ->add('comentarioEgreso')
            ->add('trasladoPeriferico')
            ->add('permanenciaUcin')
            ->add('hospitalSeguimientoEgreso')
            ->add('fechaEgreso')
            ->add('estanciaHospitalaria')
            ->add('usuario')
            ->add('fechaHoraReg')
            ->add('diasPermanencia')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('diagnosticoEgreso')
            ->add('madreCanguro')
            ->add('tipoEgreso')
            ->add('comentarioEgreso')
            ->add('trasladoPeriferico')
            ->add('permanenciaUcin')
            ->add('hospitalSeguimientoEgreso')
            ->add('fechaEgreso')
            ->add('estanciaHospitalaria')
            ->add('usuario')
            ->add('fechaHoraReg')
            ->add('diasPermanencia')
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
            ->add('diagnosticoEgreso')
            ->add('madreCanguro')
            ->add('tipoEgreso')
            ->add('comentarioEgreso')
            ->add('trasladoPeriferico')
            ->add('permanenciaUcin')
            ->add('hospitalSeguimientoEgreso')
            ->add('fechaEgreso')
            ->add('estanciaHospitalaria')
            ->add('usuario')
            ->add('fechaHoraReg')
            ->add('diasPermanencia')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('diagnosticoEgreso')
            ->add('madreCanguro')
            ->add('tipoEgreso')
            ->add('comentarioEgreso')
            ->add('trasladoPeriferico')
            ->add('permanenciaUcin')
            ->add('hospitalSeguimientoEgreso')
            ->add('fechaEgreso')
            ->add('estanciaHospitalaria')
            ->add('usuario')
            ->add('fechaHoraReg')
            ->add('diasPermanencia')
        ;
    }

}