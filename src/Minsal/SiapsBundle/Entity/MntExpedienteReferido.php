<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntExpedienteReferido
 *
 * @ORM\Table(name="mnt_expediente_referido", indexes={@ORM\Index(name="IDX_56FC0F12CC9E1B67", columns={"id_creacion_expediente"}), @ORM\Index(name="IDX_56FC0F127DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_56FC0F125916625F", columns={"id_establecimiento_origen"}), @ORM\Index(name="IDX_56FC0F12D7D198FB", columns={"id_referido"})})
 * @ORM\Entity
 */
class MntExpedienteReferido
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_expediente_referido_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=25, nullable=false)
     */
    private $numero;

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
     * @var \CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento_origen", referencedColumnName="id")
     * })
     */
    private $idEstablecimientoOrigen;

    /**
     * @var \MntPacienteReferido
     *
     * @ORM\ManyToOne(targetEntity="MntPacienteReferido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_referido", referencedColumnName="id")
     * })
     */
    private $idReferido;


}

