<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqRequerimientoTrabajoRequerido
 *
 * @ORM\Table(name="req_requerimiento_trabajo_requerido", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_requerimiento_trabajo_requerido", columns={"id_requerimiento", "id_trabajo_requerido"})}, indexes={@ORM\Index(name="IDX_CEE38221CB86146E", columns={"id_equipo_solicitud"}), @ORM\Index(name="IDX_CEE38221EAC1F577", columns={"id_requerimiento"}), @ORM\Index(name="IDX_CEE38221E8234E65", columns={"id_soluciona_requerimiento"}), @ORM\Index(name="IDX_CEE38221166585C9", columns={"id_asigna_requerimiento"}), @ORM\Index(name="IDX_CEE3822169953885", columns={"id_empleado_asignado"}), @ORM\Index(name="IDX_CEE38221D8A5832B", columns={"id_user_reg"}), @ORM\Index(name="IDX_CEE38221AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_CEE38221592B0EA1", columns={"id_empleado_registra"}), @ORM\Index(name="IDX_CEE38221CDEEECD8", columns={"id_tipo_trabajo"}), @ORM\Index(name="IDX_CEE382212737BBE4", columns={"id_trabajo_requerido"}), @ORM\Index(name="IDX_CEE38221DDC7A485", columns={"id_area_trabajo"}), @ORM\Index(name="IDX_CEE38221C2163A3E", columns={"id_solucion_requerimiento"}), @ORM\Index(name="IDX_CEE382213B74E832", columns={"id_estado_requerimiento"})})
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
     * @ORM\Column(name="fecha_hora_reg", type="datetime", nullable=false)
     */
    private $fechaHoraReg = '(now())::timestamp(0) without time zone';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_mod", type="datetime", nullable=true)
     */
    private $fechaHoraMod;

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
     * @var \ReqCtlEquipo
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlEquipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_equipo_solicitud", referencedColumnName="id")
     * })
     */
    private $idEquipoSolicitud;

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
     * @var \ReqEmpleado
     *
     * @ORM\ManyToOne(targetEntity="ReqEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_soluciona_requerimiento", referencedColumnName="id")
     * })
     */
    private $idSolucionaRequerimiento;

    /**
     * @var \ReqEmpleado
     *
     * @ORM\ManyToOne(targetEntity="ReqEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_asigna_requerimiento", referencedColumnName="id")
     * })
     */
    private $idAsignaRequerimiento;

    /**
     * @var \ReqEmpleado
     *
     * @ORM\ManyToOne(targetEntity="ReqEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado_asignado", referencedColumnName="id")
     * })
     */
    private $idEmpleadoAsignado;

    /**
     * @var \FosUserUser
     *
     * @ORM\ManyToOne(targetEntity="FosUserUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_reg", referencedColumnName="id")
     * })
     */
    private $idUserReg;

    /**
     * @var \FosUserUser
     *
     * @ORM\ManyToOne(targetEntity="FosUserUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_mod", referencedColumnName="id")
     * })
     */
    private $idUserMod;

    /**
     * @var \ReqEmpleado
     *
     * @ORM\ManyToOne(targetEntity="ReqEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado_registra", referencedColumnName="id")
     * })
     */
    private $idEmpleadoRegistra;

    /**
     * @var \ReqCtlTipoTrabajo
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlTipoTrabajo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_trabajo", referencedColumnName="id")
     * })
     */
    private $idTipoTrabajo;

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
     * @var \ReqCtlAreaTrabajo
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlAreaTrabajo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_trabajo", referencedColumnName="id")
     * })
     */
    private $idAreaTrabajo;

    /**
     * @var \ReqCtlSolucionRequerimiento
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlSolucionRequerimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solucion_requerimiento", referencedColumnName="id")
     * })
     */
    private $idSolucionRequerimiento;

    /**
     * @var \ReqCtlEstadoRequerimiento
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlEstadoRequerimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_requerimiento", referencedColumnName="id")
     * })
     */
    private $idEstadoRequerimiento;


}

