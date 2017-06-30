<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhMenu
 *
 * @ORM\Table(name="blh_menu")
 * @ORM\Entity
 */
class BlhMenu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_menu_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_menu", type="string", length=50, nullable=false)
     */
    private $nombreMenu;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_menu", type="string", length=50, nullable=true)
     */
    private $descripcionMenu;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario", type="integer", nullable=true)
     */
    private $usuario;


}

