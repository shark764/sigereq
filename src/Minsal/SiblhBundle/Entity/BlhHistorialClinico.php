<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhHistorialClinico
 *
 * @ORM\Table(name="blh_historial_clinico", indexes={@ORM\Index(name="IDX_33FD85BC54F03532", columns={"id_donante"}), @ORM\Index(name="IDX_33FD85BC7DFA12F6", columns={"id_establecimiento"})})
 * @ORM\Entity
 */
class BlhHistorialClinico implements EntityInterface
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
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $controlPrenatal;

    /**
     * @var string
     *
     * @ORM\Column(name="edad_gest_fur", type="decimal", precision=6, scale=4, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $edadGestFur;

    /**
     * @var string
     *
     * @ORM\Column(name="lugar_control", type="string", length=25, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $lugarControl;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_control", type="integer", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $numeroControl;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_parto", type="date", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Date()
     */
    private $fechaParto;

    /**
     * @var string
     *
     * @ORM\Column(name="lugar_parto", type="string", length=150, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $lugarParto;

    /**
     * @var string
     *
     * @ORM\Column(name="patologia_embarazo", type="string", length=20, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $patologiaEmbarazo;

    /**
     * @var integer
     *
     * @ORM\Column(name="periodo_intergenesico", type="integer", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $periodoIntergenesico;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_parto_anterior", type="date", nullable=true)
     * @Assert\Date()
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
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $usuario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_reg", type="datetime", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\DateTime()
     */
    private $fechaHoraReg;

    /**
     * @var \BlhDonante
     *
     * @ORM\ManyToOne(targetEntity="BlhDonante")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_donante", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idDonante;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idEstablecimiento;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_reg", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idUserReg;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->id;
    }
    
    /**
     * Text converter for the Entity (Second form).
     */
    public function getPresentacionEntidad()
    {
    }
    
    /**
     * Text converter for the Entity (Third form).
     */
    public function getFormatoPresentacionEntidad()
    {
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
     * Set controlPrenatal
     *
     * @param string $controlPrenatal
     *
     * @return BlhHistorialClinico
     */
    public function setControlPrenatal($controlPrenatal)
    {
        $this->controlPrenatal = $controlPrenatal;

        return $this;
    }

    /**
     * Get controlPrenatal
     *
     * @return string
     */
    public function getControlPrenatal()
    {
        return $this->controlPrenatal;
    }

    /**
     * Set edadGestFur
     *
     * @param string $edadGestFur
     *
     * @return BlhHistorialClinico
     */
    public function setEdadGestFur($edadGestFur)
    {
        $this->edadGestFur = $edadGestFur;

        return $this;
    }

    /**
     * Get edadGestFur
     *
     * @return string
     */
    public function getEdadGestFur()
    {
        return $this->edadGestFur;
    }

    /**
     * Set lugarControl
     *
     * @param string $lugarControl
     *
     * @return BlhHistorialClinico
     */
    public function setLugarControl($lugarControl)
    {
        $this->lugarControl = $lugarControl;

        return $this;
    }

    /**
     * Get lugarControl
     *
     * @return string
     */
    public function getLugarControl()
    {
        return $this->lugarControl;
    }

    /**
     * Set numeroControl
     *
     * @param integer $numeroControl
     *
     * @return BlhHistorialClinico
     */
    public function setNumeroControl($numeroControl)
    {
        $this->numeroControl = $numeroControl;

        return $this;
    }

    /**
     * Get numeroControl
     *
     * @return integer
     */
    public function getNumeroControl()
    {
        return $this->numeroControl;
    }

    /**
     * Set fechaParto
     *
     * @param \DateTime $fechaParto
     *
     * @return BlhHistorialClinico
     */
    public function setFechaParto($fechaParto)
    {
        $this->fechaParto = $fechaParto;

        return $this;
    }

    /**
     * Get fechaParto
     *
     * @return \DateTime
     */
    public function getFechaParto()
    {
        return $this->fechaParto;
    }

    /**
     * Set lugarParto
     *
     * @param string $lugarParto
     *
     * @return BlhHistorialClinico
     */
    public function setLugarParto($lugarParto)
    {
        $this->lugarParto = $lugarParto;

        return $this;
    }

    /**
     * Get lugarParto
     *
     * @return string
     */
    public function getLugarParto()
    {
        return $this->lugarParto;
    }

    /**
     * Set patologiaEmbarazo
     *
     * @param string $patologiaEmbarazo
     *
     * @return BlhHistorialClinico
     */
    public function setPatologiaEmbarazo($patologiaEmbarazo)
    {
        $this->patologiaEmbarazo = $patologiaEmbarazo;

        return $this;
    }

    /**
     * Get patologiaEmbarazo
     *
     * @return string
     */
    public function getPatologiaEmbarazo()
    {
        return $this->patologiaEmbarazo;
    }

    /**
     * Set periodoIntergenesico
     *
     * @param integer $periodoIntergenesico
     *
     * @return BlhHistorialClinico
     */
    public function setPeriodoIntergenesico($periodoIntergenesico)
    {
        $this->periodoIntergenesico = $periodoIntergenesico;

        return $this;
    }

    /**
     * Get periodoIntergenesico
     *
     * @return integer
     */
    public function getPeriodoIntergenesico()
    {
        return $this->periodoIntergenesico;
    }

    /**
     * Set fechaPartoAnterior
     *
     * @param \DateTime $fechaPartoAnterior
     *
     * @return BlhHistorialClinico
     */
    public function setFechaPartoAnterior($fechaPartoAnterior)
    {
        $this->fechaPartoAnterior = $fechaPartoAnterior;

        return $this;
    }

    /**
     * Get fechaPartoAnterior
     *
     * @return \DateTime
     */
    public function getFechaPartoAnterior()
    {
        return $this->fechaPartoAnterior;
    }

    /**
     * Set formulaObstetricaG
     *
     * @param string $formulaObstetricaG
     *
     * @return BlhHistorialClinico
     */
    public function setFormulaObstetricaG($formulaObstetricaG)
    {
        $this->formulaObstetricaG = $formulaObstetricaG;

        return $this;
    }

    /**
     * Get formulaObstetricaG
     *
     * @return string
     */
    public function getFormulaObstetricaG()
    {
        return $this->formulaObstetricaG;
    }

    /**
     * Set formulaObstetricaP1
     *
     * @param string $formulaObstetricaP1
     *
     * @return BlhHistorialClinico
     */
    public function setFormulaObstetricaP1($formulaObstetricaP1)
    {
        $this->formulaObstetricaP1 = $formulaObstetricaP1;

        return $this;
    }

    /**
     * Get formulaObstetricaP1
     *
     * @return string
     */
    public function getFormulaObstetricaP1()
    {
        return $this->formulaObstetricaP1;
    }

    /**
     * Set formulaObstetricaP2
     *
     * @param string $formulaObstetricaP2
     *
     * @return BlhHistorialClinico
     */
    public function setFormulaObstetricaP2($formulaObstetricaP2)
    {
        $this->formulaObstetricaP2 = $formulaObstetricaP2;

        return $this;
    }

    /**
     * Get formulaObstetricaP2
     *
     * @return string
     */
    public function getFormulaObstetricaP2()
    {
        return $this->formulaObstetricaP2;
    }

    /**
     * Set formulaObstetricaA
     *
     * @param string $formulaObstetricaA
     *
     * @return BlhHistorialClinico
     */
    public function setFormulaObstetricaA($formulaObstetricaA)
    {
        $this->formulaObstetricaA = $formulaObstetricaA;

        return $this;
    }

    /**
     * Get formulaObstetricaA
     *
     * @return string
     */
    public function getFormulaObstetricaA()
    {
        return $this->formulaObstetricaA;
    }

    /**
     * Set formulaObstetricaV
     *
     * @param string $formulaObstetricaV
     *
     * @return BlhHistorialClinico
     */
    public function setFormulaObstetricaV($formulaObstetricaV)
    {
        $this->formulaObstetricaV = $formulaObstetricaV;

        return $this;
    }

    /**
     * Get formulaObstetricaV
     *
     * @return string
     */
    public function getFormulaObstetricaV()
    {
        return $this->formulaObstetricaV;
    }

    /**
     * Set formulaObstetricaM
     *
     * @param string $formulaObstetricaM
     *
     * @return BlhHistorialClinico
     */
    public function setFormulaObstetricaM($formulaObstetricaM)
    {
        $this->formulaObstetricaM = $formulaObstetricaM;

        return $this;
    }

    /**
     * Get formulaObstetricaM
     *
     * @return string
     */
    public function getFormulaObstetricaM()
    {
        return $this->formulaObstetricaM;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhHistorialClinico
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return integer
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set fechaHoraReg
     *
     * @param \DateTime $fechaHoraReg
     *
     * @return BlhHistorialClinico
     */
    public function setFechaHoraReg($fechaHoraReg)
    {
        $this->fechaHoraReg = $fechaHoraReg;

        return $this;
    }

    /**
     * Get fechaHoraReg
     *
     * @return \DateTime
     */
    public function getFechaHoraReg()
    {
        return $this->fechaHoraReg;
    }

    /**
     * Set idDonante
     *
     * @param \Minsal\SiblhBundle\Entity\BlhDonante $idDonante
     *
     * @return BlhHistorialClinico
     */
    public function setIdDonante(\Minsal\SiblhBundle\Entity\BlhDonante $idDonante = null)
    {
        $this->idDonante = $idDonante;

        return $this;
    }

    /**
     * Get idDonante
     *
     * @return \Minsal\SiblhBundle\Entity\BlhDonante
     */
    public function getIdDonante()
    {
        return $this->idDonante;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     *
     * @return BlhHistorialClinico
     */
    public function setIdEstablecimiento(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento = null)
    {
        $this->idEstablecimiento = $idEstablecimiento;

        return $this;
    }

    /**
     * Get idEstablecimiento
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    public function getIdEstablecimiento()
    {
        return $this->idEstablecimiento;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     *
     * @return BlhHistorialClinico
     */
    public function setIdUserReg(\Application\Sonata\UserBundle\Entity\User $idUserReg = null)
    {
        $this->idUserReg = $idUserReg;

        return $this;
    }

    /**
     * Get idUserReg
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getIdUserReg()
    {
        return $this->idUserReg;
    }

}