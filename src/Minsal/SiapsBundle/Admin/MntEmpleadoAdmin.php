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

use Minsal\SiblhBundle\Method\BundleMethod;

use Minsal\SiapsBundle\Entity\MntEmpleado;
use Application\Sonata\UserBundle\Entity\User;

class MntEmpleadoAdmin extends MinsalSiblhBundleGeneralAdmin
{
    protected $baseRouteName    = 'siblh_personal';
    protected $baseRoutePattern = 'blh/personal';

    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);

        $collection->add('search', 'buscar', [], [], ['expose' => true]);
        $collection->add('searchBy', 'buscar-mas', [], [], ['expose' => true]);
        $collection->add('searchLocation', 'buscar-establecimiento', [], [], ['expose' => true]);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('nombre')
            ->add('apellido')
            ->add('fechaNacimiento')
            ->add('dui')
            ->add('numeroJuntaVigilancia')
            ->add('numeroCelular')
            ->add('correoElectronico')
            ->add('correlativo')
            ->add('firmaDigital')
            ->add('idusuarioreg')
            ->add('fechahorareg')
            ->add('idusuariomod')
            ->add('fechahoramod')
            ->add('nombreempleado')
            ->add('habilitado')
            ->add('residente')
            ->add('idNuevoEmpleado')
            ->add('idRegistroSiap')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('nombre')
            ->add('apellido')
            ->add('fechaNacimiento')
            ->add('dui')
            ->add('numeroJuntaVigilancia')
            ->add('numeroCelular')
            ->add('correoElectronico')
            ->add('correlativo')
            ->add('firmaDigital')
            ->add('idusuarioreg')
            ->add('fechahorareg')
            ->add('idusuariomod')
            ->add('fechahoramod')
            ->add('nombreempleado')
            ->add('habilitado')
            ->add('residente')
            ->add('idNuevoEmpleado')
            ->add('idRegistroSiap')
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
            // ->add('id')
            ->add('idEstablecimiento', 'sonata_type_model_hidden')
            ->add('idBancoDeLeche', 'sonata_type_model_hidden')
            ->add('idCentroRecoleccion', 'sonata_type_model_hidden')
            ->add('nombre', null, array(
                            'label' => '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp; Nombre'/*Primer nombre'*/,
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => true,
                            'attr' => array(
                                    'placeholder' => 'primer nombre...',
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-3 col-md-3 col-sm-3',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-user',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '1',
                                    'data-fv-stringlength-message' => '1 caracter mínimo',

                                    'data-fv-regexp' => 'true',
                                    // 'data-fv-regexp-regexp' => self::___CLASS_REGEX_MINIMAL___,
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_TEXT_ONLY___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            ->add('apellido', null, array(
                            'label' => '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp; Apellido'/*Primer apellido'*/,
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'required' => true,
                            'attr' => array(
                                    'placeholder' => 'primer apellido...',
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-3 col-md-3 col-sm-3',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-user',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '1',
                                    'data-fv-stringlength-message' => '1 caracter mínimo',

                                    'data-fv-regexp' => 'true',
                                    // 'data-fv-regexp-regexp' => self::___CLASS_REGEX_MINIMAL___,
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_TEXT_ONLY___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            ->add('idCargoEmpleado', null, array(
                            'label' => 'Cargo que desempeña',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => true,
                            // 'property' => 'presentacionEntidad',
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-6 col-md-6 col-sm-6',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-user',
                            )
            ))
            ->add('fechaNacimiento', 'datetime', array(
                            'label' => 'Fecha de nacimiento',
                            'label_attr' => array('class' => 'label_form_sm'),
                            // 'help' => '',
                            'required' => false,
                            'widget' => 'single_text',
                            'format' => 'dd/MM/yyyy',
                            'attr' => array(
                                    // 'readonly' => 'readonly',
                                    'placeholder' => 'DD/MM/YYYY',
                                    'class' => 'form-control input-sm',
                                    'data-input-transform' => 'datetimepicker',
                                    'data-datetimepicker-type' => 'date',
                                    // 'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-time',

                                    // 'data-add-input-btn' => 'true',
                                    // 'data-add-input-btn-class' => 'display-datetimepicker',
                                    // 'data-add-input-btn-btn-class' => 'btn-sm btn-xray-awesome-blue background-opacity display-datetimepicker',
                                    // 'data-add-input-btn-addon' => 'glyphicon glyphicon-time',

                                    'data-fv-date' => 'true',
                                    'data-fv-date-format' => 'DD/MM/YYYY',
                                    'data-fv-date-message' => 'No es una fecha válida',
                            )
            ))
            ->add('dui', null, array(
                            'label' => 'DUI',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'número de dui...',
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-barcode',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '1',
                                    'data-fv-stringlength-message' => '1 caracter mínimo',

                                    'data-fv-regexp' => 'true',
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_MINIMAL___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            ->add('numeroJuntaVigilancia', null, array(
                            'label' => 'JVPM',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'número de jvpm...',
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-barcode',

                                    'data-fv-stringlength' => 'true',
                                    'data-fv-stringlength-min' => '1',
                                    'data-fv-stringlength-message' => '1 caracter mínimo',

                                    'data-fv-regexp' => 'true',
                                    'data-fv-regexp-regexp' => self::___CLASS_REGEX_MINIMAL___,
                                    'data-fv-regexp-message' => 'Texto contiene caracteres no permitidos',
                            )
            ))
            ->add('numeroCelular', null, array(
                            'label' => 'Teléfono móvil',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'teléfono móvil...',
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-phone',
                            )
            ))
            ->add('correoElectronico', null, array(
                            'label' => 'E-Mail',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'código...',
                                    'class' => 'form-control input-sm',
                                    // 'readonly' => 'readonly',
                                    // 'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-envelope',
                            )
            ))
            // ->add('correlativo')
            // ->add('firmaDigital')
            // ->add('idusuarioreg')
            // ->add('fechahorareg')
            // ->add('idusuariomod')
            // ->add('fechahoramod')
            // ->add('nombreempleado')
            ->add('idTipoEmpleado', null, array(
                            'label' => 'Tipo de empleado',
                            'label_attr' => array('class' => 'label_form_sm'),
                            'required' => true,
                            // 'property' => 'presentacionEntidad',
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-6 col-md-6 col-sm-6',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-user',
                            )
            ))
            ->add('residente', null, array(
                            'label' => '¿Residente?',
                            'label_attr' => array('class' => 'label_form_sm label_check col-lg-12 col-md-12 col-sm-12'),
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'start',
                                    // 'data-add-form-group-col-class' => 'col-lg-1 col-md-1 col-sm-1',
                            )
            ))
            ->add('habilitado', null, array(
                            'label' => '¿Habilitado?',
                            'label_attr' => array('class' => 'label_form_sm label_check col-lg-12 col-md-12 col-sm-12'),
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'start',
                                    // 'data-add-form-group-col-class' => 'col-lg-1 col-md-1 col-sm-1',
                            )
            ))
            // ->add('idNuevoEmpleado')
            // ->add('idRegistroSiap')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('nombre')
            ->add('apellido')
            ->add('fechaNacimiento')
            ->add('dui')
            ->add('numeroJuntaVigilancia')
            ->add('numeroCelular')
            ->add('correoElectronico')
            ->add('correlativo')
            ->add('firmaDigital')
            ->add('idusuarioreg')
            ->add('fechahorareg')
            ->add('idusuariomod')
            ->add('fechahoramod')
            ->add('nombreempleado')
            ->add('habilitado')
            ->add('residente')
            ->add('idNuevoEmpleado')
            ->add('idRegistroSiap')
        ;
    }
    
    public function getTemplate($name)
    {
        switch ($name)
        {
            case 'edit':
                return 'MinsalSiapsBundle:MntEmpleadoAdmin:base_edit.html.twig';
                break;
            // case 'list':
            //     return 'MinsalSiblhBundle:CRUD:base_list.html.twig';
            //     break;
            // case 'show':
            //     return 'MinsalSiblhBundle:CRUD:base_show.html.twig';
            //     break;
            // case 'delete':
            //     return 'MinsalSiblhBundle:CRUD:delete.html.twig';
            //     break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
    
    public function prePersist($entity)
    {
        //////// --| parent behavior
        // parent::prePersist($entity);
        ////////

        $entity->setNombreempleado($entity->getNombre() . ' ' . $entity->getApellido());

        // $entity->addEmpleadoUsuario($u_);
    }
    
    public function postPersist($entity)
    {
        //////// --| parent behavior
        // parent::postPersist($entity);
        ////////

        $method_ = new BundleMethod();

        // $u_ = new User();
        $userManager = $this->getConfigurationPool()->getContainer()->get('fos_user.user_manager');
        $u_ = $userManager->createUser();
        $u_->setFirstname($entity->getNombre());
        $u_->setLastname($entity->getApellido());
        $u_->setUsername($method_->obtenerUsername(
            $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager(),
            $u_->getFirstname(),
            $u_->getLastname()
        ));
        $u_->setEmail($entity->getCorreoElectronico());
        if (trim($u_->getEmail()) === null || trim($u_->getEmail()) === "") {
            $u_->setEmail($u_->getUsername() . '@salud.gob.sv');
        }
        $u_->setEmailCanonical($u_->getEmail());
        $u_->setPlainPassword('siblh'); // this method will encrypt the password with the default settings
        $u_->setIdEstablecimiento($this->___session_system_USER_LOGGED_LOCATION___);
        $u_->setIdBancoDeLeche($this->___session_system_USER_LOGGED_MILK_BANK___);
        $u_->setIdCentroRecoleccion($this->___session_system_USER_LOGGED_COLLECTION_CENTER___);
        $u_->setIdEmpleado($entity);
        $u_->setLocked(false); // don't lock the user
        $u_->setEnabled(true); // enable the user or enable it later with a confirmation token in the email
        $userManager->updateUser($u_);
        // $entity->addEmpleadoUsuario($u_);
    }
    
    public function preUpdate($entity)
    {
        //////// --| parent behavior
        // parent::preUpdate($entity);
        ////////

        $entity->setNombreempleado($entity->getNombre() . ' ' . $entity->getApellido());
    }
    
    public function postUpdate($entity)
    {
        //////// --| parent behavior
        // parent::postUpdate($entity);
        ////////

        if ($entity->getEmpleadoUsuario()->count() === 0)
        {
            $method_ = new BundleMethod();

            // $u_ = new User();
            $userManager = $this->getConfigurationPool()->getContainer()->get('fos_user.user_manager');
            $u_ = $userManager->createUser();
            $u_->setFirstname($entity->getNombre());
            $u_->setLastname($entity->getApellido());
            $u_->setUsername($method_->obtenerUsername(
                $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager(),
                $u_->getFirstname(),
                $u_->getLastname()
            ));
            $u_->setEmail($entity->getCorreoElectronico());
            if (trim($u_->getEmail()) === null || trim($u_->getEmail()) === "") {
                $u_->setEmail($u_->getUsername() . '@salud.gob.sv');
            }
            $u_->setEmailCanonical($u_->getEmail());
            $u_->setPlainPassword('siblh'); // this method will encrypt the password with the default settings
            $u_->setIdEstablecimiento($this->___session_system_USER_LOGGED_LOCATION___);
            $u_->setIdBancoDeLeche($this->___session_system_USER_LOGGED_MILK_BANK___);
            $u_->setIdCentroRecoleccion($this->___session_system_USER_LOGGED_COLLECTION_CENTER___);
            $u_->setIdEmpleado($entity);
            $u_->setLocked(false); // don't lock the user
            $u_->setEnabled(true); // enable the user or enable it later with a confirmation token in the email
            $userManager->updateUser($u_);
            // $entity->addEmpleadoUsuario($u_);
        }
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

        $object->setIdUserReg($this->___session_system_USER_LOGGED___);
        $object->setIdEstablecimiento($this->___session_system_USER_LOGGED_LOCATION___);
        $object->setIdBancoDeLeche($this->___session_system_USER_LOGGED_MILK_BANK___);
        $object->setIdCentroRecoleccion($this->___session_system_USER_LOGGED_COLLECTION_CENTER___);
        $object->setIdTipoEmpleado($this->getModelManager()->findOneBy('MinsalSiapsBundle:MntTipoEmpleado', array('codigo' => 'MED')));

        return $object;
    }

}