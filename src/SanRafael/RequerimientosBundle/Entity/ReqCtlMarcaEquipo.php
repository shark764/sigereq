<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ReqCtlMarcaEquipo
 *
 * @ORM\Table(name="req_ctl_marca_equipo", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_marca_equipo", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_ED7C31B9CCF415DC", columns={"id_marca_grupo"})})
 * @ORM\Entity(repositoryClass="SanRafael\RequerimientosBundle\Repository\MarcaEquipoRepository")
 */
class ReqCtlMarcaEquipo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_ctl_marca_equipo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $nombre = 'DELL';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=3, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $codigo = 'DLL';

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristicas", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $caracteristicas;

    /**
     * @var \ReqCtlMarcaEquipo
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlMarcaEquipo", inversedBy="grupoMarcasEquipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_marca_grupo", referencedColumnName="id")
     * })
     */
    private $idMarcaGrupo;

    /**
     * @ORM\OneToMany(targetEntity="ReqCtlMarcaEquipo", mappedBy="idMarcaGrupo", cascade={"all"}, orphanRemoval=true)
     */
    private $grupoMarcasEquipo;

    /**
     * @ORM\OneToMany(targetEntity="ReqCtlModeloEquipo", mappedBy="idMarcaEquipo", cascade={"all"}, orphanRemoval=true)
     */
    private $marcaModelosEquipo;

    /**
     * ToString
     */
    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->grupoMarcasEquipo = new \Doctrine\Common\Collections\ArrayCollection();
        $this->marcaModelosEquipo = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ReqCtlMarcaEquipo
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
     * @return ReqCtlMarcaEquipo
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
     * @return ReqCtlMarcaEquipo
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
     * Set idMarcaGrupo
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlMarcaEquipo $idMarcaGrupo
     *
     * @return ReqCtlMarcaEquipo
     */
    public function setIdMarcaGrupo(\SanRafael\RequerimientosBundle\Entity\ReqCtlMarcaEquipo $idMarcaGrupo = null)
    {
        $this->idMarcaGrupo = $idMarcaGrupo;

        return $this;
    }

    /**
     * Get idMarcaGrupo
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlMarcaEquipo
     */
    public function getIdMarcaGrupo()
    {
        return $this->idMarcaGrupo;
    }

    /**
     * Add grupoMarcasEquipo
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlMarcaEquipo $grupoMarcasEquipo
     *
     * @return ReqCtlMarcaEquipo
     */
    public function addGrupoMarcasEquipo(\SanRafael\RequerimientosBundle\Entity\ReqCtlMarcaEquipo $grupoMarcasEquipo)
    {
        $this->grupoMarcasEquipo[] = $grupoMarcasEquipo;

        return $this;
    }

    /**
     * Remove grupoMarcasEquipo
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlMarcaEquipo $grupoMarcasEquipo
     */
    public function removeGrupoMarcasEquipo(\SanRafael\RequerimientosBundle\Entity\ReqCtlMarcaEquipo $grupoMarcasEquipo)
    {
        $this->grupoMarcasEquipo->removeElement($grupoMarcasEquipo);
    }

    /**
     * Get grupoMarcasEquipo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGrupoMarcasEquipo()
    {
        return $this->grupoMarcasEquipo;
    }

    /**
     * Add marcaModelosEquipo
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlModeloEquipo $marcaModelosEquipo
     *
     * @return ReqCtlMarcaEquipo
     */
    public function addMarcaModelosEquipo(\SanRafael\RequerimientosBundle\Entity\ReqCtlModeloEquipo $marcaModelosEquipo)
    {
        $this->marcaModelosEquipo[] = $marcaModelosEquipo;

        return $this;
    }

    /**
     * Remove marcaModelosEquipo
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlModeloEquipo $marcaModelosEquipo
     */
    public function removeMarcaModelosEquipo(\SanRafael\RequerimientosBundle\Entity\ReqCtlModeloEquipo $marcaModelosEquipo)
    {
        $this->marcaModelosEquipo->removeElement($marcaModelosEquipo);
    }

    /**
     * Get marcaModelosEquipo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMarcaModelosEquipo()
    {
        return $this->marcaModelosEquipo;
    }
}
