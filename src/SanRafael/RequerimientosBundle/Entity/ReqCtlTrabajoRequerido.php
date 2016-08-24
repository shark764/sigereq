<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqCtlTrabajoRequerido
 *
 * @ORM\Table(name="req_ctl_trabajo_requerido", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_trabajo_requerido", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_577A5776DDC7A485", columns={"id_area_trabajo"}), @ORM\Index(name="IDX_577A5776E361769B", columns={"id_trabajo_requerido_padre"})})
 * @ORM\Entity(repositoryClass="SanRafael\RequerimientosBundle\Repository\TrabajoRequeridoRepository")
 */
class ReqCtlTrabajoRequerido
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_ctl_trabajo_requerido_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="requerimiento", type="string", length=255, nullable=false)
     */
    private $requerimiento = 'Asignación de equipo de cómputo';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", nullable=true)
     */
    private $codigo = '000000';

    /**
     * @var \ReqCtlAreaTrabajo
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlAreaTrabajo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_trabajo", referencedColumnName="id")
     * })
     */
    private $idAreaTrabajo;

    /**
     * @var \ReqCtlTrabajoRequerido
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlTrabajoRequerido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_trabajo_requerido_padre", referencedColumnName="id")
     * })
     */
    private $idTrabajoRequeridoPadre;

    public function __toString()
    {
        return $this->requerimiento ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->requerimiento), 'utf-8') : '';
    }

}