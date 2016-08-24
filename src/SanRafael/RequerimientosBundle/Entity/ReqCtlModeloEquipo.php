<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqCtlModeloEquipo
 *
 * @ORM\Table(name="req_ctl_modelo_equipo", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_modelo_equipo", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_CE079FB15463B414", columns={"id_marca_equipo"}), @ORM\Index(name="IDX_CE079FB1AE7383F0", columns={"id_modelo_grupo"})})
 * @ORM\Entity
 */
class ReqCtlModeloEquipo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_ctl_modelo_equipo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=75, nullable=false)
     */
    private $nombre = 'Dell OptiPlex 9020';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", nullable=false)
     */
    private $codigo = 'dlloptx9020';

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristicas", type="text", nullable=true)
     */
    private $caracteristicas;

    /**
     * @var \ReqCtlMarcaEquipo
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlMarcaEquipo", inversedBy="marcaModelosEquipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_marca_equipo", referencedColumnName="id")
     * })
     */
    private $idMarcaEquipo;

    /**
     * @var \ReqCtlModeloEquipo
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlModeloEquipo", inversedBy="grupoModelosEquipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_modelo_grupo", referencedColumnName="id")
     * })
     */
    private $idModeloGrupo;

    /**
     * @ORM\OneToMany(targetEntity="ReqCtlModeloEquipo", mappedBy="idModeloGrupo", cascade={"all"}, orphanRemoval=true)
     */
    private $grupoModelosEquipo;

    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->grupoModelosEquipo = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ReqCtlModeloEquipo
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
     * @return ReqCtlModeloEquipo
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
     * @return ReqCtlModeloEquipo
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
     * Set idMarcaEquipo
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlMarcaEquipo $idMarcaEquipo
     * @return ReqCtlModeloEquipo
     */
    public function setIdMarcaEquipo(\SanRafael\RequerimientosBundle\Entity\ReqCtlMarcaEquipo $idMarcaEquipo = null)
    {
        $this->idMarcaEquipo = $idMarcaEquipo;

        return $this;
    }

    /**
     * Get idMarcaEquipo
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlMarcaEquipo 
     */
    public function getIdMarcaEquipo()
    {
        return $this->idMarcaEquipo;
    }

    /**
     * Set idModeloGrupo
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlModeloEquipo $idModeloGrupo
     * @return ReqCtlModeloEquipo
     */
    public function setIdModeloGrupo(\SanRafael\RequerimientosBundle\Entity\ReqCtlModeloEquipo $idModeloGrupo = null)
    {
        $this->idModeloGrupo = $idModeloGrupo;

        return $this;
    }

    /**
     * Get idModeloGrupo
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlModeloEquipo 
     */
    public function getIdModeloGrupo()
    {
        return $this->idModeloGrupo;
    }

    /**
     * Add grupoModelosEquipo
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlModeloEquipo $grupoModelosEquipo
     * @return ReqCtlModeloEquipo
     */
    public function addGrupoModelosEquipo(\SanRafael\RequerimientosBundle\Entity\ReqCtlModeloEquipo $grupoModelosEquipo)
    {
        $this->grupoModelosEquipo[] = $grupoModelosEquipo;

        return $this;
    }

    /**
     * Remove grupoModelosEquipo
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlModeloEquipo $grupoModelosEquipo
     */
    public function removeGrupoModelosEquipo(\SanRafael\RequerimientosBundle\Entity\ReqCtlModeloEquipo $grupoModelosEquipo)
    {
        $this->grupoModelosEquipo->removeElement($grupoModelosEquipo);
    }

    /**
     * Get grupoModelosEquipo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGrupoModelosEquipo()
    {
        return $this->grupoModelosEquipo;
    }
}
