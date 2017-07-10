<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Minsal\SiblhBundle\Generator\ListViewGenerator\Formatter;

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
 * Formatter
 *
 * @author farid
 */
class Formatter /*implements ListViewGeneratorInterface*/
{
    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Sets the string formatted.
     *
     * @param bool
     *
     * @api
     */
    public function booleanFormatter($value = false)
    {
        $return = '<span class="label label-' . (!$value ? 'emergency'/*'danger'*/ : 'primary-v4') . '">' . (!$value ? 'NO' : 'SÍ') . '</span>';
        return $return;
    }

    /**
     * Sets the string formatted.
     *
     * @param bool
     *
     * @api
     */
    public function dateFormatter($value, $format = 'datetime', $display = 'd/m/Y h:i:s A'/*'Y-m-d H:i:s A'*/)
    {
        $dtformat   = $format === 'date' ? 'Y-m-d' : ($format === 'time' ? 'H:i:s' : 'Y-m-d H:i:s');
        // $dtformat   = $format === 'date' ? 'd/m/Y' : ($format === 'time' ? 'H:i:s' : 'd/m/Y H:i:s');
        $dt         = \DateTime::createFromFormat($dtformat, $value);

        if ($format === 'date') {
            $display = 'd/m/Y';
        } elseif ($format === 'time') {
            $display = 'h:i:s A';
        }

        // \DateTime::createFromFormat('Y-m-d H:i:s', $r['fecha_registro'])->format('Y-m-d H:i:s A')
        return $dt->format($display);
    }

    /**
     * Sets the string formatted.
     *
     * @param bool
     *
     * @api
     */
    public function colorFormatter($value = false)
    {
        $return = '<div style="-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background-color:' . $value . '">&nbsp;</div>';
        return $return;
    }

    /**
     * Sets the string formatted.
     *
     * @param bool
     *
     * @api
     */
    public function patientFormatter($value = null, $local = true)
    {
        if (!$local) {
            $return = '<span class="text-dark-emergency">' . $value . '</span>';
            return $return;
        }
        return $value;
    }

    /**
     * Sets the string formatted.
     *
     * @param bool
     *
     * @api
     */
    public function fullPatientFormatter($value = null, $local = true)
    {
        if (!$local) {
            $return = '<button type="button" class="btn btn-emergency btn-circle-round" disabled><i class="glyphicon glyphicon-user"></i></button> <span class="text-dark-emergency">' . $value . '</span>';
            return $return;
        }
        return '<button type="button" class="btn btn-xray-awesome-blue btn-circle-round" disabled><i class="glyphicon glyphicon-user"></i></button> ' . $value;
    }

    /**
     * Sets the string formatted.
     *
     * @param bool
     *
     * @api
     */
    public function procedureStateFormatter($value = null, $cod = 'ALM')
    {
        if ($cod === 'ALM') {
            return '<button type="button" class="btn btn-success-v3 btn-circle-round" disabled><i class="glyphicon glyphicon-cloud"></i></button> <button type="button" class="btn btn-success-v3 btn-circle-round" disabled><i class="glyphicon glyphicon-ok"></i></button>' /*. $value*/;
        }
        elseif ($cod === 'FSA') {
            return '<button type="button" class="btn btn-element-v2 btn-circle-round" disabled><i class="glyphicon glyphicon-print"></i></button>' /*. $value*/;
        }
        return '<button type="button" class="btn btn-warning btn-circle-round" disabled><i class="glyphicon glyphicon-wrench"></i></button>' /*. $value*/;
    }

}