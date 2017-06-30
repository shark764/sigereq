<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhBitacora
 *
 * @ORM\Table(name="blh_bitacora")
 * @ORM\Entity
 */
class BlhBitacora
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_bitacora_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_accion", type="date", nullable=false)
     */
    private $fechaAccion;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=14, nullable=false)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="tabla", type="string", length=40, nullable=false)
     */
    private $tabla;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=20, nullable=false)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="accion", type="string", length=10, nullable=false)
     */
    private $accion;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="string", length=500, nullable=true)
     */
    private $detalle;


}

