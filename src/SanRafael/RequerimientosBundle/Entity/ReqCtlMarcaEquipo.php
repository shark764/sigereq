<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqCtlMarcaEquipo
 *
 * @ORM\Table(name="req_ctl_marca_equipo", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_marca_equipo", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_ED7C31B9CCF415DC", columns={"id_marca_grupo"})})
 * @ORM\Entity
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
     */
    private $nombre = 'DELL';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=3, nullable=false)
     */
    private $codigo = 'DLL';

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristicas", type="text", nullable=true)
     */
    private $caracteristicas;

    /**
     * @var \ReqCtlMarcaEquipo
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlMarcaEquipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_marca_grupo", referencedColumnName="id")
     * })
     */
    private $idMarcaGrupo;


}

