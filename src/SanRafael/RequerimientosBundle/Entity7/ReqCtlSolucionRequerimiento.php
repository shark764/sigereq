<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqCtlSolucionRequerimiento
 *
 * @ORM\Table(name="req_ctl_solucion_requerimiento", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_solucion_requerimiento", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_A204D7AB1B0A8FB", columns={"id_solucion_padre"})})
 * @ORM\Entity
 */
class ReqCtlSolucionRequerimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_ctl_solucion_requerimiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=150, nullable=false)
     */
    private $nombre = 'Funciona correctamente';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=3, nullable=false)
     */
    private $codigo = 'FNC';

    /**
     * @var \ReqCtlSolucionRequerimiento
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlSolucionRequerimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solucion_padre", referencedColumnName="id")
     * })
     */
    private $idSolucionPadre;


}

