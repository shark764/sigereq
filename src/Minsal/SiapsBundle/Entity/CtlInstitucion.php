<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlInstitucion
 *
 * @ORM\Table(name="ctl_institucion", indexes={@ORM\Index(name="IDX_3123F0D4F57D32FD", columns={"id_pais"})})
 * @ORM\Entity
 */
class CtlInstitucion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_institucion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=150, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=35, nullable=true)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="rectora", type="string", length=10, nullable=true)
     */
    private $rectora;

    /**
     * @var integer
     *
     * @ORM\Column(name="categoria", type="integer", nullable=true)
     */
    private $categoria;

    /**
     * @var string
     *
     * @ORM\Column(name="sigla", type="string", length=14, nullable=true)
     */
    private $sigla;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;

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
     * @return CtlInstitucion
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
     * Set logo
     *
     * @param string $logo
     *
     * @return CtlInstitucion
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set rectora
     *
     * @param string $rectora
     *
     * @return CtlInstitucion
     */
    public function setRectora($rectora)
    {
        $this->rectora = $rectora;

        return $this;
    }

    /**
     * Get rectora
     *
     * @return string
     */
    public function getRectora()
    {
        return $this->rectora;
    }

    /**
     * Set categoria
     *
     * @param integer $categoria
     *
     * @return CtlInstitucion
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return integer
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set sigla
     *
     * @param string $sigla
     *
     * @return CtlInstitucion
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;

        return $this;
    }

    /**
     * Get sigla
     *
     * @return string
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return CtlInstitucion
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set idPais
     *
     * @param \Minsal\SiapsBundle\Entity\CtlPais $idPais
     *
     * @return CtlInstitucion
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