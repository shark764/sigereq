<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqRequerimientoTrabajoRequerido
 *
 * @ORM\Table(name="req_requerimiento_trabajo_requerido", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_requerimiento_trabajo_requerido", columns={"id_requerimiento", "id_trabajo_requerido"})}, indexes={@ORM\Index(name="IDX_CEE38221EAC1F577", columns={"id_requerimiento"}), @ORM\Index(name="IDX_CEE382212737BBE4", columns={"id_trabajo_requerido"}), @ORM\Index(name="IDX_CEE38221E8234E65", columns={"id_soluciona_requerimiento"})})
 * @ORM\Entity
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
     * @ORM\Column(name="fecha_inicio", type="datetime", nullable=true)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="datetime", nullable=true)
     */
    private $fechaFin;

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
     * @var \ReqRequerimiento
     *
     * @ORM\ManyToOne(targetEntity="ReqRequerimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_requerimiento", referencedColumnName="id")
     * })
     */
    private $idRequerimiento;

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
     * @var \ReqEmpleado
     *
     * @ORM\ManyToOne(targetEntity="ReqEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_soluciona_requerimiento", referencedColumnName="id")
     * })
     */
    private $idSolucionaRequerimiento;



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
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return ReqRequerimientoTrabajoRequerido
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     *
     * @return ReqRequerimientoTrabajoRequerido
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
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
}
