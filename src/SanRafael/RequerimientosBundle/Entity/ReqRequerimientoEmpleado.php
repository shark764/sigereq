<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ReqRequerimientoEmpleado
 *
 * @ORM\Table(name="req_requerimiento_empleado", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_empleado_trabajo_requerido", columns={"id_trabajo_requerido", "id_empleado_asignado"})}, indexes={@ORM\Index(name="IDX_FB2FC8EA69953885", columns={"id_empleado_asignado"}), @ORM\Index(name="IDX_FB2FC8EA2737BBE4", columns={"id_trabajo_requerido"}), @ORM\Index(name="IDX_FB2FC8EAEAC1F577", columns={"id_requerimiento"})})
 * @ORM\Entity(repositoryClass="SanRafael\RequerimientosBundle\Repository\RequerimientoEmpleadoRepository")
 */
class ReqRequerimientoEmpleado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_requerimiento_empleado_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_asignacion", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaAsignacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_inicio", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaHoraInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_fin", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaHoraFin;

    /**
     * @var \ReqEmpleado
     *
     * @ORM\ManyToOne(targetEntity="ReqEmpleado", inversedBy="empleadoRequerimientoEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado_asignado", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idEmpleadoAsignado;

    /**
     * @var \ReqRequerimientoTrabajoRequerido
     *
     * @ORM\ManyToOne(targetEntity="ReqRequerimientoTrabajoRequerido", inversedBy="trabajoRequeridoRequerimientoEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_trabajo_requerido", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idTrabajoRequerido;

    /**
     * @var \ReqRequerimiento
     *
     * @ORM\ManyToOne(targetEntity="ReqRequerimiento", inversedBy="requerimientoRequerimientoEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_requerimiento", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idRequerimiento;

    /**
     * ToString
     */
    public function __toString()
    {
        return $this->idEmpleadoAsignado ? $this->idEmpleadoAsignado . ' | ' . $this->idTrabajoRequerido : '';
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fechaAsignacion  = new \DateTime('now');
        $this->fechaHoraInicio  = new \DateTime('now');
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
     * Set fechaAsignacion
     *
     * @param \DateTime $fechaAsignacion
     *
     * @return ReqRequerimientoEmpleado
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
     * Set fechaHoraInicio
     *
     * @param \DateTime $fechaHoraInicio
     *
     * @return ReqRequerimientoEmpleado
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
     * @return ReqRequerimientoEmpleado
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
     * Set idEmpleadoAsignado
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqEmpleado $idEmpleadoAsignado
     *
     * @return ReqRequerimientoEmpleado
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
     * Set idTrabajoRequerido
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqRequerimientoTrabajoRequerido $idTrabajoRequerido
     *
     * @return ReqRequerimientoEmpleado
     */
    public function setIdTrabajoRequerido(\SanRafael\RequerimientosBundle\Entity\ReqRequerimientoTrabajoRequerido $idTrabajoRequerido = null)
    {
        $this->idTrabajoRequerido = $idTrabajoRequerido;

        return $this;
    }

    /**
     * Get idTrabajoRequerido
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqRequerimientoTrabajoRequerido
     */
    public function getIdTrabajoRequerido()
    {
        return $this->idTrabajoRequerido;
    }

    /**
     * Set idRequerimiento
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqRequerimiento $idRequerimiento
     *
     * @return ReqRequerimientoEmpleado
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
}
