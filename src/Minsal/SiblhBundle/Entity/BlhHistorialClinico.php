<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhHistorialClinico
 *
 * @ORM\Table(name="blh_historial_clinico", indexes={@ORM\Index(name="IDX_33FD85BC54F03532", columns={"id_donante"}), @ORM\Index(name="IDX_33FD85BC7DFA12F6", columns={"id_establecimiento"})})
 * @ORM\Entity
 */
class BlhHistorialClinico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_historial_clinico_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="control_prenatal", type="string", length=2, nullable=false)
     */
    private $controlPrenatal;

    /**
     * @var string
     *
     * @ORM\Column(name="edad_gest_fur", type="decimal", precision=6, scale=4, nullable=true)
     */
    private $edadGestFur;

    /**
     * @var string
     *
     * @ORM\Column(name="lugar_control", type="string", length=25, nullable=true)
     */
    private $lugarControl;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_control", type="integer", nullable=true)
     */
    private $numeroControl;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_parto", type="date", nullable=false)
     */
    private $fechaParto;

    /**
     * @var string
     *
     * @ORM\Column(name="lugar_parto", type="string", length=150, nullable=false)
     */
    private $lugarParto;

    /**
     * @var string
     *
     * @ORM\Column(name="patologia_embarazo", type="string", length=20, nullable=true)
     */
    private $patologiaEmbarazo;

    /**
     * @var integer
     *
     * @ORM\Column(name="periodo_intergenesico", type="integer", nullable=false)
     */
    private $periodoIntergenesico;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_parto_anterior", type="date", nullable=true)
     */
    private $fechaPartoAnterior;

    /**
     * @var string
     *
     * @ORM\Column(name="formula_obstetrica_g", type="string", length=2, nullable=true)
     */
    private $formulaObstetricaG;

    /**
     * @var string
     *
     * @ORM\Column(name="formula_obstetrica_p1", type="string", length=2, nullable=true)
     */
    private $formulaObstetricaP1;

    /**
     * @var string
     *
     * @ORM\Column(name="formula_obstetrica_p2", type="string", length=2, nullable=true)
     */
    private $formulaObstetricaP2;

    /**
     * @var string
     *
     * @ORM\Column(name="formula_obstetrica_a", type="string", length=2, nullable=true)
     */
    private $formulaObstetricaA;

    /**
     * @var string
     *
     * @ORM\Column(name="formula_obstetrica_v", type="string", length=2, nullable=true)
     */
    private $formulaObstetricaV;

    /**
     * @var string
     *
     * @ORM\Column(name="formula_obstetrica_m", type="string", length=2, nullable=true)
     */
    private $formulaObstetricaM;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario", type="integer", nullable=true)
     */
    private $usuario;

    /**
     * @var \BlhDonante
     *
     * @ORM\ManyToOne(targetEntity="BlhDonante")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_donante", referencedColumnName="id")
     * })
     */
    private $idDonante;

    /**
     * @var \CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     */
    private $idEstablecimiento;


}

