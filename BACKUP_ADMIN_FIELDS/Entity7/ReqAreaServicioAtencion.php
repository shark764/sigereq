<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqAreaServicioAtencion
 *
 * @ORM\Table(name="req_area_servicio_atencion", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_modalidad_area_servicio_atencion", columns={"id_area_atencion", "id_servicio_atencion", "id_servicio_externo", "id_modalidad_atencion"})}, indexes={@ORM\Index(name="IDX_FDA1E1E044A2C069", columns={"id_area_atencion"}), @ORM\Index(name="IDX_FDA1E1E0477882F9", columns={"id_jefe_departamento"}), @ORM\Index(name="IDX_FDA1E1E0EF8B2BB4", columns={"id_modalidad_atencion"}), @ORM\Index(name="IDX_FDA1E1E0DC0A4806", columns={"id_servicio_atencion"}), @ORM\Index(name="IDX_FDA1E1E088863BBD", columns={"id_servicio_externo"})})
 * @ORM\Entity(repositoryClass="SanRafael\RequerimientosBundle\Repository\AreaServicioAtencionRepository")
 */
class ReqAreaServicioAtencion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_area_servicio_atencion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \ReqCtlAreaAtencion
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlAreaAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_atencion", referencedColumnName="id")
     * })
     */
    private $idAreaAtencion;

    /**
     * @var \ReqEmpleado
     *
     * @ORM\ManyToOne(targetEntity="ReqEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_jefe_departamento", referencedColumnName="id")
     * })
     */
    private $idJefeDepartamento;

    /**
     * @var \ReqCtlModalidadAtencion
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlModalidadAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_modalidad_atencion", referencedColumnName="id")
     * })
     */
    private $idModalidadAtencion;

    /**
     * @var \ReqCtlServicioAtencion
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlServicioAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_servicio_atencion", referencedColumnName="id")
     * })
     */
    private $idServicioAtencion;

    /**
     * @var \ReqCtlServicioExterno
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlServicioExterno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_servicio_externo", referencedColumnName="id")
     * })
     */
    private $idServicioExterno;

    /**
     * @ORM\OneToMany(targetEntity="ReqEmpleado", mappedBy="idAreaServicioAtencion", cascade={"all"}, orphanRemoval=true)
     */
    private $areaServicioEmpleados;

    /**
     * @ORM\OneToMany(targetEntity="ReqEmpleadoAreaServicioAtencion", mappedBy="idAreaServicioAtencion", cascade={"all"}, orphanRemoval=true)
     */
    private $areaServicioEmpleadosLaboran;

    public function __toString()
    {
        if ($this->getIdServicioExterno())
        {
            return $this->idServicioAtencion ? mb_strtoupper(trim($this->idAreaAtencion), 'utf-8') . ' - ' . mb_strtoupper(trim($this->idServicioAtencion), 'utf-8') . ' | ' . strtoupper(trim($this->idServicioExterno)) . ' | ' . strtoupper(trim($this->idModalidadAtencion)) : '';
        }
        return $this->idServicioAtencion ? mb_strtoupper(trim($this->idAreaAtencion), 'utf-8') . ' - ' . mb_strtoupper(trim($this->idServicioAtencion), 'utf-8') . ' | ' . strtoupper(trim($this->idModalidadAtencion)) : '';
    }

}