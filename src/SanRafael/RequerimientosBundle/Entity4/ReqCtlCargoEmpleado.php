<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqCtlCargoEmpleado
 *
 * @ORM\Table(name="req_ctl_cargo_empleado", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_cargo_empleado", columns={"codigo"})})
 * @ORM\Entity
 */
class ReqCtlCargoEmpleado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_ctl_cargo_empleado_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=150, nullable=false)
     */
    private $nombre = 'Director de Hospital';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=3, nullable=false)
     */
    private $codigo = 'DHP';

    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }
    
}
