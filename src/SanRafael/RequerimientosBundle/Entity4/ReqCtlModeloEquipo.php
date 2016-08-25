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
     * @ORM\Column(name="codigo", type="string", length=10, nullable=false)
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
    
}