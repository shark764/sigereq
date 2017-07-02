<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Minsal\SiblhBundle\Entity;

/**
 * EntityInterface should be implemented by classes that depends on a Container.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @api
 */
interface EntityInterface
{
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId();

    /**
     * Constructor
     */
    public function __construct();
    
    /**
     * Text converter for the Entity.
     */
    public function __toString();
    
    /**
     * Text converter for the Entity (Second form).
     */
    public function getPresentacionEntidad();
    
    /**
     * Text converter for the Entity (Third form).
     */
    public function getFormatoPresentacionEntidad();

}