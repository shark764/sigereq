<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlTipoAtencion
 *
 * @ORM\Table(name="ctl_tipo_atencion")
 * @ORM\Entity
 */
class CtlTipoAtencion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_tipo_atencion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_tipo_atencion_padre", type="integer", nullable=true)
     */
    private $idTipoAtencionPadre;

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->nombre ? : '';
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return CtlTipoAtencion
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set idTipoAtencionPadre
     *
     * @param integer $idTipoAtencionPadre
     *
     * @return CtlTipoAtencion
     */
    public function setIdTipoAtencionPadre($idTipoAtencionPadre)
    {
        $this->idTipoAtencionPadre = $idTipoAtencionPadre;

        return $this;
    }

    /**
     * Get idTipoAtencionPadre
     *
     * @return integer
     */
    public function getIdTipoAtencionPadre()
    {
        return $this->idTipoAtencionPadre;
    }

}