<?php

namespace Minsal\SiapsBundle\Admin;

use Minsal\SiblhBundle\Admin\MinsalSiblhBundleGeneralAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;

class MntPacienteAdmin extends MinsalSiblhBundleGeneralAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('primerNombre')
            ->add('segundoNombre')
            ->add('tercerNombre')
            ->add('primerApellido')
            ->add('segundoApellido')
            ->add('apellidoCasada')
            ->add('fechaNacimiento')
            ->add('horaNacimiento')
            ->add('numeroDocIdePaciente')
            ->add('direccion')
            ->add('telefonoCasa')
            ->add('lugarTrabajo')
            ->add('telefonoTrabajo')
            ->add('nombrePadre')
            ->add('nombreMadre')
            ->add('nombreResponsable')
            ->add('direccionResponsable')
            ->add('telefonoResponsable')
            ->add('numeroDocIdeResponsable')
            ->add('nombreProporcionoDatos')
            ->add('numeroDocIdeProporDatos')
            ->add('observacion')
            ->add('conocidoPor')
            ->add('estado')
            ->add('idPacienteInicial')
            ->add('fechaRegistro')
            ->add('fechaMod')
            ->add('cotizante')
            ->add('nombreCompletoFonetico')
            ->add('apellidoCompletoFonetico')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('primerNombre')
            ->add('segundoNombre')
            ->add('tercerNombre')
            ->add('primerApellido')
            ->add('segundoApellido')
            ->add('apellidoCasada')
            ->add('fechaNacimiento')
            ->add('horaNacimiento')
            ->add('numeroDocIdePaciente')
            ->add('direccion')
            ->add('telefonoCasa')
            ->add('lugarTrabajo')
            ->add('telefonoTrabajo')
            ->add('nombrePadre')
            ->add('nombreMadre')
            ->add('nombreResponsable')
            ->add('direccionResponsable')
            ->add('telefonoResponsable')
            ->add('numeroDocIdeResponsable')
            ->add('nombreProporcionoDatos')
            ->add('numeroDocIdeProporDatos')
            ->add('observacion')
            ->add('conocidoPor')
            ->add('estado')
            ->add('idPacienteInicial')
            ->add('fechaRegistro')
            ->add('fechaMod')
            ->add('cotizante')
            ->add('nombreCompletoFonetico')
            ->add('apellidoCompletoFonetico')
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
            ->add('primerNombre')
            ->add('segundoNombre')
            ->add('tercerNombre')
            ->add('primerApellido')
            ->add('segundoApellido')
            ->add('apellidoCasada')
            ->add('fechaNacimiento')
            ->add('horaNacimiento')
            ->add('numeroDocIdePaciente')
            ->add('direccion')
            ->add('telefonoCasa')
            ->add('lugarTrabajo')
            ->add('telefonoTrabajo')
            ->add('nombrePadre')
            ->add('nombreMadre')
            ->add('nombreResponsable')
            ->add('direccionResponsable')
            ->add('telefonoResponsable')
            ->add('numeroDocIdeResponsable')
            ->add('nombreProporcionoDatos')
            ->add('numeroDocIdeProporDatos')
            ->add('observacion')
            ->add('conocidoPor')
            ->add('estado')
            ->add('idPacienteInicial')
            ->add('fechaRegistro')
            ->add('fechaMod')
            ->add('cotizante')
            ->add('nombreCompletoFonetico')
            ->add('apellidoCompletoFonetico')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('primerNombre')
            ->add('segundoNombre')
            ->add('tercerNombre')
            ->add('primerApellido')
            ->add('segundoApellido')
            ->add('apellidoCasada')
            ->add('fechaNacimiento')
            ->add('horaNacimiento')
            ->add('numeroDocIdePaciente')
            ->add('direccion')
            ->add('telefonoCasa')
            ->add('lugarTrabajo')
            ->add('telefonoTrabajo')
            ->add('nombrePadre')
            ->add('nombreMadre')
            ->add('nombreResponsable')
            ->add('direccionResponsable')
            ->add('telefonoResponsable')
            ->add('numeroDocIdeResponsable')
            ->add('nombreProporcionoDatos')
            ->add('numeroDocIdeProporDatos')
            ->add('observacion')
            ->add('conocidoPor')
            ->add('estado')
            ->add('idPacienteInicial')
            ->add('fechaRegistro')
            ->add('fechaMod')
            ->add('cotizante')
            ->add('nombreCompletoFonetico')
            ->add('apellidoCompletoFonetico')
        ;
    }
    
    public function prePersist($entity)
    {
        // parent::prePersist($entity);

        $entity->fechaRegistro(new \DateTime('now'));
    }
    
    public function preUpdate($entity)
    {
        // parent::preUpdate($entity);
        
        $entity->fechaRegistro(new \DateTime('now'));
    }

    /**
     * {@inheritdoc}
     */
    public function getNewInstance()
    {
        $object = $this->getModelManager()->getModelInstance($this->getClass());
        foreach ($this->getExtensions() as $extension)
        {
            $extension->alterNewInstance($this, $object);
        }

        ////////
        //////// ///////////////////////////////////////////////////////////
        //////// --| EXPEDIENTE
        //////// ///////////////////////////////////////////////////////////
        ////////
        $expediente_ = new \Minsal\SiapsBundle\Entity\MntExpediente();
        $expediente_->setIdEstablecimiento($this->___session_system_USER_LOGGED_LOCATION___);
        $expediente_->setIdPaciente($object);
        $object->addExpediente($expediente_);

        return $object;
    }

}