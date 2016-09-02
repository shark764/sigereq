<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqCtlEstadoEquipo
 *
 * @ORM\Table(name="req_ctl_estado_equipo", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_estado_equipo", columns={"codigo"})})
 * @ORM\Entity
 */
class ReqCtlEstadoEquipo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_ctl_estado_equipo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=75, nullable=false)
     */
    private $nombre = 'Equipo se encuentra funcionando correctamente';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=3, nullable=true)
     */
    private $codigo = 'FNC';


}

