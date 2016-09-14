<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ReqEmpleadoAreaServicioAtencion
 *
 * @ORM\Table(name="req_empleado_area_servicio_atencion", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_empleado_area_servicio_atencion", columns={"id_area_servicio_atencion", "id_empleado"})}, indexes={@ORM\Index(name="IDX_93EFA453890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_93EFA453F6BCBD1", columns={"id_area_servicio_atencion"})})
 * @ORM\Entity(repositoryClass="SanRafael\RequerimientosBundle\Repository\EmpleadoAreaServicioRepository")
 */
class ReqEmpleadoAreaServicioAtencion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_empleado_area_servicio_atencion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="habilitado", type="boolean", nullable=true)
     */
    private $habilitado = true;

    /**
     * @var \ReqEmpleado
     *
     * @ORM\ManyToOne(targetEntity="ReqEmpleado", inversedBy="empleadoServiciosLabora")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idEmpleado;

    /**
     * @var \ReqAreaServicioAtencion
     *
     * @ORM\ManyToOne(targetEntity="ReqAreaServicioAtencion", inversedBy="areaServicioEmpleadosLaboran")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_servicio_atencion", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idAreaServicioAtencion;

    /**
     * ToString
     */
    public function __toString()
    {
        return $this->idEmpleado ? $this->idEmpleado . ' | ' . $this->idAreaServicioAtencion : '';
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
     * Set habilitado
     *
     * @param boolean $habilitado
     *
     * @return ReqEmpleadoAreaServicioAtencion
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
     * Set idEmpleado
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqEmpleado $idEmpleado
     *
     * @return ReqEmpleadoAreaServicioAtencion
     */
    public function setIdEmpleado(\SanRafael\RequerimientosBundle\Entity\ReqEmpleado $idEmpleado = null)
    {
        $this->idEmpleado = $idEmpleado;

        return $this;
    }

    /**
     * Get idEmpleado
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqEmpleado
     */
    public function getIdEmpleado()
    {
        return $this->idEmpleado;
    }

    /**
     * Set idAreaServicioAtencion
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqAreaServicioAtencion $idAreaServicioAtencion
     *
     * @return ReqEmpleadoAreaServicioAtencion
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
}
