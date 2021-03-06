<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqCtlAreaTrabajo
 *
 * @ORM\Table(name="req_ctl_area_trabajo", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_area_trabajo", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_64D82128FB25A2E6", columns={"id_area_padre"})})
 * @ORM\Entity
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
     * @ORM\Column(name="codigo", type="string", nullable=false)
     */
    private $codigo = 'DSI';

    /**
     * @var \ReqCtlAreaTrabajo
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlAreaTrabajo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_padre", referencedColumnName="id")
     * })
     */
    private $idAreaPadre;

    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }

}