<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Minsal\SiblhBundle\Generator\ListViewGenerator\TableGenerator;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\UserInterface;
use Minsal\SiblhBundle\Entity\EntityInterface;
use Sonata\AdminBundle\Route\RouteGeneratorInterface;

///////////////////////////////////////////////////////
///////////////////////////////////////////////////////
// http://stackoverflow.com/questions/6956258/adding-onclick-event-to-dynamically-added-button
///////////////////////////////////////////////////////
///////////////////////////////////////////////////////

/**
 * BlhListViewGenerator
 *
 * @author farid
 */
class BlhListViewGenerator /*implements ListViewGeneratorInterface*/
{
    /**
     * @var ContainerInterface
     *
     * @api
     */
    protected $container;

    /**
     * The router instance
     *
     * @var RouteGeneratorInterface
     */
    protected $routeGenerator;

    /**
     * @var \EntityManager
     */
    protected $entityManager;

    /**
     * @var \UserInterface
     */
    protected $user;

    /**
     * The class name managed by the generator
     *
     * @var string
     */
    protected $class;

    /**
     * @var array
     */
    protected $defaultOptions = array(
        'idField'       => 'id',
        'cache'         => false,
        'showRefresh'   => true,
        'showToggle'    => true,
        'showColumns'   => true,
        'search'        => true,
        'pagination'    => true,
        // 'paginationVAlign'  => 'both',
        'paginationHAlign'  => 'left',
        'paginationDetailHAlign'    => 'right',
        'pageList'      => '[5, 10, 15, 25, 30, 40, 50, 75, 100, 125, 150, 200, 250, 300]',
        'pageSize'      => 25,
        'sortName'      => 'id',
        'sortOrder'     => 'desc',
        'classes'       => 'table table-hover table-condensed table-no-bordered table-black-head'/*table-striped*/,
        'buttonsClass'  => 'primary',
        // 'buttonsClass'  => 'black-thrash',
        'icons'         => array(
            'paginationSwitchDown'  => 'glyphicon-collapse-down icon-chevron-down',
            'paginationSwitchUp'    => 'glyphicon-collapse-up icon-chevron-up',
            'refresh'       => 'glyphicon-repeat icon-repeat',
            'toggle'        => 'glyphicon-list-alt icon-list-alt',
            'columns'       => 'glyphicon-th icon-th',
            'detailOpen'    => 'glyphicon-chevron-down icon-chevron-down',
            'detailClose'   => 'glyphicon-chevron-up icon-chevron-up',
        ),
        'searchAlign'   => 'left',
        'buttonsAlign'  => 'left',
        'toolbarAlign'  => 'right',
        // 'height'        => '1268',
    );

    /**
     * @var string
     */
    protected $type = 'list';

    /**
     * @var string
     */
    protected $range = 'all';

    /**
     * @var array
     */
    protected $columns = array();

    /**
     * @var array
     */
    protected $data = array();

    /**
     * Constructor
     */
    public function __construct(ContainerInterface $container, RouteGeneratorInterface $routeGenerator, $class, $type = 'list', $range = 'all')
    {
        $this->class            = $class;
        $this->type             = $type;
        $this->range            = $range;
        $this->container        = $container;
        $this->routeGenerator   = $routeGenerator;
        $this->entityManager    = $this->container->get('doctrine')->getManager();
        $this->user             = $this->container->get('security.context')->getToken()->getUser();

        // $this->initialize();
    }

    /**
     * Sets the Container associated with this Controller.
     *
     * @param ContainerInterface $container A ContainerInterface instance
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Sets the RouteGenerator associated with this Controller.
     *
     * @param RouteGeneratorInterface $routeGenerator A RouteGeneratorInterface instance
     *
     * @api
     */
    public function setRouteGenerator(RouteGeneratorInterface $routeGenerator)
    {
        $this->routeGenerator = $routeGenerator;
    }

    /**
     * Sets the EntityManager.
     *
     * @param EntityManager $entityManager An EntityManager instance
     *
     * @api
     */
    public function setEntityManager(EntityManager $entityManager = null)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Sets the UserInterface.
     *
     * @param UserInterface $user An UserInterface instance
     *
     * @api
     */
    public function setUser(UserInterface $user = null)
    {
        $this->user = $user;
    }

    /**
     * Sets the array.
     *
     * @param array $defaultOptions An array instance
     *
     * @api
     */
    public function setDefaultOptions(array $defaultOptions)
    {
        $this->defaultOptions = $defaultOptions;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions()
    {
        return $this->defaultOptions;
    }

    /**
     * {@inheritdoc}
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setRange($range)
    {
        $this->range = $range;
    }

    /**
     * {@inheritdoc}
     */
    public function getRange()
    {
        return $this->range;
    }

    /**
     * Sets the array.
     *
     * @param array $columns An array instance
     *
     * @api
     */
    public function setColumns(array $columns)
    {
        $this->columns = $columns;
    }

    /**
     * {@inheritdoc}
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Sets the array.
     *
     * @param array $columns An array instance
     *
     * @api
     */
    public function defineColumns()
    {
        // $this->columns = $columns;
    }

    /**
     * Sets the array.
     *
     * @param array $data An array instance
     *
     * @api
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function initialize()
    {
        // $this->defineColumns();
    }

    /**
     * {@inheritdoc}
     */
    public function setCustomOptions(array $newOptions)
    {
        $this->defaultOptions = array_merge($this->defaultOptions, $newOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function setCustomColumns(array $newColumns)
    {
        $this->columns = array_merge($this->columns, $newColumns);
    }

}