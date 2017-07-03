<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntExpediente
 *
 * @ORM\Table(name="mnt_expediente", uniqueConstraints={@ORM\UniqueConstraint(name="idx_id_id_paciente", columns={"id", "id_paciente"}), @ORM\UniqueConstraint(name="idx_numero_expediente", columns={"numero"})}, indexes={@ORM\Index(name="IDX_E4950F57CC9E1B67", columns={"id_creacion_expediente"}), @ORM\Index(name="IDX_E4950F577DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_E4950F57961045CB", columns={"id_paciente"})})
 * @ORM\Entity
 */
class MntExpediente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_expediente_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=12, nullable=false)
     */
    private $numero;

    /**
     * @var boolean
     *
     * @ORM\Column(name="habilitado", type="boolean", nullable=false)
     */
    private $habilitado = true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="date", nullable=true)
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_creacion", type="time", nullable=true)
     */
    private $horaCreacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="numero_temporal", type="boolean", nullable=true)
     */
    private $numeroTemporal = false;

    /**
     * @var \CtlCreacionExpediente
     *
     * @ORM\ManyToOne(targetEntity="CtlCreacionExpediente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_creacion_expediente", referencedColumnName="id")
     * })
     */
    private $idCreacionExpediente;

    /**
     * @var \CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     */
    private $idEstablecimiento;

    /**
     * @var \MntPaciente
     *
     * @ORM\ManyToOne(targetEntity="MntPaciente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_paciente", referencedColumnName="id")
     * })
     */
    private $idPaciente;


}

