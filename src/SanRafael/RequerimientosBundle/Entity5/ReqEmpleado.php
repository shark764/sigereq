<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqEmpleado
 *
 * @ORM\Table(name="req_empleado", indexes={@ORM\Index(name="IDX_9ABCE3447D36E8FB", columns={"id_jefe_inmediato"}), @ORM\Index(name="IDX_9ABCE344D8A5832B", columns={"id_user_reg"}), @ORM\Index(name="IDX_9ABCE344AC39DE56", columns={"id_user_mod"}), @ORM\Index(name="IDX_9ABCE344F6BCBD1", columns={"id_area_servicio_atencion"}), @ORM\Index(name="IDX_9ABCE3444F664059", columns={"id_cargo_empleado"}), @ORM\Index(name="IDX_9ABCE344B13434FE", columns={"id_tipo_empleado"})})
 * @ORM\Entity
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
     * @var boolean
     *
     * @ORM\Column(name="sexo", type="boolean", nullable=true)
     */
    private $sexo = true;

    /**
     * @var \ReqEmpleado
     *
     * @ORM\ManyToOne(targetEntity="ReqEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_jefe_inmediato", referencedColumnName="id")
     * })
     */
    private $idJefeInmediato;

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
     * @var \ReqCtlCargoEmpleado
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlCargoEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cargo_empleado", referencedColumnName="id")
     * })
     */
    private $idCargoEmpleado;

    /**
     * @var \ReqCtlTipoEmpleado
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlTipoEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_empleado", referencedColumnName="id")
     * })
     */
    private $idTipoEmpleado;


}

