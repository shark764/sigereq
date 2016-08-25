<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqRequerimiento
 *
 * @ORM\Table(name="req_requerimiento", indexes={@ORM\Index(name="IDX_AFDAE327166585C9", columns={"id_asigna_requerimiento"}), @ORM\Index(name="IDX_AFDAE32769953885", columns={"id_empleado_asignado"}), @ORM\Index(name="IDX_AFDAE327592B0EA1", columns={"id_empleado_registra"}), @ORM\Index(name="IDX_AFDAE327A52AB836", columns={"id_requerimiento_padre"}), @ORM\Index(name="IDX_AFDAE327AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_AFDAE327D8A5832B", columns={"id_user_reg"}), @ORM\Index(name="IDX_AFDAE327CDEEECD8", columns={"id_tipo_trabajo"}), @ORM\Index(name="IDX_AFDAE3272737BBE4", columns={"id_trabajo_requerido"}), @ORM\Index(name="IDX_AFDAE327DDC7A485", columns={"id_area_trabajo"}), @ORM\Index(name="IDX_AFDAE327C2163A3E", columns={"id_solucion_requerimiento"}), @ORM\Index(name="IDX_AFDAE3273B74E832", columns={"id_estado_requerimiento"})})
 * @ORM\Entity
 */
class ReqRequerimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_requerimiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255, nullable=false)
     */
    private $titulo;

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
     * @ORM\Column(name="fecha_hora_inicio", type="datetime", nullable=false)
     */
    private $fechaHoraInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_fin", type="datetime", nullable=false)
     */
    private $fechaHoraFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="repetir_por", type="smallint", nullable=true)
     */
    private $repetirPor = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="dia_completo", type="boolean", nullable=true)
     */
    private $diaCompleto = false;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=15, nullable=true)
     */
    private $color = '#2a5469';

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_equipo_solicitud", type="bigint", nullable=true)
     */
    private $idEquipoSolicitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_empleado_solicita", type="smallint", nullable=true)
     */
    private $idEmpleadoSolicita;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_servicio_solicita", type="smallint", nullable=true)
     */
    private $idServicioSolicita;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_requerimiento", type="text", nullable=true)
     */
    private $descripcionRequerimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="solucion", type="text", nullable=true)
     */
    private $solucion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_asignacion", type="datetime", nullable=true)
     */
    private $fechaAsignacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_recibido", type="datetime", nullable=true)
     */
    private $fechaRecibido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_digitacion", type="datetime", nullable=true)
     */
    private $fechaDigitacion;

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
     * @var \ReqEmpleado
     *
     * @ORM\ManyToOne(targetEntity="ReqEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado_registra", referencedColumnName="id")
     * })
     */
    private $idEmpleadoRegistra;

    /**
     * @var \ReqRequerimiento
     *
     * @ORM\ManyToOne(targetEntity="ReqRequerimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_requerimiento_padre", referencedColumnName="id")
     * })
     */
    private $idRequerimientoPadre;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_mod", referencedColumnName="id")
     * })
     */
    private $idUserMod;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_reg", referencedColumnName="id")
     * })
     */
    private $idUserReg;

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

