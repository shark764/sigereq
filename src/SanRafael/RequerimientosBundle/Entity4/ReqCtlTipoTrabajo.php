<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqCtlTipoTrabajo
 *
 * @ORM\Table(name="req_ctl_tipo_trabajo", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_tipo_trabajo", columns={"codigo"})})
 * @ORM\Entity
 */
class ReqCtlTipoTrabajo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_ctl_tipo_trabajo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=25, nullable=false)
     */
    private $nombre = 'Trabajo Correctivo';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=1, nullable=true)
     */
    private $codigo = 'C';

    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }
    
}
