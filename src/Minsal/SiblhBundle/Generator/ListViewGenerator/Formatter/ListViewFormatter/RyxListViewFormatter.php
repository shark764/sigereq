<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Minsal\SiblhBundle\Generator\ListViewGenerator\Formatter\ListViewFormatter;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\UserInterface;
// use Minsal\SiblhBundle\Entity\EntityInterface;
use Sonata\AdminBundle\Route\RouteGeneratorInterface;

/**
 * BlhListViewFormatter
 *
 * @author farid
 */
class BlhListViewFormatter
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
     * The class name managed by the generator
     *
     * @var string
     */
    protected $class;

    /**
     * type of format for the row
     *
     * @var string
     */
    protected $type = 'compact';

    /**
     * @var array
     */
    protected $data = array();

    /**
     * @var array
     */
    protected $row = array();

    /**
     * Compact format for the data
     *
     * @var string
     */
    protected $compactData = null;

    /**
     * Detail format for the data
     *
     * @var string
     */
    protected $detailData = null;

    /**
     * Compact format for the row
     *
     * @var string
     */
    protected $compactRow = null;

    /**
     * Detail format for the row
     *
     * @var string
     */
    protected $detailRow = null;

    /**
     * Constructor
     */
    public function __construct(ContainerInterface $container, RouteGeneratorInterface $routeGenerator, $class, $type = 'compact', array $data = array())
    {
        $this->class            = $class;
        $this->container        = $container;
        $this->routeGenerator   = $routeGenerator;
        $this->entityManager    = $this->container->get('doctrine')->getManager();
        $this->type             = $type;
        $this->data             = $data;
    }

    public function buildList()
    {
        if ($this->type === 'compact') {
            $this->buildCompactList();
        }
        elseif ($this->type === 'detail') {
            $this->buildDetailList();
        }
    }

    public function buildCompactList()
    {
        if (is_array($this->data) && count($this->data) > 0) {
            // $this->compactRow = $row;
        }
    }

    public function buildDetailList()
    {
        if (is_array($this->data) && count($this->data) > 0) {
            // $this->detailRow = $row;
        }
    }

    public function getFormattedList()
    {
        if ($this->type === 'compact') {
            return $this->compactData;
        }
        elseif ($this->type === 'detail') {
            return $this->detailData;
        }
        return null;
    }

    public function buildRow(array $row = array())
    {
        $this->row = $row;
        if ($this->type === 'compact') {
            $this->buildCompactRow();
        }
        elseif ($this->type === 'detail') {
            $this->buildDetailRow();
        }
    }

    public function buildCompactRow()
    {
        if (is_array($this->row) && count($this->row) > 0) {
            // $this->compactRow = $row;
        }
    }

    public function buildDetailRow()
    {
        if (is_array($this->row) && count($this->row) > 0) {
            // $this->detailRow = $row;
        }
    }

    public function getFormattedRow()
    {
        if ($this->type === 'compact') {
            return $this->compactRow;
        }
        elseif ($this->type === 'detail') {
            return $this->detailRow;
        }
        return null;
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

        // foreach ($results as $key => $result)
        // {
        //     $results[$key]['fecha'] = $result['fecha']->format('Y-m-d H:i:s A');
        // }

        ////////
        $this->data = $results;
        ////////

        // return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function initialize()
    {
        $this->setEntityOptions();
        $this->defineColumns();
        // $this->buildData();
        // $this->generateData();
    }

    /**
     * {@inheritdoc}
     */
    public function defineEntityOptions()
    {
    }

}