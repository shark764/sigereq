<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Minsal\SiblhBundle\Generator\ListViewGenerator\TableGenerator;

use Minsal\SiblhBundle\Generator\ListViewGenerator\TableGenerator\BlhListViewGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\UserInterface;
// use Minsal\SiblhBundle\Entity\EntityInterface;
use Sonata\AdminBundle\Route\RouteGeneratorInterface;

///////////////////////////////////////////////////////
///////////////////////////////////////////////////////
// http://stackoverflow.com/questions/6956258/adding-onclick-event-to-dynamically-added-button
///////////////////////////////////////////////////////
///////////////////////////////////////////////////////

/**
 * BlhEntityListViewGenerator
 *
 * @author farid
 */
class BlhEntityListViewGenerator extends BlhListViewGenerator
{
    /**
     * @var array
     */
    protected $entityOptions = array();

    /**
     * @var array
     */
    protected $entityColumns = array();

    /**
     * @var array
     */
    protected $entityData = array();

    /**
     * Constructor
     */
    public function __construct(ContainerInterface $container, RouteGeneratorInterface $routeGenerator, $class, $type = 'list', $range = 'all')
    {
        parent::__construct($container, $routeGenerator, $class, $type, $range);

        $this->initialize();
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
        $this->setEntityOptions();
        $this->defineColumns();
        $this->buildData();
    }

    /**
     * {@inheritdoc}
     */
    public function defineEntityOptions()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function setEntityOptions()
    {
        $this->defineEntityOptions();
        $this->defaultOptions = array_merge($this->defaultOptions, $this->entityOptions);
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

    /**
     * {@inheritdoc}
     */
    public function buildData()
    {
        //////// --| entity manager
        $em = $this->entityManager;
        //////// --|

        ////////
        $results = $em->getRepository($this->class)->datos();
        ////////

        ////////
        $this->data = $results;
        ////////
    }

    /**
     * {@inheritdoc}
     */
    public function getTable()
    {
        // return array(
        //     $this->defaultOptions,
        //     'columns'   => $this->columns,
        //     'data'      => $this->data,
        // );
        return array_merge(
            $this->defaultOptions,
            array(
                'columns'   => $this->columns,
                'data'      => $this->data,
            )
        );
    }

}