<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqEmpleado
 *
 * @ORM\Table(name="req_empleado", indexes={@ORM\Index(name="IDX_9ABCE3444F664059", columns={"id_cargo_empleado"}), @ORM\Index(name="IDX_9ABCE3447D36E8FB", columns={"id_jefe_inmediato"}), @ORM\Index(name="IDX_9ABCE344B13434FE", columns={"id_tipo_empleado"}), @ORM\Index(name="IDX_9ABCE344D8A5832B", columns={"id_user_reg"}), @ORM\Index(name="IDX_9ABCE344AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_9ABCE344F6BCBD1", columns={"id_area_servicio_atencion"})})
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
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=50, nullable=false)
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
     * @ORM\Column(name="telefono_casa", type="string", nullable=true)
     */
    private $telefonoCasa;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_celular", type="string", nullable=true)
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
     * @var boolean
     *
     * @ORM\Column(name="sexo", type="boolean", nullable=true)
     */
    private $sexo = true;

    /**
     * @var \ReqCtlCargoEmpleado
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlCargoEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cargo_empleado", referencedColumnName="id")
     * })
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
     * @var \ReqCtlTipoEmpleado
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlTipoEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_empleado", referencedColumnName="id")
     * })
     */
    private $idTipoEmpleado;

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
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_mod", referencedColumnName="id")
     * })
     */
    private $idUserMod;

    /**
     * @var \ReqAreaServicioAtencion
     *
     * @ORM\ManyToOne(targetEntity="ReqAreaServicioAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_servicio_atencion", referencedColumnName="id")
     * })
     */
    private $idAreaServicioAtencion;

    /**
     * @ORM\OneToMany(targetEntity="ReqEmpleado", mappedBy="idJefeInmediato", cascade={"all"}, orphanRemoval=true)
     */
    private $empleadoSubordinados;

    public function __toString()
    {
        return mb_strtoupper(trim($this->apellido), 'utf-8') . ', ' . mb_strtoupper(trim($this->nombre), 'utf-8');
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->empleadoSubordinados = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set sexo
     *
     * @param boolean $sexo
     *
     * @return ReqEmpleado
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return boolean
     */
    public function getSexo()
    {
        return $this->sexo;
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
}
