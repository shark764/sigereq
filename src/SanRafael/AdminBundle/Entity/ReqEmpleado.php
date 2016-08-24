<?php

namespace SanRafael\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqEmpleado
 *
 * @ORM\Table(name="req_empleado", indexes={@ORM\Index(name="IDX_9ABCE3444F664059", columns={"id_cargo_empleado"}), @ORM\Index(name="IDX_9ABCE3447D36E8FB", columns={"id_jefe_inmediato"}), @ORM\Index(name="IDX_9ABCE344B13434FE", columns={"id_tipo_empleado"})})
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
     * @ORM\Column(name="fecha_nacimiento", type="datetime", nullable=true)
     */
    private $fechaNacimiento;

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
     * @ORM\OneToMany(targetEntity="ReqEmpleado", mappedBy="idJefeInmediato", cascade={"all"}, orphanRemoval=true)
     */
    private $empleadoSubordinados;

    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
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
     * Set idCargoEmpleado
     *
     * @param \SanRafael\AdminBundle\Entity\ReqCtlCargoEmpleado $idCargoEmpleado
     * @return ReqEmpleado
     */
    public function setIdCargoEmpleado(\SanRafael\AdminBundle\Entity\ReqCtlCargoEmpleado $idCargoEmpleado = null)
    {
        $this->idCargoEmpleado = $idCargoEmpleado;

        return $this;
    }

    /**
     * Get idCargoEmpleado
     *
     * @return \SanRafael\AdminBundle\Entity\ReqCtlCargoEmpleado 
     */
    public function getIdCargoEmpleado()
    {
        return $this->idCargoEmpleado;
    }

    /**
     * Set idJefeInmediato
     *
     * @param \SanRafael\AdminBundle\Entity\ReqEmpleado $idJefeInmediato
     * @return ReqEmpleado
     */
    public function setIdJefeInmediato(\SanRafael\AdminBundle\Entity\ReqEmpleado $idJefeInmediato = null)
    {
        $this->idJefeInmediato = $idJefeInmediato;

        return $this;
    }

    /**
     * Get idJefeInmediato
     *
     * @return \SanRafael\AdminBundle\Entity\ReqEmpleado 
     */
    public function getIdJefeInmediato()
    {
        return $this->idJefeInmediato;
    }

    /**
     * Set idTipoEmpleado
     *
     * @param \SanRafael\AdminBundle\Entity\ReqCtlTipoEmpleado $idTipoEmpleado
     * @return ReqEmpleado
     */
    public function setIdTipoEmpleado(\SanRafael\AdminBundle\Entity\ReqCtlTipoEmpleado $idTipoEmpleado = null)
    {
        $this->idTipoEmpleado = $idTipoEmpleado;

        return $this;
    }

    /**
     * Get idTipoEmpleado
     *
     * @return \SanRafael\AdminBundle\Entity\ReqCtlTipoEmpleado 
     */
    public function getIdTipoEmpleado()
    {
        return $this->idTipoEmpleado;
    }

    /**
     * Add empleadoSubordinados
     *
     * @param \SanRafael\AdminBundle\Entity\ReqEmpleado $empleadoSubordinados
     * @return ReqEmpleado
     */
    public function addEmpleadoSubordinado(\SanRafael\AdminBundle\Entity\ReqEmpleado $empleadoSubordinados)
    {
        $this->empleadoSubordinados[] = $empleadoSubordinados;

        return $this;
    }

    /**
     * Remove empleadoSubordinados
     *
     * @param \SanRafael\AdminBundle\Entity\ReqEmpleado $empleadoSubordinados
     */
    public function removeEmpleadoSubordinado(\SanRafael\AdminBundle\Entity\ReqEmpleado $empleadoSubordinados)
    {
        $this->empleadoSubordinados->removeElement($empleadoSubordinados);
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
