<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlEstablecimiento
 *
 * @ORM\Table(name="ctl_establecimiento", indexes={@ORM\Index(name="IDX_332BD42CEF433A34", columns={"id_institucion"}), @ORM\Index(name="IDX_332BD42C3544B551", columns={"id_establecimiento_padre"}), @ORM\Index(name="IDX_332BD42C7EAD49C7", columns={"id_municipio"}), @ORM\Index(name="IDX_332BD42C4E0E50FD", columns={"id_tipo_establecimiento"})})
 * @ORM\Entity
 */
class CtlEstablecimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_establecimiento_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="direccion", type="string", length=250, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=15, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=15, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="latitud", type="decimal", precision=10, scale=4, nullable=true)
     */
    private $latitud;

    /**
     * @var string
     *
     * @ORM\Column(name="longitud", type="decimal", precision=10, scale=4, nullable=true)
     */
    private $longitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_nivel_minsal", type="integer", nullable=true)
     */
    private $idNivelMinsal;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_ucsf", type="integer", nullable=true)
     */
    private $codUcsf;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=true)
     */
    private $activo;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_expediente", type="string", length=1, nullable=true)
     */
    private $tipoExpediente;

    /**
     * @var boolean
     *
     * @ORM\Column(name="configurado", type="boolean", nullable=true)
     */
    private $configurado;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tipo_farmacia", type="boolean", nullable=true)
     */
    private $tipoFarmacia;

    /**
     * @var integer
     *
     * @ORM\Column(name="dias_intermedios_citas", type="integer", nullable=true)
     */
    private $diasIntermediosCitas;

    /**
     * @var boolean
     *
     * @ORM\Column(name="citas_sin_expediente", type="boolean", nullable=true)
     */
    private $citasSinExpediente = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_impresion", type="integer", nullable=true)
     */
    private $tipoImpresion = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="minutoshora", type="integer", nullable=true)
     */
    private $minutoshora;

    /**
     * @var integer
     *
     * @ORM\Column(name="tiempoprevioalacita", type="integer", nullable=true)
     */
    private $tiempoprevioalacita;

    /**
     * @var boolean
     *
     * @ORM\Column(name="distribucion_especial", type="boolean", nullable=true)
     */
    private $distribucionEspecial = false;

    /**
     * @var \CtlInstitucion
     *
     * @ORM\ManyToOne(targetEntity="CtlInstitucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_institucion", referencedColumnName="id")
     * })
     */
    private $idInstitucion;

    /**
     * @var \CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento_padre", referencedColumnName="id")
     * })
     */
    private $idEstablecimientoPadre;

    /**
     * @var \CtlMunicipio
     *
     * @ORM\ManyToOne(targetEntity="CtlMunicipio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_municipio", referencedColumnName="id")
     * })
     */
    private $idMunicipio;

    /**
     * @var \CtlTipoEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="CtlTipoEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_establecimiento", referencedColumnName="id")
     * })
     */
    private $idTipoEstablecimiento;


}

