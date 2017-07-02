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

class BlhDonanteAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'simagd_donante';
    protected $baseRoutePattern = 'blh/donante';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('codigoDonante')
            ->add('primerNombre')
            ->add('segundoNombre')
            ->add('primerApellido')
            ->add('segundoApellido')
            ->add('fechaNacimiento')
            ->add('fechaRegistroDonanteBlh')
            ->add('telefonoFijo')
            ->add('telefonoMovil')
            ->add('direccion')
            ->add('procedencia')
            ->add('registro')
            ->add('numeroDocumentoIdentificacion')
            ->add('documentoIdentificacion')
            ->add('edad')
            ->add('ocupacion')
            ->add('estadoCivil')
            ->add('escolaridad')
            ->add('tipoColecta')
            ->add('observaciones')
            ->add('estado')
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
            ->add('codigoDonante')
            ->add('primerNombre')
            ->add('segundoNombre')
            ->add('primerApellido')
            ->add('segundoApellido')
            ->add('fechaNacimiento')
            ->add('fechaRegistroDonanteBlh')
            ->add('telefonoFijo')
            ->add('telefonoMovil')
            ->add('direccion')
            ->add('procedencia')
            ->add('registro')
            ->add('numeroDocumentoIdentificacion')
            ->add('documentoIdentificacion')
            ->add('edad')
            ->add('ocupacion')
            ->add('estadoCivil')
            ->add('escolaridad')
            ->add('tipoColecta')
            ->add('observaciones')
            ->add('estado')
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
            ->add('codigoDonante')
            ->add('primerNombre')
            ->add('segundoNombre')
            ->add('primerApellido')
            ->add('segundoApellido')
            ->add('fechaNacimiento')
            ->add('fechaRegistroDonanteBlh')
            ->add('telefonoFijo')
            ->add('telefonoMovil')
            ->add('direccion')
            ->add('procedencia')
            ->add('registro')
            ->add('numeroDocumentoIdentificacion')
            ->add('documentoIdentificacion')
            ->add('edad')
            ->add('ocupacion')
            ->add('estadoCivil')
            ->add('escolaridad')
            ->add('tipoColecta')
            ->add('observaciones')
            ->add('estado')
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
            ->add('codigoDonante')
            ->add('primerNombre')
            ->add('segundoNombre')
            ->add('primerApellido')
            ->add('segundoApellido')
            ->add('fechaNacimiento')
            ->add('fechaRegistroDonanteBlh')
            ->add('telefonoFijo')
            ->add('telefonoMovil')
            ->add('direccion')
            ->add('procedencia')
            ->add('registro')
            ->add('numeroDocumentoIdentificacion')
            ->add('documentoIdentificacion')
            ->add('edad')
            ->add('ocupacion')
            ->add('estadoCivil')
            ->add('escolaridad')
            ->add('tipoColecta')
            ->add('observaciones')
            ->add('estado')
            ->add('usuario')
            ->add('fechaHoraReg')
        ;
    }

}