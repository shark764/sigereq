<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhReceptor
 *
 * @ORM\Table(name="blh_receptor", indexes={@ORM\Index(name="fk_paciente_receptor", columns={"id_paciente"}), @ORM\Index(name="fk_banco_de_leche_receptor", columns={"id_banco_de_leche"})})
 * @ORM\Entity
 */
class BlhReceptor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_receptor_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_receptor", type="string", length=14, nullable=true)
     */
    private $codigoReceptor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro_blh", type="date", nullable=true)
     */
    private $fechaRegistroBlh;

    /**
     * @var string
     *
     * @ORM\Column(name="procedencia", type="string", length=20, nullable=true)
     */
    private $procedencia;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_receptor", type="string", length=8, nullable=true)
     */
    private $estadoReceptor;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_dias", type="integer", nullable=false)
     */
    private $edadDias;

    /**
     * @var string
     *
     * @ORM\Column(name="peso_receptor", type="decimal", precision=8, scale=4, nullable=false)
     */
    private $pesoReceptor;

    /**
     * @var integer
     *
     * @ORM\Column(name="duracion_cpap", type="integer", nullable=true)
     */
    private $duracionCpap;

    /**
     * @var string
     *
     * @ORM\Column(name="clasificacion_lubchengo", type="string", length=3, nullable=false)
     */
    private $clasificacionLubchengo;

    /**
     * @var string
     *
     * @ORM\Column(name="diagnostico_ingreso", type="string", length=50, nullable=true)
     */
    private $diagnosticoIngreso;

    /**
     * @var integer
     *
     * @ORM\Column(name="duracion_npt", type="integer", nullable=true)
     */
    private $duracionNpt;

    /**
     * @var string
     *
     * @ORM\Column(name="apgar_primer_minuto", type="decimal", precision=6, scale=4, nullable=true)
     */
    private $apgarPrimerMinuto;

    /**
     * @var string
     *
     * @ORM\Column(name="edad_gest_fur", type="decimal", precision=6, scale=4, nullable=false)
     */
    private $edadGestFur;

    /**
     * @var integer
     *
     * @ORM\Column(name="duracion_ventilacion", type="integer", nullable=true)
     */
    private $duracionVentilacion;

    /**
     * @var string
     *
     * @ORM\Column(name="edad_gest_ballard", type="decimal", precision=6, scale=4, nullable=false)
     */
    private $edadGestBallard;

    /**
     * @var string
     *
     * @ORM\Column(name="pc", type="decimal", precision=6, scale=4, nullable=false)
     */
    private $pc;

    /**
     * @var string
     *
     * @ORM\Column(name="talla_ingreso", type="decimal", precision=7, scale=4, nullable=true)
     */
    private $tallaIngreso;

    /**
     * @var string
     *
     * @ORM\Column(name="apgar_quinto_minuto", type="decimal", precision=6, scale=4, nullable=true)
     */
    private $apgarQuintoMinuto;

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
     * @var \MntPaciente
     *
     * @ORM\ManyToOne(targetEntity="MntPaciente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_paciente", referencedColumnName="id")
     * })
     */
    private $idPaciente;


}

