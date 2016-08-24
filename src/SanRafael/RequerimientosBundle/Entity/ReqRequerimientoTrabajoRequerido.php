<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqRequerimientoTrabajoRequerido
 *
 * @ORM\Table(name="req_requerimiento_trabajo_requerido", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_requerimiento_trabajo_requerido", columns={"id_requerimiento", "id_trabajo_requerido"})}, indexes={@ORM\Index(name="IDX_CEE38221EAC1F577", columns={"id_requerimiento"}), @ORM\Index(name="IDX_CEE382212737BBE4", columns={"id_trabajo_requerido"}), @ORM\Index(name="IDX_CEE38221E8234E65", columns={"id_soluciona_requerimiento"})})
 * @ORM\Entity
 */
class ReqRequerimientoTrabajoRequerido
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_requerimiento_trabajo_requerido_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="datetime", nullable=true)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="datetime", nullable=true)
     */
    private $fechaFin;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="solucion", type="text", nullable=true)
     */
    private $solucion;

    /**
     * @var string
     *
     * @ORM\Column(name="comentarios", type="string", length=255, nullable=true)
     */
    private $comentarios;

    /**
     * @var \ReqRequerimiento
     *
     * @ORM\ManyToOne(targetEntity="ReqRequerimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_requerimiento", referencedColumnName="id")
     * })
     */
    private $idRequerimiento;

    /**
     * @var \ReqCtlTrabajoRequerido
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlTrabajoRequerido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_trabajo_requerido", referencedColumnName="id")
     * })
     */
    private $idTrabajoRequerido;

    /**
     * @var \ReqEmpleado
     *
     * @ORM\ManyToOne(targetEntity="ReqEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_soluciona_requerimiento", referencedColumnName="id")
     * })
     */
    private $idSolucionaRequerimiento;


}
