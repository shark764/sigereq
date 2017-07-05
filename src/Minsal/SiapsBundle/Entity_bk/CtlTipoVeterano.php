<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlTipoVeterano
 *
 * @ORM\Table(name="ctl_tipo_veterano")
 * @ORM\Entity
 */
class CtlTipoVeterano
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_tipo_veterano_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_veterano", type="string", length=50, nullable=false)
     */
    private $tipoVeterano;

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->tipoVeterano ? : '';
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
     * Set tipoVeterano
     *
     * @param string $tipoVeterano
     *
     * @return CtlTipoVeterano
     */
    public function setTipoVeterano($tipoVeterano)
    {
        $this->tipoVeterano = $tipoVeterano;

        return $this;
    }

    /**
     * Get tipoVeterano
     *
     * @return string
     */
    public function getTipoVeterano()
    {
        return $this->tipoVeterano;
    }

}