<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ReqEmpleado
 *
 * @ORM\Table(name="req_empleado", indexes={@ORM\Index(name="IDX_9ABCE344F6BCBD1", columns={"id_area_servicio_atencion"}), @ORM\Index(name="IDX_9ABCE3444F664059", columns={"id_cargo_empleado"}), @ORM\Index(name="IDX_9ABCE3447D36E8FB", columns={"id_jefe_inmediato"}), @ORM\Index(name="IDX_9ABCE344A7194A90", columns={"id_sexo"}), @ORM\Index(name="IDX_9ABCE344B13434FE", columns={"id_tipo_empleado"}), @ORM\Index(name="IDX_9ABCE344AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_9ABCE344D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="SanRafael\RequerimientosBundle\Repository\EmpleadoRepository")
 */
class ReqEmpleado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_empleado_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message = "Por favor introduzca un valor")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message = "Por favor introduzca un valor")
     */
    private $apellido;

    /**
     * @var boolean
     *
     * @ORM\Column(name="habilitado", type="boolean", nullable=true)
     */
    private $habilitado = true;

    /**
     * @var string
     *
     * @ORM\Column(name="correo_electronico", type="string", length=100, nullable=true)
     */
    private $correoElectronico;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_casa", type="string", length=10, nullable=true)
     */
    private $telefonoCasa;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_celular", type="string", length=10, nullable=true)
     */
    private $telefonoCelular;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=true)
     */
    private $fechaNacimiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_reg", type="datetime", nullable=true)
     */
    private $fechaHoraReg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_mod", type="datetime", nullable=true)
     */
    private $fechaHoraMod;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_nacimiento", type="time", nullable=true)
     */
    private $horaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="correo_institucional", type="string", length=100, nullable=true)
     */
    private $correoInstitucional;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_contratacion", type="datetime", nullable=true)
     */
    private $fechaContratacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicia_labores", type="datetime", nullable=true)
     */
    private $fechaIniciaLabores;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_finaliza_labores", type="datetime", nullable=true)
     */
    private $fechaFinalizaLabores;

    /**
     * @var \ReqAreaServicioAtencion
     *
     * @ORM\ManyToOne(targetEntity="ReqAreaServicioAtencion", inversedBy="areaServicioEmpleados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_servicio_atencion", referencedColumnName="id")
     * })
     */
    private $idAreaServicioAtencion;

    /**
     * @var \ReqCtlCargoEmpleado
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlCargoEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cargo_empleado", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "Por favor seleccione un elemento")
     */
    private $idCargoEmpleado;

    /**
     * @var \ReqEmpleado
     *
     * @ORM\ManyToOne(targetEntity="ReqEmpleado", inversedBy="empleadoSubordinados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_jefe_inmediato", referencedColumnName="id")
     * })
     */
    private $idJefeInmediato;

    /**
     * @var \ReqCtlSexo
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlSexo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sexo", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "Por favor seleccione un elemento")
     */
    private $idSexo;

    /**
     * @var \ReqCtlTipoEmpleado
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlTipoEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_empleado", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "Por favor seleccione un elemento")
     */
    private $idTipoEmpleado;

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
     * @ORM\OneToMany(targetEntity="ReqEmpleado", mappedBy="idJefeInmediato", cascade={"all"}, orphanRemoval=true)
     */
    private $empleadoSubordinados;

    /**
     * @ORM\OneToMany(targetEntity="ReqEmpleadoAreaServicioAtencion", mappedBy="idEmpleado", cascade={"all"}, orphanRemoval=true)
     */
    private $empleadoServiciosLabora;

    public function __toString()
    {
        return mb_strtoupper(trim($this->apellido), 'utf-8') . ', ' . mb_strtoupper(trim($this->nombre), 'utf-8');
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fechaHoraReg = new \DateTime('now');
        $this->fechaContratacion = new \DateTime('now');
        $this->fechaIniciaLabores = new \DateTime('now');
        $this->empleadoSubordinados = new \Doctrine\Common\Collections\ArrayCollection();
        $this->empleadoServiciosLabora = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return ReqEmpleado
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     *
     * @return ReqEmpleado
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set habilitado
     *
     * @param boolean $habilitado
     *
     * @return ReqEmpleado
     */
    public function setHabilitado($habilitado)
    {
        $this->habilitado = $habilitado;

        return $this;
    }

    /**
     * Get habilitado
     *
     * @return boolean
     */
    public function getHabilitado()
    {
        return $this->habilitado;
    }

    /**
     * Set correoElectronico
     *
     * @param string $correoElectronico
     *
     * @return ReqEmpleado
     */
    public function setCorreoElectronico($correoElectronico)
    {
        $this->correoElectronico = $correoElectronico;

        return $this;
    }

    /**
     * Get correoElectronico
     *
     * @return string
     */
    public function getCorreoElectronico()
    {
        return $this->correoElectronico;
    }

    /**
     * Set telefonoCasa
     *
     * @param string $telefonoCasa
     *
     * @return ReqEmpleado
     */
    public function setTelefonoCasa($telefonoCasa)
    {
        $this->telefonoCasa = $telefonoCasa;

        return $this;
    }

    /**
     * Get telefonoCasa
     *
     * @return string
     */
    public function getTelefonoCasa()
    {
        return $this->telefonoCasa;
    }

    /**
     * Set telefonoCelular
     *
     * @param string $telefonoCelular
     *
     * @return ReqEmpleado
     */
    public function setTelefonoCelular($telefonoCelular)
    {
        $this->telefonoCelular = $telefonoCelular;

        return $this;
    }

    /**
     * Get telefonoCelular
     *
     * @return string
     */
    public function getTelefonoCelular()
    {
        return $this->telefonoCelular;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return ReqEmpleado
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set fechaHoraReg
     *
     * @param \DateTime $fechaHoraReg
     *
     * @return ReqEmpleado
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
     * @return ReqEmpleado
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
     * Set horaNacimiento
     *
     * @param \DateTime $horaNacimiento
     *
     * @return ReqEmpleado
     */
    public function setHoraNacimiento($horaNacimiento)
    {
        $this->horaNacimiento = $horaNacimiento;

        return $this;
    }

    /**
     * Get horaNacimiento
     *
     * @return \DateTime
     */
    public function getHoraNacimiento()
    {
        return $this->horaNacimiento;
    }

    /**
     * Set correoInstitucional
     *
     * @param string $correoInstitucional
     *
     * @return ReqEmpleado
     */
    public function setCorreoInstitucional($correoInstitucional)
    {
        $this->correoInstitucional = $correoInstitucional;

        return $this;
    }

    /**
     * Get correoInstitucional
     *
     * @return string
     */
    public function getCorreoInstitucional()
    {
        return $this->correoInstitucional;
    }

    /**
     * Set fechaContratacion
     *
     * @param \DateTime $fechaContratacion
     *
     * @return ReqEmpleado
     */
    public function setFechaContratacion($fechaContratacion)
    {
        $this->fechaContratacion = $fechaContratacion;

        return $this;
    }

    /**
     * Get fechaContratacion
     *
     * @return \DateTime
     */
    public function getFechaContratacion()
    {
        return $this->fechaContratacion;
    }

    /**
     * Set fechaIniciaLabores
     *
     * @param \DateTime $fechaIniciaLabores
     *
     * @return ReqEmpleado
     */
    public function setFechaIniciaLabores($fechaIniciaLabores)
    {
        $this->fechaIniciaLabores = $fechaIniciaLabores;

        return $this;
    }

    /**
     * Get fechaIniciaLabores
     *
     * @return \DateTime
     */
    public function getFechaIniciaLabores()
    {
        return $this->fechaIniciaLabores;
    }

    /**
     * Set fechaFinalizaLabores
     *
     * @param \DateTime $fechaFinalizaLabores
     *
     * @return ReqEmpleado
     */
    public function setFechaFinalizaLabores($fechaFinalizaLabores)
    {
        $this->fechaFinalizaLabores = $fechaFinalizaLabores;

        return $this;
    }

    /**
     * Get fechaFinalizaLabores
     *
     * @return \DateTime
     */
    public function getFechaFinalizaLabores()
    {
        return $this->fechaFinalizaLabores;
    }

    /**
     * Set idAreaServicioAtencion
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqAreaServicioAtencion $idAreaServicioAtencion
     *
     * @return ReqEmpleado
     */
    public function setIdAreaServicioAtencion(\SanRafael\RequerimientosBundle\Entity\ReqAreaServicioAtencion $idAreaServicioAtencion = null)
    {
        $this->idAreaServicioAtencion = $idAreaServicioAtencion;

        return $this;
    }

    /**
     * Get idAreaServicioAtencion
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqAreaServicioAtencion
     */
    public function getIdAreaServicioAtencion()
    {
        return $this->idAreaServicioAtencion;
    }

    /**
     * Set idCargoEmpleado
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlCargoEmpleado $idCargoEmpleado
     *
     * @return ReqEmpleado
     */
    public function setIdCargoEmpleado(\SanRafael\RequerimientosBundle\Entity\ReqCtlCargoEmpleado $idCargoEmpleado = null)
    {
        $this->idCargoEmpleado = $idCargoEmpleado;

        return $this;
    }

    /**
     * Get idCargoEmpleado
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlCargoEmpleado
     */
    public function getIdCargoEmpleado()
    {
        return $this->idCargoEmpleado;
    }

    /**
     * Set idJefeInmediato
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqEmpleado $idJefeInmediato
     *
     * @return ReqEmpleado
     */
    public function setIdJefeInmediato(\SanRafael\RequerimientosBundle\Entity\ReqEmpleado $idJefeInmediato = null)
    {
        $this->idJefeInmediato = $idJefeInmediato;

        return $this;
    }

    /**
     * Get idJefeInmediato
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqEmpleado
     */
    public function getIdJefeInmediato()
    {
        return $this->idJefeInmediato;
    }

    /**
     * Set idSexo
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlSexo $idSexo
     *
     * @return ReqEmpleado
     */
    public function setIdSexo(\SanRafael\RequerimientosBundle\Entity\ReqCtlSexo $idSexo = null)
    {
        $this->idSexo = $idSexo;

        return $this;
    }

    /**
     * Get idSexo
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlSexo
     */
    public function getIdSexo()
    {
        return $this->idSexo;
    }

    /**
     * Set idTipoEmpleado
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlTipoEmpleado $idTipoEmpleado
     *
     * @return ReqEmpleado
     */
    public function setIdTipoEmpleado(\SanRafael\RequerimientosBundle\Entity\ReqCtlTipoEmpleado $idTipoEmpleado = null)
    {
        $this->idTipoEmpleado = $idTipoEmpleado;

        return $this;
    }

    /**
     * Get idTipoEmpleado
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlTipoEmpleado
     */
    public function getIdTipoEmpleado()
    {
        return $this->idTipoEmpleado;
    }

    /**
     * Set idUserMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserMod
     *
     * @return ReqEmpleado
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
     * @return ReqEmpleado
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
     * Add empleadoSubordinado
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqEmpleado $empleadoSubordinado
     *
     * @return ReqEmpleado
     */
    public function addEmpleadoSubordinado(\SanRafael\RequerimientosBundle\Entity\ReqEmpleado $empleadoSubordinado)
    {
        $this->empleadoSubordinados[] = $empleadoSubordinado;

        return $this;
    }

    /**
     * Remove empleadoSubordinado
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqEmpleado $empleadoSubordinado
     */
    public function removeEmpleadoSubordinado(\SanRafael\RequerimientosBundle\Entity\ReqEmpleado $empleadoSubordinado)
    {
        $this->empleadoSubordinados->removeElement($empleadoSubordinado);
    }

    /**
     * Get empleadoSubordinados
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmpleadoSubordinados()
    {
        return $this->empleadoSubordinados;
    }

    /**
     * Add empleadoServiciosLabora
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqEmpleadoAreaServicioAtencion $empleadoServiciosLabora
     *
     * @return ReqEmpleado
     */
    public function addEmpleadoServiciosLabora(\SanRafael\RequerimientosBundle\Entity\ReqEmpleadoAreaServicioAtencion $empleadoServiciosLabora)
    {
        $this->empleadoServiciosLabora[] = $empleadoServiciosLabora;

        return $this;
    }

    /**
     * Remove empleadoServiciosLabora
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqEmpleadoAreaServicioAtencion $empleadoServiciosLabora
     */
    public function removeEmpleadoServiciosLabora(\SanRafael\RequerimientosBundle\Entity\ReqEmpleadoAreaServicioAtencion $empleadoServiciosLabora)
    {
        $this->empleadoServiciosLabora->removeElement($empleadoServiciosLabora);
    }

    /**
     * Get empleadoServiciosLabora
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmpleadoServiciosLabora()
    {
        return $this->empleadoServiciosLabora;
    }
}