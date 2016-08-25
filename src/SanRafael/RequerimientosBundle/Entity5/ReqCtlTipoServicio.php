<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqCtlTipoServicio
 *
 * @ORM\Table(name="req_ctl_tipo_servicio", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_tipo_servicio", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_BB5B956705370F4", columns={"id_tipo_padre"})})
 * @ORM\Entity
 */
class ReqCtlTipoServicio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_ctl_tipo_servicio_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=true)
     */
    private $nombre = 'División Administrativa';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=3, nullable=true)
     */
    private $codigo = 'ADM';

    /**
     * @var \ReqCtlTipoServicio
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlTipoServicio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_padre", referencedColumnName="id")
     * })
     */
    private $idTipoPadre;


}
