<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqCtlAreaTrabajo
 *
 * @ORM\Table(name="req_ctl_area_trabajo", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_area_trabajo", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_64D82128FB25A2E6", columns={"id_area_padre"})})
 * @ORM\Entity(repositoryClass="SanRafael\RequerimientosBundle\Repository\AreaTrabajoRepository")
 */
class ReqCtlAreaTrabajo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_ctl_area_trabajo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=75, nullable=false)
     */
    private $nombre = 'Desarrollo de Sistemas Informáticos';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=3, nullable=false)
     */
    private $codigo = 'DSI';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_etiqueta", type="string", length=15, nullable=true)
     */
    private $tipoEtiqueta = 'primary-v4';

    /**
     * @var \ReqCtlAreaTrabajo
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlAreaTrabajo", inversedBy="areaSubareasTrabajo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_padre", referencedColumnName="id")
     * })
     */
    private $idAreaPadre;

    /**
     * @ORM\OneToMany(targetEntity="ReqCtlAreaTrabajo", mappedBy="idAreaPadre", cascade={"all"}, orphanRemoval=true)
     */
    private $areaSubareasTrabajo;

    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->areaSubareasTrabajo = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ReqCtlAreaTrabajo
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
     * @return ReqCtlAreaTrabajo
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
     * Set tipoEtiqueta
     *
     * @param string $tipoEtiqueta
     *
     * @return ReqCtlAreaTrabajo
     */
    public function setTipoEtiqueta($tipoEtiqueta)
    {
        $this->tipoEtiqueta = $tipoEtiqueta;

        return $this;
    }

    /**
     * Get tipoEtiqueta
     *
     * @return string
     */
    public function getTipoEtiqueta()
    {
        return $this->tipoEtiqueta;
    }

    /**
     * Set idAreaPadre
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlAreaTrabajo $idAreaPadre
     *
     * @return ReqCtlAreaTrabajo
     */
    public function setIdAreaPadre(\SanRafael\RequerimientosBundle\Entity\ReqCtlAreaTrabajo $idAreaPadre = null)
    {
        $this->idAreaPadre = $idAreaPadre;

        return $this;
    }

    /**
     * Get idAreaPadre
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlAreaTrabajo
     */
    public function getIdAreaPadre()
    {
        return $this->idAreaPadre;
    }

    /**
     * Add areaSubareasTrabajo
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlAreaTrabajo $areaSubareasTrabajo
     *
     * @return ReqCtlAreaTrabajo
     */
    public function addAreaSubareasTrabajo(\SanRafael\RequerimientosBundle\Entity\ReqCtlAreaTrabajo $areaSubareasTrabajo)
    {
        $this->areaSubareasTrabajo[] = $areaSubareasTrabajo;

        return $this;
    }

    /**
     * Remove areaSubareasTrabajo
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlAreaTrabajo $areaSubareasTrabajo
     */
    public function removeAreaSubareasTrabajo(\SanRafael\RequerimientosBundle\Entity\ReqCtlAreaTrabajo $areaSubareasTrabajo)
    {
        $this->areaSubareasTrabajo->removeElement($areaSubareasTrabajo);
    }

    /**
     * Get areaSubareasTrabajo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAreaSubareasTrabajo()
    {
        return $this->areaSubareasTrabajo;
    }
}
