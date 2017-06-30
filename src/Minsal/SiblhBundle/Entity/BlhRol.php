<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhRol
 *
 * @ORM\Table(name="blh_rol")
 * @ORM\Entity
 */
class BlhRol
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_rol_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_rol", type="string", length=30, nullable=false)
     */
    private $nombreRol;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_rol", type="string", length=50, nullable=true)
     */
    private $descripcionRol;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario", type="integer", nullable=true)
     */
    private $usuario;


}

