<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlDepartamento
 *
 * @ORM\Table(name="ctl_departamento", indexes={@ORM\Index(name="IDX_C3F1602B24308A3B", columns={"id_establecimiento_region"}), @ORM\Index(name="IDX_C3F1602BF57D32FD", columns={"id_pais"})})
 * @ORM\Entity
 */
class CtlDepartamento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_departamento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=150, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_cnr", type="string", length=5, nullable=true)
     */
    private $codigoCnr;

    /**
     * @var string
     *
     * @ORM\Column(name="abreviatura", type="string", length=5, nullable=true)
     */
    private $abreviatura;

    /**
     * @var string
     *
     * @ORM\Column(name="iso31662", type="string", length=5, nullable=true)
     */
    private $iso31662;

    /**
     * @var \CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento_region", referencedColumnName="id")
     * })
     */
    private $idEstablecimientoRegion;

    /**
     * @var \CtlPais
     *
     * @ORM\ManyToOne(targetEntity="CtlPais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pais", referencedColumnName="id")
     * })
     */
    private $idPais;

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
     * @return CtlDepartamento
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
     * Set codigoCnr
     *
     * @param string $codigoCnr
     *
     * @return CtlDepartamento
     */
    public function setCodigoCnr($codigoCnr)
    {
        $this->codigoCnr = $codigoCnr;

        return $this;
    }

    /**
     * Get codigoCnr
     *
     * @return string
     */
    public function getCodigoCnr()
    {
        return $this->codigoCnr;
    }

    /**
     * Set abreviatura
     *
     * @param string $abreviatura
     *
     * @return CtlDepartamento
     */
    public function setAbreviatura($abreviatura)
    {
        $this->abreviatura = $abreviatura;

        return $this;
    }

    /**
     * Get abreviatura
     *
     * @return string
     */
    public function getAbreviatura()
    {
        return $this->abreviatura;
    }

    /**
     * Set iso31662
     *
     * @param string $iso31662
     *
     * @return CtlDepartamento
     */
    public function setIso31662($iso31662)
    {
        $this->iso31662 = $iso31662;

        return $this;
    }

    /**
     * Get iso31662
     *
     * @return string
     */
    public function getIso31662()
    {
        return $this->iso31662;
    }

    /**
     * Set idEstablecimientoRegion
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoRegion
     *
     * @return CtlDepartamento
     */
    public function setIdEstablecimientoRegion(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoRegion = null)
    {
        $this->idEstablecimientoRegion = $idEstablecimientoRegion;

        return $this;
    }

    /**
     * Get idEstablecimientoRegion
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    public function getIdEstablecimientoRegion()
    {
        return $this->idEstablecimientoRegion;
    }

    /**
     * Set idPais
     *
     * @param \Minsal\SiapsBundle\Entity\CtlPais $idPais
     *
     * @return CtlDepartamento
     */
    public function setIdPais(\Minsal\SiapsBundle\Entity\CtlPais $idPais = null)
    {
        $this->idPais = $idPais;

        return $this;
    }

    /**
     * Get idPais
     *
     * @return \Minsal\SiapsBundle\Entity\CtlPais
     */
    public function getIdPais()
    {
        return $this->idPais;
    }

}