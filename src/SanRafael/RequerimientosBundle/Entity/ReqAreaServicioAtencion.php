<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqAreaServicioAtencion
 *
 * @ORM\Table(name="req_area_servicio_atencion", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_area_servicio_atencion", columns={"id_area_atencion", "id_servicio_atencion", "id_servicio_externo"})}, indexes={@ORM\Index(name="IDX_FDA1E1E044A2C069", columns={"id_area_atencion"}), @ORM\Index(name="IDX_FDA1E1E0DC0A4806", columns={"id_servicio_atencion"}), @ORM\Index(name="IDX_FDA1E1E088863BBD", columns={"id_servicio_externo"})})
 * @ORM\Entity
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

    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
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
     * Set idServicioAtencion
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlServicioAtencion $idServicioAtencion
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
}
