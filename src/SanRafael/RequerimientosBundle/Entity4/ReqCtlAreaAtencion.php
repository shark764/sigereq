<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqCtlAreaAtencion
 *
 * @ORM\Table(name="req_ctl_area_atencion", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_area_atencion", columns={"codigo"})})
 * @ORM\Entity(repositoryClass="SanRafael\RequerimientosBundle\Repository\AreaAtencionRepository")
 */
class ReqCtlAreaAtencion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_ctl_area_atencion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=3, nullable=true)
     */
    private $codigo;

    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }
    
}
