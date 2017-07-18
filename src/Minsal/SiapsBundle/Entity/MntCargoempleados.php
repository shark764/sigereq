<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntCargoempleados
 *
 * @ORM\Table(name="mnt_cargoempleados", indexes={@ORM\Index(name="IDX_5AECE799695EA351", columns={"id_atencion"})})
 * @ORM\Entity
 */
class MntCargoempleados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_cargoempleados_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=50, nullable=true)
     */
    private $cargo;

    /**
     * @var \CtlAtencion
     *
     * @ORM\ManyToOne(targetEntity="CtlAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_atencion", referencedColumnName="id")
     * })
     */
    private $idAtencion;

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->cargo ? : '';
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
     * Set cargo
     *
     * @param string $cargo
     *
     * @return MntCargoempleados
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get cargo
     *
     * @return string
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set idAtencion
     *
     * @param \Minsal\SiapsBundle\Entity\CtlAtencion $idAtencion
     *
     * @return MntCargoempleados
     */
    public function setIdAtencion(\Minsal\SiapsBundle\Entity\CtlAtencion $idAtencion = null)
    {
        $this->idAtencion = $idAtencion;

        return $this;
    }

    /**
     * Get idAtencion
     *
     * @return \Minsal\SiapsBundle\Entity\CtlAtencion
     */
    public function getIdAtencion()
    {
        return $this->idAtencion;
    }

}
