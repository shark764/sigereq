<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqCtlTipoEquipo
 *
 * @ORM\Table(name="req_ctl_tipo_equipo", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_tipo_equipo", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_3066CC92705370F4", columns={"id_tipo_padre"})})
 * @ORM\Entity
 */
class ReqCtlTipoEquipo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_ctl_tipo_equipo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=75, nullable=false)
     */
    private $nombre = 'Computadora de escritorio';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=3, nullable=false)
     */
    private $codigo = 'DKT';

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristicas", type="text", nullable=true)
     */
    private $caracteristicas;

    /**
     * @var \ReqCtlTipoEquipo
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlTipoEquipo", inversedBy="tipoSubtiposEquipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_padre", referencedColumnName="id")
     * })
     */
    private $idTipoPadre;

    /**
     * @ORM\OneToMany(targetEntity="ReqCtlTipoEquipo", mappedBy="idTipoPadre", cascade={"all"}, orphanRemoval=true)
     */
    private $tipoSubtiposEquipo;

    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tipoSubtiposEquipo = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ReqCtlTipoEquipo
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
     * @return ReqCtlTipoEquipo
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
     * Set caracteristicas
     *
     * @param string $caracteristicas
     *
     * @return ReqCtlTipoEquipo
     */
    public function setCaracteristicas($caracteristicas)
    {
        $this->caracteristicas = $caracteristicas;

        return $this;
    }

    /**
     * Get caracteristicas
     *
     * @return string
     */
    public function getCaracteristicas()
    {
        return $this->caracteristicas;
    }

    /**
     * Set idTipoPadre
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlTipoEquipo $idTipoPadre
     *
     * @return ReqCtlTipoEquipo
     */
    public function setIdTipoPadre(\SanRafael\RequerimientosBundle\Entity\ReqCtlTipoEquipo $idTipoPadre = null)
    {
        $this->idTipoPadre = $idTipoPadre;

        return $this;
    }

    /**
     * Get idTipoPadre
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlTipoEquipo
     */
    public function getIdTipoPadre()
    {
        return $this->idTipoPadre;
    }

    /**
     * Add tipoSubtiposEquipo
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlTipoEquipo $tipoSubtiposEquipo
     *
     * @return ReqCtlTipoEquipo
     */
    public function addTipoSubtiposEquipo(\SanRafael\RequerimientosBundle\Entity\ReqCtlTipoEquipo $tipoSubtiposEquipo)
    {
        $this->tipoSubtiposEquipo[] = $tipoSubtiposEquipo;

        return $this;
    }

    /**
     * Remove tipoSubtiposEquipo
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlTipoEquipo $tipoSubtiposEquipo
     */
    public function removeTipoSubtiposEquipo(\SanRafael\RequerimientosBundle\Entity\ReqCtlTipoEquipo $tipoSubtiposEquipo)
    {
        $this->tipoSubtiposEquipo->removeElement($tipoSubtiposEquipo);
    }

    /**
     * Get tipoSubtiposEquipo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTipoSubtiposEquipo()
    {
        return $this->tipoSubtiposEquipo;
    }
}
