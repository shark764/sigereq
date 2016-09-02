<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqCtlSexo
 *
 * @ORM\Table(name="req_ctl_sexo", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_sexo", columns={"codigo"})})
 * @ORM\Entity
 */
class ReqCtlSexo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_ctl_sexo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=15, nullable=false)
     */
    private $sexo = 'Masculino';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=1, nullable=false)
     */
    private $codigo = 'M';


}

