<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqCtlModalidadAtencion
 *
 * @ORM\Table(name="req_ctl_modalidad_atencion", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_modalidad_atencion", columns={"codigo"})})
 * @ORM\Entity
 */
class ReqCtlModalidadAtencion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_ctl_modalidad_atencion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=25, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=6, nullable=false)
     */
    private $codigo;


}

