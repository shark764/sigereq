<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlAtencion
 *
 * @ORM\Table(name="ctl_atencion", indexes={@ORM\Index(name="IDX_5075A312C5DC305D", columns={"id_atencion_padre"}), @ORM\Index(name="IDX_5075A3125168C468", columns={"id_tipo_atencion"})})
 * @ORM\Entity
 */
class CtlAtencion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_atencion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_busqueda", type="string", length=6, nullable=true)
     */
    private $codigoBusqueda;

    /**
     * @var \CtlAtencion
     *
     * @ORM\ManyToOne(targetEntity="CtlAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_atencion_padre", referencedColumnName="id")
     * })
     */
    private $idAtencionPadre;

    /**
     * @var \CtlTipoAtencion
     *
     * @ORM\ManyToOne(targetEntity="CtlTipoAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_atencion", referencedColumnName="id")
     * })
     */
    private $idTipoAtencion;

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
     * @return CtlAtencion
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
     * Set codigoBusqueda
     *
     * @param string $codigoBusqueda
     *
     * @return CtlAtencion
     */
    public function setCodigoBusqueda($codigoBusqueda)
    {
        $this->codigoBusqueda = $codigoBusqueda;

        return $this;
    }

    /**
     * Get codigoBusqueda
     *
     * @return string
     */
    public function getCodigoBusqueda()
    {
        return $this->codigoBusqueda;
    }

    /**
     * Set idAtencionPadre
     *
     * @param \Minsal\SiapsBundle\Entity\CtlAtencion $idAtencionPadre
     *
     * @return CtlAtencion
     */
    public function setIdAtencionPadre(\Minsal\SiapsBundle\Entity\CtlAtencion $idAtencionPadre = null)
    {
        $this->idAtencionPadre = $idAtencionPadre;

        return $this;
    }

    /**
     * Get idAtencionPadre
     *
     * @return \Minsal\SiapsBundle\Entity\CtlAtencion
     */
    public function getIdAtencionPadre()
    {
        return $this->idAtencionPadre;
    }

    /**
     * Set idTipoAtencion
     *
     * @param \Minsal\SiapsBundle\Entity\CtlTipoAtencion $idTipoAtencion
     *
     * @return CtlAtencion
     */
    public function setIdTipoAtencion(\Minsal\SiapsBundle\Entity\CtlTipoAtencion $idTipoAtencion = null)
    {
        $this->idTipoAtencion = $idTipoAtencion;

        return $this;
    }

    /**
     * Get idTipoAtencion
     *
     * @return \Minsal\SiapsBundle\Entity\CtlTipoAtencion
     */
    public function getIdTipoAtencion()
    {
        return $this->idTipoAtencion;
    }

}