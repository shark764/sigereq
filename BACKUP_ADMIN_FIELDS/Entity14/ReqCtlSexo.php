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

    public function __toString()
    {
        return $this->sexo ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->sexo), 'utf-8') : '';
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     *
     * @return ReqCtlSexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     *
     * @return ReqCtlSexo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }
}
