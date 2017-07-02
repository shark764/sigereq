<?php

/*
 * This file is part of the simagdigital package.
 *
 * (c) Farid Hernández <farid.hdz.64@gmail.com>
 *
 */

namespace Minsal\SiblhBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;

use Knp\Menu\FactoryInterface as MenuFactoryInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;

class MinsalSiblhBundleGeneralAdmin extends Admin
{
    //////// << Imagenología >>
    const ___XRAY_CLINICAL_SERVICE___   = '97';
    ////////

    const ___CLASS_REGEX_MINIMAL___     = '^[a-zA-Z0-9_-]+$';
    const ___CLASS_REGEX_GENERAL___     = '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()_-\s]+$';
    const ___CLASS_REGEX_EXTENDED___    = '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\.\?#@()\^\[\]\{\}\\\/\'"_-\s]+$';
    const ___CLASS_REGEX_TEXT_ONLY___   = '^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ,\.()_-\s]+$';
    const ___CLASS_REGEX_NUMBER_ONLY___ = '^[0-9,\.-\s]+$';

    /**
     * @var \UserInterface
     */
    protected $___session_system_USER_LOGGED___;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     */
    protected $___session_system_USER_LOGGED_EMPLOYEE___;

    /**
     * @var \string
     */
    protected $___session_system_USER_LOGGED_EMPLOYEE_CODE___ = '';

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    protected $___session_system_USER_LOGGED_LOCATION___;

    /**
     * Get ___session_system_USER_LOGGED___
     *
     * @return \UserInterface 
     */
    public function getSessionSystemUserLogged()
    {
        return $this->___session_system_USER_LOGGED___;
    }

    /**
     * Get ___session_system_USER_LOGGED_EMPLOYEE___
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado 
     */
    public function getSessionSystemUserLoggedEmployee()
    {
        return $this->___session_system_USER_LOGGED_EMPLOYEE___;
    }

    /**
     * Get ___session_system_USER_LOGGED_EMPLOYEE_CODE___
     *
     * @return \string 
     */
    public function getSessionSystemUserLoggedEmployeeCode()
    {
        return $this->___session_system_USER_LOGGED_EMPLOYEE_CODE___;
    }

    /**
     * Get ___session_system_USER_LOGGED_LOCATION___
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento 
     */
    public function getSessionSystemUserLoggedLocation()
    {
        return $this->___session_system_USER_LOGGED_LOCATION___;
    }

    /**
     * @param string $code
     * @param string $class
     * @param string $baseControllerName
     */
    // public function __construct($code, $class, $baseControllerName)
    // {
    //     parent::__construct($code, $class, $baseControllerName);
    // }

    public function prepareAdminInstance()
    {
        $container          = $this->getConfigurationPool()->getContainer();
        $securityContext    = $container->get('security.context');
        $session_USER       = $securityContext->getToken()->getUser();

        try {
            $this->___session_system_USER_LOGGED___             = $session_USER;    //////// --| user logged
        //     $this->___session_system_USER_LOGGED_EMPLOYEE___    = $session_USER->getIdEmpleado();   //////// --| employee asociated
        //     $this->___session_system_USER_LOGGED_LOCATION___    = $session_USER->getIdEstablecimiento();    //////// --| location asociated

        //     if ($this->___session_system_USER_LOGGED_EMPLOYEE___ !== null)
        //     {
        //         $this->___session_system_USER_LOGGED_EMPLOYEE_CODE___   = $this->___session_system_USER_LOGGED_EMPLOYEE___->getIdTipoEmpleado()->getCodigo();
        //     }
        }
        catch (Exception $e)
        {
        }
    }

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
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
    }
    
    public function getTemplate($name)
    {
        switch ($name)
        {
            case 'edit':
                return 'MinsalSiblhBundle:CRUD:base_edit.html.twig';
                break;
            case 'list':
                return 'MinsalSiblhBundle:CRUD:base_list.html.twig';
                break;
            case 'show':
                return 'MinsalSiblhBundle:CRUD:base_show.html.twig';
                break;
            case 'delete':
                return 'MinsalSiblhBundle:CRUD:delete.html.twig';
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
            array('MinsalSiblhBundle:Form:form_admin_fields.html.twig'),
            array('MinsalSiblhBundle:Form:doctrine_orm_form_admin_fields.html.twig')
       );
    }

    public function prePersist($entity)
    {
        $entity->setIdUserReg($this->___session_system_USER_LOGGED___);
        $entity->setFechaHoraReg(new \DateTime('now'));
    }
    
    public function preUpdate($entity)
    {
        $entity->setIdUserMod($this->___session_system_USER_LOGGED___);
        $entity->setFechaHoraMod(new \DateTime('now'));
    }
    
    public function getNewInstance()
    {
        $instance = parent::getNewInstance();

        $instance->setFechaHoraReg(new \DateTime('now'));
        $instance->setIdUserReg($this->___session_system_USER_LOGGED___);
        
        return $instance;
    }

    /**
     * Generates the breadcrumbs array
     *
     * Note: the method will be called by the top admin instance (parent => child)
     *
     * @param string                       $action
     * @param \Knp\Menu\ItemInterface|null $menu
     *
     * @return array
     */
    public function buildBreadcrumbs($action, MenuItemInterface $menu = null)
    {
        if (isset($this->breadcrumbs[$action])) {
            return $this->breadcrumbs[$action];
        }

        if (!$menu) {
            $menu = $this->menuFactory->createItem('root');

            $menu = $menu->addChild(
                $this->trans($this->getLabelTranslatorStrategy()->getLabel('dashboard', 'breadcrumb', 'link'), array(), 'SonataAdminBundle'),
                array('uri' => $this->routeGenerator->generate('sonata_admin_dashboard'))
            );
        }

        // $menu = $menu->addChild(
        //     $this->trans($this->getLabelTranslatorStrategy()->getLabel(sprintf('%s_list', $this->getClassnameLabel()), 'breadcrumb', 'link')),
        //     array('uri' => $this->hasRoute('list') && $this->isGranted('LIST') ? $this->generateUrl('list') : null)
        // );

        $childAdmin = $this->getCurrentChildAdmin();

        if ($childAdmin) {
            $id = $this->request->get($this->getIdParameter());

            $menu = $menu->addChild(
                $this->toString($this->getSubject()),
                array('uri' => $this->hasRoute('edit') && $this->isGranted('EDIT') ? $this->generateUrl('edit', array('id' => $id)) : null)
            );

            return $childAdmin->buildBreadcrumbs($action, $menu);

        } elseif ($this->isChild()) {

            if ($action == 'list') {
                $menu->setUri(false);
            } elseif ($action != 'create' && $this->hasSubject()) {
                $menu = $menu->addChild($this->toString($this->getSubject()));
            } else {
                $menu = $menu->addChild(
                    $this->trans($this->getLabelTranslatorStrategy()->getLabel(sprintf('%s_%s', $this->getClassnameLabel(), $action), 'breadcrumb', 'link'))
                );
            }

        } elseif ($action != 'list' && $this->hasSubject()) {
            $menu = $menu->addChild($this->toString($this->getSubject()));
        } elseif ($action != 'list') {
            $menu = $menu->addChild(
                $this->trans($this->getLabelTranslatorStrategy()->getLabel(sprintf('%s_%s', $this->getClassnameLabel(), $action), 'breadcrumb', 'link'))
            );
        }

        return $this->breadcrumbs[$action] = $menu;
    }

}