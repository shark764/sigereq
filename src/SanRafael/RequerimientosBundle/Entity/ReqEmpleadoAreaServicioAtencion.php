<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqEmpleadoAreaServicioAtencion
 *
 * @ORM\Table(name="req_empleado_area_servicio_atencion", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_empleado_area_servicio_atencion", columns={"id_area_servicio_atencion", "id_empleado"})}, indexes={@ORM\Index(name="IDX_93EFA453890253C7", columns={"id_empleado"}), @ORM\Index(name="IDX_93EFA453F6BCBD1", columns={"id_area_servicio_atencion"})})
 * @ORM\Entity
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
     * @ORM\ManyToOne(targetEntity="ReqEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado", referencedColumnName="id")
     * })
     */
    private $idEmpleado;

    /**
     * @var \ReqAreaServicioAtencion
     *
     * @ORM\ManyToOne(targetEntity="ReqAreaServicioAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_servicio_atencion", referencedColumnName="id")
     * })
     */
    private $idAreaServicioAtencion;

    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }

}