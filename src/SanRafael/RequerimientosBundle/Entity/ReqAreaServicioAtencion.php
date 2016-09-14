<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotNull(message = "foreign.default.not_null")
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
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idModalidadAtencion;

    /**
     * @var \ReqCtlServicioAtencion
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlServicioAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_servicio_atencion", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
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

    /**
     * @ORM\OneToMany(targetEntity="ReqCtlEquipo", mappedBy="idServicioAsignado", cascade={"all"}, orphanRemoval=true)
     */
    private $areaServicioEquipoAsignado;

    /**
     * ToString
     */
    public function __toString()
    {
        if ($this->getIdServicioExterno())
        {
            return $this->idServicioAtencion ? mb_strtoupper(trim($this->idAreaAtencion), 'utf-8') . ' - ' . mb_strtoupper(trim($this->idServicioAtencion), 'utf-8') . ' | ' . strtoupper(trim($this->idServicioExterno)) . ' | ' . strtoupper(trim($this->idModalidadAtencion)) : '';
        }
        return $this->idServicioAtencion ? mb_strtoupper(trim($this->idAreaAtencion), 'utf-8') . ' - ' . mb_strtoupper(trim($this->idServicioAtencion), 'utf-8') . ' | ' . strtoupper(trim($this->idModalidadAtencion)) : '';
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->areaServicioEmpleados = new \Doctrine\Common\Collections\ArrayCollection();
        $this->areaServicioEmpleadosLaboran = new \Doctrine\Common\Collections\ArrayCollection();
        $this->areaServicioEquipoAsignado = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set idAreaAtencion
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlAreaAtencion $idAreaAtencion
     *
     * @return ReqAreaServicioAtencion
     */
    public function setIdAreaAtencion(\SanRafael\RequerimientosBundle\Entity\ReqCtlAreaAtencion $idAreaAtencion = null)
    {
        $this->idAreaAtencion = $idAreaAtencion;

        return $this;
    }

    /**
     * Get idAreaAtencion
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlAreaAtencion
     */
    public function getIdAreaAtencion()
    {
        return $this->idAreaAtencion;
    }

    /**
     * Set idJefeDepartamento
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqEmpleado $idJefeDepartamento
     *
     * @return ReqAreaServicioAtencion
     */
    public function setIdJefeDepartamento(\SanRafael\RequerimientosBundle\Entity\ReqEmpleado $idJefeDepartamento = null)
    {
        $this->idJefeDepartamento = $idJefeDepartamento;

        return $this;
    }

    /**
     * Get idJefeDepartamento
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqEmpleado
     */
    public function getIdJefeDepartamento()
    {
        return $this->idJefeDepartamento;
    }

    /**
     * Set idModalidadAtencion
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlModalidadAtencion $idModalidadAtencion
     *
     * @return ReqAreaServicioAtencion
     */
    public function setIdModalidadAtencion(\SanRafael\RequerimientosBundle\Entity\ReqCtlModalidadAtencion $idModalidadAtencion = null)
    {
        $this->idModalidadAtencion = $idModalidadAtencion;

        return $this;
    }

    /**
     * Get idModalidadAtencion
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlModalidadAtencion
     */
    public function getIdModalidadAtencion()
    {
        return $this->idModalidadAtencion;
    }

    /**
     * Set idServicioAtencion
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlServicioAtencion $idServicioAtencion
     *
     * @return ReqAreaServicioAtencion
     */
    public function setIdServicioAtencion(\SanRafael\RequerimientosBundle\Entity\ReqCtlServicioAtencion $idServicioAtencion = null)
    {
        $this->idServicioAtencion = $idServicioAtencion;

        return $this;
    }

    /**
     * Get idServicioAtencion
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlServicioAtencion
     */
    public function getIdServicioAtencion()
    {
        return $this->idServicioAtencion;
    }

    /**
     * Set idServicioExterno
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlServicioExterno $idServicioExterno
     *
     * @return ReqAreaServicioAtencion
     */
    public function setIdServicioExterno(\SanRafael\RequerimientosBundle\Entity\ReqCtlServicioExterno $idServicioExterno = null)
    {
        $this->idServicioExterno = $idServicioExterno;

        return $this;
    }

    /**
     * Get idServicioExterno
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlServicioExterno
     */
    public function getIdServicioExterno()
    {
        return $this->idServicioExterno;
    }

    /**
     * Add areaServicioEmpleado
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqEmpleado $areaServicioEmpleado
     *
     * @return ReqAreaServicioAtencion
     */
    public function addAreaServicioEmpleado(\SanRafael\RequerimientosBundle\Entity\ReqEmpleado $areaServicioEmpleado)
    {
        $this->areaServicioEmpleados[] = $areaServicioEmpleado;

        return $this;
    }

    /**
     * Remove areaServicioEmpleado
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqEmpleado $areaServicioEmpleado
     */
    public function removeAreaServicioEmpleado(\SanRafael\RequerimientosBundle\Entity\ReqEmpleado $areaServicioEmpleado)
    {
        $this->areaServicioEmpleados->removeElement($areaServicioEmpleado);
    }

    /**
     * Get areaServicioEmpleados
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAreaServicioEmpleados()
    {
        return $this->areaServicioEmpleados;
    }

    /**
     * Add areaServicioEmpleadosLaboran
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqEmpleadoAreaServicioAtencion $areaServicioEmpleadosLaboran
     *
     * @return ReqAreaServicioAtencion
     */
    public function addAreaServicioEmpleadosLaboran(\SanRafael\RequerimientosBundle\Entity\ReqEmpleadoAreaServicioAtencion $areaServicioEmpleadosLaboran)
    {
        $this->areaServicioEmpleadosLaboran[] = $areaServicioEmpleadosLaboran;

        return $this;
    }

    /**
     * Remove areaServicioEmpleadosLaboran
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqEmpleadoAreaServicioAtencion $areaServicioEmpleadosLaboran
     */
    public function removeAreaServicioEmpleadosLaboran(\SanRafael\RequerimientosBundle\Entity\ReqEmpleadoAreaServicioAtencion $areaServicioEmpleadosLaboran)
    {
        $this->areaServicioEmpleadosLaboran->removeElement($areaServicioEmpleadosLaboran);
    }

    /**
     * Get areaServicioEmpleadosLaboran
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAreaServicioEmpleadosLaboran()
    {
        return $this->areaServicioEmpleadosLaboran;
    }

    /**
     * Add areaServicioEquipoAsignado
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlEquipo $areaServicioEquipoAsignado
     *
     * @return ReqAreaServicioAtencion
     */
    public function addAreaServicioEquipoAsignado(\SanRafael\RequerimientosBundle\Entity\ReqCtlEquipo $areaServicioEquipoAsignado)
    {
        $this->areaServicioEquipoAsignado[] = $areaServicioEquipoAsignado;

        return $this;
    }

    /**
     * Remove areaServicioEquipoAsignado
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlEquipo $areaServicioEquipoAsignado
     */
    public function removeAreaServicioEquipoAsignado(\SanRafael\RequerimientosBundle\Entity\ReqCtlEquipo $areaServicioEquipoAsignado)
    {
        $this->areaServicioEquipoAsignado->removeElement($areaServicioEquipoAsignado);
    }

    /**
     * Get areaServicioEquipoAsignado
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAreaServicioEquipoAsignado()
    {
        return $this->areaServicioEquipoAsignado;
    }
}
