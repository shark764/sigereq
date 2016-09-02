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
     * @ORM\ManyToOne(targetEntity="ReqCtlTipoEquipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_padre", referencedColumnName="id")
     * })
     */
    private $idTipoPadre;


}

