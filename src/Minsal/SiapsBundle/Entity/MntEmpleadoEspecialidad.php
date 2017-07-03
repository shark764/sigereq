<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntEmpleadoEspecialidad
 *
 * @ORM\Table(name="mnt_empleado_especialidad", indexes={@ORM\Index(name="IDX_9CBC4EB1695EA351", columns={"id_atencion"}), @ORM\Index(name="IDX_9CBC4EB1890253C7", columns={"id_empleado"})})
 * @ORM\Entity
 */
class MntEmpleadoEspecialidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_empleado_especialidad_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \CtlAtencion
     *
     * @ORM\ManyToOne(targetEntity="CtlAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_atencion", referencedColumnName="id")
     * })
     */
    private $idAtencion;

    /**
     * @var \MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado", referencedColumnName="id")
     * })
     */
    private $idEmpleado;


}

