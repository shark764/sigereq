<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqRequerimientoTrabajoRequerido
 *
 * @ORM\Table(name="req_requerimiento_trabajo_requerido", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_requerimiento_trabajo_requerido", columns={"id_requerimiento", "id_trabajo_requerido"})}, indexes={@ORM\Index(name="IDX_CEE38221DDC7A485", columns={"id_area_trabajo"}), @ORM\Index(name="IDX_CEE38221166585C9", columns={"id_asigna_requerimiento"}), @ORM\Index(name="IDX_CEE3822169953885", columns={"id_empleado_asignado"}), @ORM\Index(name="IDX_CEE38221592B0EA1", columns={"id_empleado_registra"}), @ORM\Index(name="IDX_CEE38221CB86146E", columns={"id_equipo_solicitud"}), @ORM\Index(name="IDX_CEE382213B74E832", columns={"id_estado_requerimiento"}), @ORM\Index(name="IDX_CEE38221EAC1F577", columns={"id_requerimiento"}), @ORM\Index(name="IDX_CEE38221C2163A3E", columns={"id_solucion_requerimiento"}), @ORM\Index(name="IDX_CEE38221E8234E65", columns={"id_soluciona_requerimiento"}), @ORM\Index(name="IDX_CEE38221CDEEECD8", columns={"id_tipo_trabajo"}), @ORM\Index(name="IDX_CEE382212737BBE4", columns={"id_trabajo_requerido"}), @ORM\Index(name="IDX_CEE38221AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_CEE38221D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="SanRafael\RequerimientosBundle\Repository\RequerimientoTrabajoRequeridoRepository")
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
     * @ORM\Column(name="fecha_hora_inicio", type="datetime", nullable=true)
     */
    private $fechaHoraInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_fin", type="datetime", nullable=true)
     */
    private $fechaHoraFin;

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
     * @var \ReqCtlAreaTrabajo
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlAreaTrabajo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_trabajo", referencedColumnName="id")
     * })
     */
    private $idAreaTrabajo;

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
     * @var \ReqCtlEquipo
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlEquipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_equipo_solicitud", referencedColumnName="id")
     * })
     */
    private $idEquipoSolicitud;

    /**
     * @var \ReqCtlEstadoRequerimiento
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlEstadoRequerimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_requerimiento", referencedColumnName="id")
     * })
     */
    private $idEstadoRequerimiento;

    /**
     * @var \ReqRequerimiento
     *
     * @ORM\ManyToOne(targetEntity="ReqRequerimiento", inversedBy="requerimientoDetalles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_requerimiento", referencedColumnName="id")
     * })
     */
    private $idRequerimiento;

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
     * @var \ReqEmpleado
     *
     * @ORM\ManyToOne(targetEntity="ReqEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_soluciona_requerimiento", referencedColumnName="id")
     * })
     */
    private $idSolucionaRequerimiento;

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

    public function __toString()
    {
        return $this->idTrabajoRequerido ? mb_strtoupper(trim($this->idTrabajoRequerido), 'utf-8') . ' | ' . $this->fechaHoraInicio->format('Y-m-d H:i:s A') : '';
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fechaHoraReg = new \DateTime('now');
        $this->fechaAsignacion = new \DateTime('now');
        $this->fechaRecibido = new \DateTime('now');
        $this->fechaHoraInicio = new \DateTime('now');
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fechaHoraReg
     *
     * @param \DateTime $fechaHoraReg
     *
     * @return ReqRequerimientoTrabajoRequerido
     */
    public function setFechaHoraReg($fechaHoraReg)
    {
        $this->fechaHoraReg = $fechaHoraReg;

        return $this;
    }

    /**
     * Get fechaHoraReg
     *
     * @return \DateTime
     */
    public function getFechaHoraReg()
    {
        return $this->fechaHoraReg;
    }

    /**
     * Set fechaHoraMod
     *
     * @param \DateTime $fechaHoraMod
     *
     * @return ReqRequerimientoTrabajoRequerido
     */
    public function setFechaHoraMod($fechaHoraMod)
    {
        $this->fechaHoraMod = $fechaHoraMod;

        return $this;
    }

    /**
     * Get fechaHoraMod
     *
     * @return \DateTime
     */
    public function getFechaHoraMod()
    {
        return $this->fechaHoraMod;
    }

    /**
     * Set fechaHoraInicio
     *
     * @param \DateTime $fechaHoraInicio
     *
     * @return ReqRequerimientoTrabajoRequerido
     */
    public function setFechaHoraInicio($fechaHoraInicio)
    {
        $this->fechaHoraInicio = $fechaHoraInicio;

        return $this;
    }

    /**
     * Get fechaHoraInicio
     *
     * @return \DateTime
     */
    public function getFechaHoraInicio()
    {
        return $this->fechaHoraInicio;
    }

    /**
     * Set fechaHoraFin
     *
     * @param \DateTime $fechaHoraFin
     *
     * @return ReqRequerimientoTrabajoRequerido
     */
    public function setFechaHoraFin($fechaHoraFin)
    {
        $this->fechaHoraFin = $fechaHoraFin;

        return $this;
    }

    /**
     * Get fechaHoraFin
     *
     * @return \DateTime
     */
    public function getFechaHoraFin()
    {
        return $this->fechaHoraFin;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return ReqRequerimientoTrabajoRequerido
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set solucion
     *
     * @param string $solucion
     *
     * @return ReqRequerimientoTrabajoRequerido
     */
    public function setSolucion($solucion)
    {
        $this->solucion = $solucion;

        return $this;
    }

    /**
     * Get solucion
     *
     * @return string
     */
    public function getSolucion()
    {
        return $this->solucion;
    }

    /**
     * Set comentarios
     *
     * @param string $comentarios
     *
     * @return ReqRequerimientoTrabajoRequerido
     */
    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;

        return $this;
    }

    /**
     * Get comentarios
     *
     * @return string
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * Set idAreaTrabajo
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlAreaTrabajo $idAreaTrabajo
     *
     * @return ReqRequerimientoTrabajoRequerido
     */
    public function setIdAreaTrabajo(\SanRafael\RequerimientosBundle\Entity\ReqCtlAreaTrabajo $idAreaTrabajo = null)
    {
        $this->idAreaTrabajo = $idAreaTrabajo;

        return $this;
    }

    /**
     * Get idAreaTrabajo
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlAreaTrabajo
     */
    public function getIdAreaTrabajo()
    {
        return $this->idAreaTrabajo;
    }

    /**
     * Set idAsignaRequerimiento
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqEmpleado $idAsignaRequerimiento
     *
     * @return ReqRequerimientoTrabajoRequerido
     */
    public function setIdAsignaRequerimiento(\SanRafael\RequerimientosBundle\Entity\ReqEmpleado $idAsignaRequerimiento = null)
    {
        $this->idAsignaRequerimiento = $idAsignaRequerimiento;

        return $this;
    }

    /**
     * Get idAsignaRequerimiento
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqEmpleado
     */
    public function getIdAsignaRequerimiento()
    {
        return $this->idAsignaRequerimiento;
    }

    /**
     * Set idEmpleadoAsignado
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqEmpleado $idEmpleadoAsignado
     *
     * @return ReqRequerimientoTrabajoRequerido
     */
    public function setIdEmpleadoAsignado(\SanRafael\RequerimientosBundle\Entity\ReqEmpleado $idEmpleadoAsignado = null)
    {
        $this->idEmpleadoAsignado = $idEmpleadoAsignado;

        return $this;
    }

    /**
     * Get idEmpleadoAsignado
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqEmpleado
     */
    public function getIdEmpleadoAsignado()
    {
        return $this->idEmpleadoAsignado;
    }

    /**
     * Set idEmpleadoRegistra
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqEmpleado $idEmpleadoRegistra
     *
     * @return ReqRequerimientoTrabajoRequerido
     */
    public function setIdEmpleadoRegistra(\SanRafael\RequerimientosBundle\Entity\ReqEmpleado $idEmpleadoRegistra = null)
    {
        $this->idEmpleadoRegistra = $idEmpleadoRegistra;

        return $this;
    }

    /**
     * Get idEmpleadoRegistra
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqEmpleado
     */
    public function getIdEmpleadoRegistra()
    {
        return $this->idEmpleadoRegistra;
    }

    /**
     * Set idEquipoSolicitud
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlEquipo $idEquipoSolicitud
     *
     * @return ReqRequerimientoTrabajoRequerido
     */
    public function setIdEquipoSolicitud(\SanRafael\RequerimientosBundle\Entity\ReqCtlEquipo $idEquipoSolicitud = null)
    {
        $this->idEquipoSolicitud = $idEquipoSolicitud;

        return $this;
    }

    /**
     * Get idEquipoSolicitud
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlEquipo
     */
    public function getIdEquipoSolicitud()
    {
        return $this->idEquipoSolicitud;
    }

    /**
     * Set idEstadoRequerimiento
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlEstadoRequerimiento $idEstadoRequerimiento
     *
     * @return ReqRequerimientoTrabajoRequerido
     */
    public function setIdEstadoRequerimiento(\SanRafael\RequerimientosBundle\Entity\ReqCtlEstadoRequerimiento $idEstadoRequerimiento = null)
    {
        $this->idEstadoRequerimiento = $idEstadoRequerimiento;

        return $this;
    }

    /**
     * Get idEstadoRequerimiento
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlEstadoRequerimiento
     */
    public function getIdEstadoRequerimiento()
    {
        return $this->idEstadoRequerimiento;
    }

    /**
     * Set idRequerimiento
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqRequerimiento $idRequerimiento
     *
     * @return ReqRequerimientoTrabajoRequerido
     */
    public function setIdRequerimiento(\SanRafael\RequerimientosBundle\Entity\ReqRequerimiento $idRequerimiento = null)
    {
        $this->idRequerimiento = $idRequerimiento;

        return $this;
    }

    /**
     * Get idRequerimiento
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqRequerimiento
     */
    public function getIdRequerimiento()
    {
        return $this->idRequerimiento;
    }

    /**
     * Set idSolucionRequerimiento
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlSolucionRequerimiento $idSolucionRequerimiento
     *
     * @return ReqRequerimientoTrabajoRequerido
     */
    public function setIdSolucionRequerimiento(\SanRafael\RequerimientosBundle\Entity\ReqCtlSolucionRequerimiento $idSolucionRequerimiento = null)
    {
        $this->idSolucionRequerimiento = $idSolucionRequerimiento;

        return $this;
    }

    /**
     * Get idSolucionRequerimiento
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlSolucionRequerimiento
     */
    public function getIdSolucionRequerimiento()
    {
        return $this->idSolucionRequerimiento;
    }

    /**
     * Set idSolucionaRequerimiento
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqEmpleado $idSolucionaRequerimiento
     *
     * @return ReqRequerimientoTrabajoRequerido
     */
    public function setIdSolucionaRequerimiento(\SanRafael\RequerimientosBundle\Entity\ReqEmpleado $idSolucionaRequerimiento = null)
    {
        $this->idSolucionaRequerimiento = $idSolucionaRequerimiento;

        return $this;
    }

    /**
     * Get idSolucionaRequerimiento
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqEmpleado
     */
    public function getIdSolucionaRequerimiento()
    {
        return $this->idSolucionaRequerimiento;
    }

    /**
     * Set idTipoTrabajo
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlTipoTrabajo $idTipoTrabajo
     *
     * @return ReqRequerimientoTrabajoRequerido
     */
    public function setIdTipoTrabajo(\SanRafael\RequerimientosBundle\Entity\ReqCtlTipoTrabajo $idTipoTrabajo = null)
    {
        $this->idTipoTrabajo = $idTipoTrabajo;

        return $this;
    }

    /**
     * Get idTipoTrabajo
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlTipoTrabajo
     */
    public function getIdTipoTrabajo()
    {
        return $this->idTipoTrabajo;
    }

    /**
     * Set idTrabajoRequerido
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlTrabajoRequerido $idTrabajoRequerido
     *
     * @return ReqRequerimientoTrabajoRequerido
     */
    public function setIdTrabajoRequerido(\SanRafael\RequerimientosBundle\Entity\ReqCtlTrabajoRequerido $idTrabajoRequerido = null)
    {
        $this->idTrabajoRequerido = $idTrabajoRequerido;

        return $this;
    }

    /**
     * Get idTrabajoRequerido
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlTrabajoRequerido
     */
    public function getIdTrabajoRequerido()
    {
        return $this->idTrabajoRequerido;
    }

    /**
     * Set idUserMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserMod
     *
     * @return ReqRequerimientoTrabajoRequerido
     */
    public function setIdUserMod(\Application\Sonata\UserBundle\Entity\User $idUserMod = null)
    {
        $this->idUserMod = $idUserMod;

        return $this;
    }

    /**
     * Get idUserMod
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getIdUserMod()
    {
        return $this->idUserMod;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     *
     * @return ReqRequerimientoTrabajoRequerido
     */
    public function setIdUserReg(\Application\Sonata\UserBundle\Entity\User $idUserReg = null)
    {
        $this->idUserReg = $idUserReg;

        return $this;
    }

    /**
     * Get idUserReg
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getIdUserReg()
    {
        return $this->idUserReg;
    }
}
