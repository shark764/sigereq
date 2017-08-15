<?php

namespace Application\Sonata\UserBundle\Admin;

// use Sonata\AdminBundle\Admin\Admin;
use Sonata\UserBundle\Admin\Model\UserAdmin as BaseUserAdmin;
// use Minsal\SiblhBundle\Admin\MinsalSiblhBundleGeneralAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;

class UserAdmin extends BaseUserAdmin
{
    //////// << Bancos de Leche >>
    const ___BLH_CLINICAL_SERVICE___    = '101';
    ////////

    const ___CLASS_REGEX_MINIMAL___     = '^[a-zA-Z0-9_-]+$';
    const ___CLASS_REGEX_GENERAL___     = '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$';
    const ___CLASS_REGEX_EXTENDED___    = '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()\^\[\]\{\}\\\/\'"_-\s]+$';
    const ___CLASS_REGEX_TEXT_ONLY___   = '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ,\.()_-\s]+$';
    const ___CLASS_REGEX_NUMBER_ONLY___ = '^[0-9,\.-\s]+$';

    // protected $baseRouteName    = 'siblh_usuario';
    // protected $baseRoutePattern = 'blh/usuario';

    protected function configureRoutes(RouteCollection $collection)
    {
        // $collection->remove('delete');
        $collection->add('delete', 'borrar', [], [], ['expose' => true]);
        $collection->add('create', 'crear', [], [], ['expose' => true]);
        $collection->add('edit', 'editar', [], [], ['expose' => true]);
        $collection->add('list', 'listar', [], [], ['expose' => true]);
        $collection->add('show', 'consultar', [], [], ['expose' => true]);
        $collection->add('generateTable', 'generar-tabla', [], [], ['expose' => true]);
        $collection->add('generateData', 'generar-datos', [], [], ['expose' => true]);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('username')
            ->add('usernameCanonical')
            ->add('email')
            ->add('emailCanonical')
            ->add('enabled')
            ->add('salt')
            ->add('password')
            ->add('lastLogin')
            ->add('locked')
            ->add('expired')
            ->add('expiresAt')
            ->add('confirmationToken')
            ->add('passwordRequestedAt')
            ->add('roles')
            ->add('credentialsExpired')
            ->add('credentialsExpireAt')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('dateOfBirth')
            ->add('firstname')
            ->add('lastname')
            ->add('website')
            ->add('biography')
            ->add('gender')
            ->add('locale')
            ->add('timezone')
            ->add('phone')
            ->add('facebookUid')
            ->add('facebookName')
            ->add('facebookData')
            ->add('twitterUid')
            ->add('twitterName')
            ->add('twitterData')
            ->add('gplusUid')
            ->add('gplusName')
            ->add('gplusData')
            ->add('token')
            ->add('twoStepVerificationCode')
            ->add('id')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('username')
            ->add('usernameCanonical')
            ->add('email')
            ->add('emailCanonical')
            ->add('enabled')
            ->add('salt')
            ->add('password')
            ->add('lastLogin')
            ->add('locked')
            ->add('expired')
            ->add('expiresAt')
            ->add('confirmationToken')
            ->add('passwordRequestedAt')
            ->add('roles')
            ->add('credentialsExpired')
            ->add('credentialsExpireAt')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('dateOfBirth')
            ->add('firstname')
            ->add('lastname')
            ->add('website')
            ->add('biography')
            ->add('gender')
            ->add('locale')
            ->add('timezone')
            ->add('phone')
            ->add('facebookUid')
            ->add('facebookName')
            ->add('facebookData')
            ->add('twitterUid')
            ->add('twitterName')
            ->add('twitterData')
            ->add('gplusUid')
            ->add('gplusName')
            ->add('gplusData')
            ->add('token')
            ->add('twoStepVerificationCode')
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
            ->add('firstname', null, array(
                            'label' => '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp; Nombre'/*Primer nombre'*/,
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'required' => true,
                            'attr' => array(
                                    'placeholder' => 'primer nombre...',
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

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
            ->add('lastname', null, array(
                            'label' => '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp; Apellido'/*Primer apellido'*/,
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'required' => true,
                            'attr' => array(
                                    'placeholder' => 'primer apellido...',
                                    'class' => 'form-control input-sm',
                                    'data-form-inline-group' => 'stop',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

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
            ->add('username', null, array(
                            'label' => 'Usuario',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'required' => false,
                            'attr' => array(
                                    'placeholder' => 'código...',
                                    'class' => 'form-control input-sm',
                                    'readonly' => 'readonly',
                                    // 'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-4 col-md-4 col-sm-4',

                                    'data-add-input-addon' => 'true',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-user',
                            )
            ))
            // ->add('usernameCanonical')
            ->add('email', null, array(
                            'label' => 'E-Mail',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
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
            // ->add('emailCanonical')
            // ->add('enabled')
            // ->add('salt')
            // ->add('password')
            // ->add('lastLogin')
            // ->add('locked')
            // ->add('expired')
            // ->add('expiresAt')
            // ->add('confirmationToken')
            // ->add('passwordRequestedAt')
            // ->add('roles')
            // ->add('credentialsExpired')
            // ->add('credentialsExpireAt')
            // ->add('createdAt')
            // ->add('updatedAt')
            // ->add('dateOfBirth')
            // ->add('website')
            // ->add('biography')
            // ->add('gender')
            // ->add('locale')
            // ->add('timezone')
            // ->add('phone')
            // ->add('facebookUid')
            // ->add('facebookName')
            // ->add('facebookData')
            // ->add('twitterUid')
            // ->add('twitterName')
            // ->add('twitterData')
            // ->add('gplusUid')
            // ->add('gplusName')
            // ->add('gplusData')
            // ->add('token')
            // ->add('twoStepVerificationCode')
            ->add('idEstablecimiento', null, array(
                            'label' => 'Establecimiento',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            // 'required' => true,
                            // 'group_by' => 'idEstablecimiento',
                            'attr' => array(
                                    'class' => 'form-control input-sm',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-home',
                            )
            ))
            ->add('idBancoDeLeche', null, array(
                            'label' => 'Banco de Leche',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            // 'required' => true,
                            // 'group_by' => 'idEstablecimiento',
                            'attr' => array(
                                    'class' => 'form-control input-sm',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-home',
                            )
            ))
            ->add('idCentroRecoleccion', null, array(
                            'label' => 'Centro de recolección',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            // 'required' => true,
                            'group_by' => 'idBancoDeLeche',
                            'attr' => array(
                                    'class' => 'form-control input-sm',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-home',
                            )
            ))
            ->add('idEmpleado', null, array(
                            'label' => 'Empleado',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'required' => true,
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-6 col-md-6 col-sm-6',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-user',
                            )
            ))
            ->add('groups', 'sonata_type_model', array(
                            'label' => 'Grupos',
                            'label_attr' => array('class' => 'label_form_sm col-lg-2 col-md-2 col-sm-2'),
                            'required' => true,
                            'expanded' => false,
                            'multiple' => true,
                            'by_reference' => true,
                            'attr' => array(
                                    'class' => 'form-control input-sm',
                                    // 'data-form-inline-group' => 'start',
                                    'data-add-form-group-col-class' => 'col-lg-10 col-md-10 col-sm-10',

                                    'data-add-input-addon' => 'true',
                                    // 'data-add-input-addon-class' => 'primary-v4',
                                    'data-add-input-addon-addon' => 'glyphicon glyphicon-user',
                            )
            ))
            // ->add('id')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('username')
            ->add('usernameCanonical')
            ->add('email')
            ->add('emailCanonical')
            ->add('enabled')
            ->add('salt')
            ->add('password')
            ->add('lastLogin')
            ->add('locked')
            ->add('expired')
            ->add('expiresAt')
            ->add('confirmationToken')
            ->add('passwordRequestedAt')
            ->add('roles')
            ->add('credentialsExpired')
            ->add('credentialsExpireAt')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('dateOfBirth')
            ->add('firstname')
            ->add('lastname')
            ->add('website')
            ->add('biography')
            ->add('gender')
            ->add('locale')
            ->add('timezone')
            ->add('phone')
            ->add('facebookUid')
            ->add('facebookName')
            ->add('facebookData')
            ->add('twitterUid')
            ->add('twitterName')
            ->add('twitterData')
            ->add('gplusUid')
            ->add('gplusName')
            ->add('gplusData')
            ->add('token')
            ->add('twoStepVerificationCode')
            ->add('id')
        ;
    }

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('MinsalSiblhBundle:Form:form_admin_fields.html.twig'),
            array('MinsalSiblhBundle:Form:doctrine_orm_form_admin_fields.html.twig')
       );
    }
    
    public function getTemplate($name)
    {
        switch ($name)
        {
            case 'edit':
                return 'MinsalSiblhBundle:CRUD:base_edit.html.twig';
                break;
            // case 'list':
            //     return 'MinsalSiblhBundle:CRUD:base_list.html.twig';
            //     break;
            // case 'show':
            //     return 'MinsalSiblhBundle:CRUD:base_show.html.twig';
            //     break;
            case 'delete':
                return 'MinsalSiblhBundle:CRUD:delete.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

}