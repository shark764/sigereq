<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqCtlEquipo
 *
 * @ORM\Table(name="req_ctl_equipo", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_equipo", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_2DD770B369953885", columns={"id_empleado_asignado"}), @ORM\Index(name="IDX_2DD770B3290DEAD8", columns={"id_estado_equipo"}), @ORM\Index(name="IDX_2DD770B366D95F61", columns={"id_modelo_equipo"}), @ORM\Index(name="IDX_2DD770B3BF5B4BA", columns={"id_servicio_asignado"}), @ORM\Index(name="IDX_2DD770B3493768E4", columns={"id_tipo_equipo"}), @ORM\Index(name="IDX_2DD770B3AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_2DD770B3D8A5832B", columns={"id_user_reg"})})
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
     * @var \ReqEmpleado
     *
     * @ORM\ManyToOne(targetEntity="ReqEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado_asignado", referencedColumnName="id")
     * })
     */
    private $idEmpleadoAsignado;

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
     * @var \ReqCtlModeloEquipo
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlModeloEquipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_modelo_equipo", referencedColumnName="id")
     * })
     */
    private $idModeloEquipo;

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
     * @var \ReqCtlTipoEquipo
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlTipoEquipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_equipo", referencedColumnName="id")
     * })
     */
    private $idTipoEquipo;

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
     * @var \FosUserUser
     *
     * @ORM\ManyToOne(targetEntity="FosUserUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_reg", referencedColumnName="id")
     * })
     */
    private $idUserReg;

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

}