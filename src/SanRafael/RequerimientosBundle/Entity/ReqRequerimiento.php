<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqRequerimiento
 *
 * @ORM\Table(name="req_requerimiento", indexes={@ORM\Index(name="IDX_AFDAE327CB86146E", columns={"id_equipo_solicitud"}), @ORM\Index(name="IDX_AFDAE327498B6188", columns={"id_empleado_solicita"}), @ORM\Index(name="IDX_AFDAE3272BEBEDB7", columns={"id_servicio_solicita"}), @ORM\Index(name="IDX_AFDAE327166585C9", columns={"id_asigna_requerimiento"}), @ORM\Index(name="IDX_AFDAE32769953885", columns={"id_empleado_asignado"}), @ORM\Index(name="IDX_AFDAE327592B0EA1", columns={"id_empleado_registra"}), @ORM\Index(name="IDX_AFDAE327A52AB836", columns={"id_requerimiento_padre"}), @ORM\Index(name="IDX_AFDAE327AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_AFDAE327D8A5832B", columns={"id_user_reg"}), @ORM\Index(name="IDX_AFDAE327CDEEECD8", columns={"id_tipo_trabajo"}), @ORM\Index(name="IDX_AFDAE3272737BBE4", columns={"id_trabajo_requerido"}), @ORM\Index(name="IDX_AFDAE327DDC7A485", columns={"id_area_trabajo"}), @ORM\Index(name="IDX_AFDAE327C2163A3E", columns={"id_solucion_requerimiento"}), @ORM\Index(name="IDX_AFDAE3273B74E832", columns={"id_estado_requerimiento"})})
 * @ORM\Entity(repositoryClass="SanRafael\RequerimientosBundle\Repository\RequerimientoRepository")
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
     * @var \ReqCtlEquipo
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlEquipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_equipo_solicitud", referencedColumnName="id")
     * })
     */
    private $idEquipoSolicitud;

    /**
     * @var \ReqEmpleado
     *
     * @ORM\ManyToOne(targetEntity="ReqEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado_solicita", referencedColumnName="id")
     * })
     */
    private $idEmpleadoSolicita;

    /**
     * @var \ReqAreaServicioAtencion
     *
     * @ORM\ManyToOne(targetEntity="ReqAreaServicioAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_servicio_solicita", referencedColumnName="id")
     * })
     */
    private $idServicioSolicita;

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
     * @ORM\ManyToOne(targetEntity="ReqRequerimiento", inversedBy="requerimientoSubsecuentes")
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

    /**
     * @ORM\OneToMany(targetEntity="ReqRequerimiento", mappedBy="idRequerimientoPadre", cascade={"all"}, orphanRemoval=true)
     */
    private $requerimientoSubsecuentes;

    /**
     * @ORM\OneToMany(targetEntity="ReqRequerimientoTrabajoRequerido", mappedBy="idRequerimiento", cascade={"all"}, orphanRemoval=true)
     */
    private $requerimientoDetalles;

    public function __toString()
    {
        return $this->titulo ? mb_strtoupper(trim($this->titulo), 'utf-8') . ' | ' . $this->fechaHoraInicio->format('Y-m-d H:i:s A') : '';
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fechaHoraReg = new \DateTime('now');
        $this->fechaDigitacion = new \DateTime('now');
        $this->fechaAsignacion = new \DateTime('now');
        $this->fechaRecibido = new \DateTime('now');
        $this->fechaHoraInicio = new \DateTime('now');
        $this->requerimientoSubsecuentes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->requerimientoDetalles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set titulo
     *
     * @param string $titulo
     *
     * @return ReqRequerimiento
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set fechaHoraReg
     *
     * @param \DateTime $fechaHoraReg
     *
     * @return ReqRequerimiento
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
     * @return ReqRequerimiento
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
     * @return ReqRequerimiento
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
     * @return ReqRequerimiento
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
     * Set repetirPor
     *
     * @param integer $repetirPor
     *
     * @return ReqRequerimiento
     */
    public function setRepetirPor($repetirPor)
    {
        $this->repetirPor = $repetirPor;

        return $this;
    }

    /**
     * Get repetirPor
     *
     * @return integer
     */
    public function getRepetirPor()
    {
        return $this->repetirPor;
    }

    /**
     * Set diaCompleto
     *
     * @param boolean $diaCompleto
     *
     * @return ReqRequerimiento
     */
    public function setDiaCompleto($diaCompleto)
    {
        $this->diaCompleto = $diaCompleto;

        return $this;
    }

    /**
     * Get diaCompleto
     *
     * @return boolean
     */
    public function getDiaCompleto()
    {
        return $this->diaCompleto;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return ReqRequerimiento
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return ReqRequerimiento
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
     * Set descripcionRequerimiento
     *
     * @param string $descripcionRequerimiento
     *
     * @return ReqRequerimiento
     */
    public function setDescripcionRequerimiento($descripcionRequerimiento)
    {
        $this->descripcionRequerimiento = $descripcionRequerimiento;

        return $this;
    }

    /**
     * Get descripcionRequerimiento
     *
     * @return string
     */
    public function getDescripcionRequerimiento()
    {
        return $this->descripcionRequerimiento;
    }

    /**
     * Set solucion
     *
     * @param string $solucion
     *
     * @return ReqRequerimiento
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
     * Set fechaAsignacion
     *
     * @param \DateTime $fechaAsignacion
     *
     * @return ReqRequerimiento
     */
    public function setFechaAsignacion($fechaAsignacion)
    {
        $this->fechaAsignacion = $fechaAsignacion;

        return $this;
    }

    /**
     * Get fechaAsignacion
     *
     * @return \DateTime
     */
    public function getFechaAsignacion()
    {
        return $this->fechaAsignacion;
    }

    /**
     * Set fechaRecibido
     *
     * @param \DateTime $fechaRecibido
     *
     * @return ReqRequerimiento
     */
    public function setFechaRecibido($fechaRecibido)
    {
        $this->fechaRecibido = $fechaRecibido;

        return $this;
    }

    /**
     * Get fechaRecibido
     *
     * @return \DateTime
     */
    public function getFechaRecibido()
    {
        return $this->fechaRecibido;
    }

    /**
     * Set fechaDigitacion
     *
     * @param \DateTime $fechaDigitacion
     *
     * @return ReqRequerimiento
     */
    public function setFechaDigitacion($fechaDigitacion)
    {
        $this->fechaDigitacion = $fechaDigitacion;

        return $this;
    }

    /**
     * Get fechaDigitacion
     *
     * @return \DateTime
     */
    public function getFechaDigitacion()
    {
        return $this->fechaDigitacion;
    }

    /**
     * Set idEquipoSolicitud
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlEquipo $idEquipoSolicitud
     *
     * @return ReqRequerimiento
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
     * Set idEmpleadoSolicita
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqEmpleado $idEmpleadoSolicita
     *
     * @return ReqRequerimiento
     */
    public function setIdEmpleadoSolicita(\SanRafael\RequerimientosBundle\Entity\ReqEmpleado $idEmpleadoSolicita = null)
    {
        $this->idEmpleadoSolicita = $idEmpleadoSolicita;

        return $this;
    }

    /**
     * Get idEmpleadoSolicita
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqEmpleado
     */
    public function getIdEmpleadoSolicita()
    {
        return $this->idEmpleadoSolicita;
    }

    /**
     * Set idServicioSolicita
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqAreaServicioAtencion $idServicioSolicita
     *
     * @return ReqRequerimiento
     */
    public function setIdServicioSolicita(\SanRafael\RequerimientosBundle\Entity\ReqAreaServicioAtencion $idServicioSolicita = null)
    {
        $this->idServicioSolicita = $idServicioSolicita;

        return $this;
    }

    /**
     * Get idServicioSolicita
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqAreaServicioAtencion
     */
    public function getIdServicioSolicita()
    {
        return $this->idServicioSolicita;
    }

    /**
     * Set idAsignaRequerimiento
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqEmpleado $idAsignaRequerimiento
     *
     * @return ReqRequerimiento
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
     * @return ReqRequerimiento
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
     * @return ReqRequerimiento
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
     * Set idRequerimientoPadre
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqRequerimiento $idRequerimientoPadre
     *
     * @return ReqRequerimiento
     */
    public function setIdRequerimientoPadre(\SanRafael\RequerimientosBundle\Entity\ReqRequerimiento $idRequerimientoPadre = null)
    {
        $this->idRequerimientoPadre = $idRequerimientoPadre;

        return $this;
    }

    /**
     * Get idRequerimientoPadre
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqRequerimiento
     */
    public function getIdRequerimientoPadre()
    {
        return $this->idRequerimientoPadre;
    }

    /**
     * Set idUserMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserMod
     *
     * @return ReqRequerimiento
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
     * @return ReqRequerimiento
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

    /**
     * Set idTipoTrabajo
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlTipoTrabajo $idTipoTrabajo
     *
     * @return ReqRequerimiento
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
     * @return ReqRequerimiento
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
     * Set idAreaTrabajo
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlAreaTrabajo $idAreaTrabajo
     *
     * @return ReqRequerimiento
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
     * Set idSolucionRequerimiento
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlSolucionRequerimiento $idSolucionRequerimiento
     *
     * @return ReqRequerimiento
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
     * Set idEstadoRequerimiento
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlEstadoRequerimiento $idEstadoRequerimiento
     *
     * @return ReqRequerimiento
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
     * Add requerimientoSubsecuente
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqRequerimiento $requerimientoSubsecuente
     *
     * @return ReqRequerimiento
     */
    public function addRequerimientoSubsecuente(\SanRafael\RequerimientosBundle\Entity\ReqRequerimiento $requerimientoSubsecuente)
    {
        $this->requerimientoSubsecuentes[] = $requerimientoSubsecuente;

        return $this;
    }

    /**
     * Remove requerimientoSubsecuente
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqRequerimiento $requerimientoSubsecuente
     */
    public function removeRequerimientoSubsecuente(\SanRafael\RequerimientosBundle\Entity\ReqRequerimiento $requerimientoSubsecuente)
    {
        $this->requerimientoSubsecuentes->removeElement($requerimientoSubsecuente);
    }

    /**
     * Get requerimientoSubsecuentes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRequerimientoSubsecuentes()
    {
        return $this->requerimientoSubsecuentes;
    }

    /**
     * Add requerimientoDetalle
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqRequerimientoTrabajoRequerido $requerimientoDetalle
     *
     * @return ReqRequerimiento
     */
    public function addRequerimientoDetalle(\SanRafael\RequerimientosBundle\Entity\ReqRequerimientoTrabajoRequerido $requerimientoDetalle)
    {
        $this->requerimientoDetalles[] = $requerimientoDetalle;

        return $this;
    }

    /**
     * Remove requerimientoDetalle
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqRequerimientoTrabajoRequerido $requerimientoDetalle
     */
    public function removeRequerimientoDetalle(\SanRafael\RequerimientosBundle\Entity\ReqRequerimientoTrabajoRequerido $requerimientoDetalle)
    {
        $this->requerimientoDetalles->removeElement($requerimientoDetalle);
    }

    /**
     * Get requerimientoDetalles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRequerimientoDetalles()
    {
        return $this->requerimientoDetalles;
    }
}
