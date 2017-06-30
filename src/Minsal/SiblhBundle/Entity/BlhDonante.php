<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhDonante
 *
 * @ORM\Table(name="blh_donante", indexes={@ORM\Index(name="fk_municipio_donante", columns={"id_municipio"}), @ORM\Index(name="fk_banco_de_leche_donante", columns={"id_banco_de_leche"}), @ORM\Index(name="fki_blh_dona_fk_naciona_blh", columns={"nacionalidad"}), @ORM\Index(name="fki_blh_dona_fk_nacionalidad_blh", columns={"nacionalidad"})})
 * @ORM\Entity
 */
class BlhDonante
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_donante_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_donante", type="string", length=14, nullable=false)
     */
    private $codigoDonante;

    /**
     * @var string
     *
     * @ORM\Column(name="primer_nombre", type="string", length=15, nullable=false)
     */
    private $primerNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="segundo_nombre", type="string", length=15, nullable=true)
     */
    private $segundoNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="primer_apellido", type="string", length=15, nullable=false)
     */
    private $primerApellido;

    /**
     * @var string
     *
     * @ORM\Column(name="segundo_apellido", type="string", length=15, nullable=true)
     */
    private $segundoApellido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=false)
     */
    private $fechaNacimiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro_donante_blh", type="date", nullable=true)
     */
    private $fechaRegistroDonanteBlh;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_fijo", type="string", length=9, nullable=true)
     */
    private $telefonoFijo;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_movil", type="string", length=9, nullable=true)
     */
    private $telefonoMovil;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=100, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="procedencia", type="string", length=20, nullable=true)
     */
    private $procedencia;

    /**
     * @var string
     *
     * @ORM\Column(name="registro", type="string", length=12, nullable=true)
     */
    private $registro;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_documento_identificacion", type="string", length=10, nullable=false)
     */
    private $numeroDocumentoIdentificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="documento_identificacion", type="string", length=20, nullable=false)
     */
    private $documentoIdentificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad", type="integer", nullable=true)
     */
    private $edad;

    /**
     * @var string
     *
     * @ORM\Column(name="ocupacion", type="string", length=15, nullable=true)
     */
    private $ocupacion;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_civil", type="string", length=10, nullable=false)
     */
    private $estadoCivil;

    /**
     * @var string
     *
     * @ORM\Column(name="escolaridad", type="string", length=15, nullable=true)
     */
    private $escolaridad;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_colecta", type="string", length=10, nullable=false)
     */
    private $tipoColecta;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=150, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=8, nullable=true)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario", type="integer", nullable=true)
     */
    private $usuario;

    /**
     * @var \BlhBancoDeLeche
     *
     * @ORM\ManyToOne(targetEntity="BlhBancoDeLeche")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_banco_de_leche", referencedColumnName="id")
     * })
     */
    private $idBancoDeLeche;

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
     * @var \CtlNacionalidad
     *
     * @ORM\ManyToOne(targetEntity="CtlNacionalidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nacionalidad", referencedColumnName="id")
     * })
     */
    private $nacionalidad;


}

