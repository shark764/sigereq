<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqCtlEstadoRequerimiento
 *
 * @ORM\Table(name="req_ctl_estado_requerimiento", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_estado_requerimiento", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_3F450511FA5F996B", columns={"id_estado_padre"})})
 * @ORM\Entity
 */
class ReqCtlEstadoRequerimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_ctl_estado_requerimiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=75, nullable=false)
     */
    private $nombre = 'Requerimiento recibido';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=3, nullable=false)
     */
    private $codigo = 'RRC';

    /**
     * @var \ReqCtlEstadoRequerimiento
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlEstadoRequerimiento", inversedBy="estadoSubestadosRequerimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_padre", referencedColumnName="id")
     * })
     */
    private $idEstadoPadre;

    /**
     * @ORM\OneToMany(targetEntity="ReqCtlEstadoRequerimiento", mappedBy="idEstadoPadre", cascade={"all"}, orphanRemoval=true)
     */
    private $estadoSubestadosRequerimiento;

    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }
    
}
