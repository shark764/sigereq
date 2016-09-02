<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqCtlEquipo
 *
 * @ORM\Table(name="req_ctl_equipo", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_equipo", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_2DD770B3BF5B4BA", columns={"id_servicio_asignado"}), @ORM\Index(name="IDX_2DD770B3290DEAD8", columns={"id_estado_equipo"}), @ORM\Index(name="IDX_2DD770B369953885", columns={"id_empleado_asignado"}), @ORM\Index(name="IDX_2DD770B3AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_2DD770B3D8A5832B", columns={"id_user_reg"}), @ORM\Index(name="IDX_2DD770B366D95F61", columns={"id_modelo_equipo"}), @ORM\Index(name="IDX_2DD770B3493768E4", columns={"id_tipo_equipo"})})
 * @ORM\Entity(repositoryClass="SanRafael\RequerimientosBundle\Repository\EquipoRepository")
 */
class ReqCtlEquipo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_ctl_equipo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre = 'PC Dell Optiplex 9020 de prestaciones medias';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=10, nullable=false)
     */
    private $codigo = '000000';

    /**
     * @var string
     *
     * @ORM\Column(name="numero_inventario", type="string", length=50, nullable=true)
     */
    private $numeroInventario;

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristicas", type="text", nullable=true)
     */
    private $caracteristicas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_adquisicion", type="datetime", nullable=true)
     */
    private $fechaAdquisicion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_despacho", type="datetime", nullable=true)
     */
    private $fechaDespacho;

    /**
     * @var string
     *
     * @ORM\Column(name="serie", type="string", length=16, nullable=true)
     */
    private $serie;

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
     * @var \ReqAreaServicioAtencion
     *
     * @ORM\ManyToOne(targetEntity="ReqAreaServicioAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_servicio_asignado", referencedColumnName="id")
     * })
     */
    private $idServicioAsignado;

    /**
     * @var \ReqCtlEstadoEquipo
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlEstadoEquipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_equipo", referencedColumnName="id")
     * })
     */
    private $idEstadoEquipo;

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
     * @var \ReqCtlModeloEquipo
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlModeloEquipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_modelo_equipo", referencedColumnName="id")
     * })
     */
    private $idModeloEquipo;

    /**
     * @var \ReqCtlTipoEquipo
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlTipoEquipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_equipo", referencedColumnName="id")
     * })
     */
    private $idTipoEquipo;

    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->serie)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fechaHoraReg = new \DateTime('now');
        $this->fechaAdquisicion = new \DateTime('now');
        $this->fechaDespacho = new \DateTime('now');
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
     * @return ReqCtlEquipo
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
     * Set codigo
     *
     * @param string $codigo
     *
     * @return ReqCtlEquipo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set numeroInventario
     *
     * @param string $numeroInventario
     *
     * @return ReqCtlEquipo
     */
    public function setNumeroInventario($numeroInventario)
    {
        $this->numeroInventario = $numeroInventario;

        return $this;
    }

    /**
     * Get numeroInventario
     *
     * @return string
     */
    public function getNumeroInventario()
    {
        return $this->numeroInventario;
    }

    /**
     * Set caracteristicas
     *
     * @param string $caracteristicas
     *
     * @return ReqCtlEquipo
     */
    public function setCaracteristicas($caracteristicas)
    {
        $this->caracteristicas = $caracteristicas;

        return $this;
    }

    /**
     * Get caracteristicas
     *
     * @return string
     */
    public function getCaracteristicas()
    {
        return $this->caracteristicas;
    }

    /**
     * Set fechaAdquisicion
     *
     * @param \DateTime $fechaAdquisicion
     *
     * @return ReqCtlEquipo
     */
    public function setFechaAdquisicion($fechaAdquisicion)
    {
        $this->fechaAdquisicion = $fechaAdquisicion;

        return $this;
    }

    /**
     * Get fechaAdquisicion
     *
     * @return \DateTime
     */
    public function getFechaAdquisicion()
    {
        return $this->fechaAdquisicion;
    }

    /**
     * Set fechaDespacho
     *
     * @param \DateTime $fechaDespacho
     *
     * @return ReqCtlEquipo
     */
    public function setFechaDespacho($fechaDespacho)
    {
        $this->fechaDespacho = $fechaDespacho;

        return $this;
    }

    /**
     * Get fechaDespacho
     *
     * @return \DateTime
     */
    public function getFechaDespacho()
    {
        return $this->fechaDespacho;
    }

    /**
     * Set serie
     *
     * @param string $serie
     *
     * @return ReqCtlEquipo
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get serie
     *
     * @return string
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set fechaHoraReg
     *
     * @param \DateTime $fechaHoraReg
     *
     * @return ReqCtlEquipo
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
     * @return ReqCtlEquipo
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
     * Set idServicioAsignado
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqAreaServicioAtencion $idServicioAsignado
     *
     * @return ReqCtlEquipo
     */
    public function setIdServicioAsignado(\SanRafael\RequerimientosBundle\Entity\ReqAreaServicioAtencion $idServicioAsignado = null)
    {
        $this->idServicioAsignado = $idServicioAsignado;

        return $this;
    }

    /**
     * Get idServicioAsignado
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqAreaServicioAtencion
     */
    public function getIdServicioAsignado()
    {
        return $this->idServicioAsignado;
    }

    /**
     * Set idEstadoEquipo
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlEstadoEquipo $idEstadoEquipo
     *
     * @return ReqCtlEquipo
     */
    public function setIdEstadoEquipo(\SanRafael\RequerimientosBundle\Entity\ReqCtlEstadoEquipo $idEstadoEquipo = null)
    {
        $this->idEstadoEquipo = $idEstadoEquipo;

        return $this;
    }

    /**
     * Get idEstadoEquipo
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlEstadoEquipo
     */
    public function getIdEstadoEquipo()
    {
        return $this->idEstadoEquipo;
    }

    /**
     * Set idEmpleadoAsignado
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqEmpleado $idEmpleadoAsignado
     *
     * @return ReqCtlEquipo
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
     * Set idUserMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserMod
     *
     * @return ReqCtlEquipo
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
     * @return ReqCtlEquipo
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
     * Set idModeloEquipo
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlModeloEquipo $idModeloEquipo
     *
     * @return ReqCtlEquipo
     */
    public function setIdModeloEquipo(\SanRafael\RequerimientosBundle\Entity\ReqCtlModeloEquipo $idModeloEquipo = null)
    {
        $this->idModeloEquipo = $idModeloEquipo;

        return $this;
    }

    /**
     * Get idModeloEquipo
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlModeloEquipo
     */
    public function getIdModeloEquipo()
    {
        return $this->idModeloEquipo;
    }

    /**
     * Set idTipoEquipo
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlTipoEquipo $idTipoEquipo
     *
     * @return ReqCtlEquipo
     */
    public function setIdTipoEquipo(\SanRafael\RequerimientosBundle\Entity\ReqCtlTipoEquipo $idTipoEquipo = null)
    {
        $this->idTipoEquipo = $idTipoEquipo;

        return $this;
    }

    /**
     * Get idTipoEquipo
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlTipoEquipo
     */
    public function getIdTipoEquipo()
    {
        return $this->idTipoEquipo;
    }
}
