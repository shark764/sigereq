<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhSeguimientoReceptor
 *
 * @ORM\Table(name="blh_seguimiento_receptor", indexes={@ORM\Index(name="IDX_EB08C6D4B91944F2", columns={"id_receptor"})})
 * @ORM\Entity
 */
class BlhSeguimientoReceptor implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_seguimiento_receptor_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="talla_receptor", type="decimal", precision=7, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $tallaReceptor;

    /**
     * @var string
     *
     * @ORM\Column(name="peso_seguimiento", type="decimal", precision=8, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $pesoSeguimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="pc_seguimiento", type="decimal", precision=6, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $pcSeguimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="ganancia_dia_peso", type="decimal", precision=7, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $gananciaDiaPeso;

    /**
     * @var integer
     *
     * @ORM\Column(name="semana", type="integer", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $semana;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_seguimiento", type="date", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Date()
     */
    private $fechaSeguimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="ganancia_dia_talla", type="decimal", precision=7, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $gananciaDiaTalla;

    /**
     * @var string
     *
     * @ORM\Column(name="complicaciones", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $complicaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=150, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $observacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="periodo_evaluacion", type="integer", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $periodoEvaluacion;

    /**
     * @var string
     *
     * @ORM\Column(name="ganancia_dia_pc", type="decimal", precision=7, scale=4, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $gananciaDiaPc;

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
     * @var \BlhReceptor
     *
     * @ORM\ManyToOne(targetEntity="BlhReceptor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_receptor", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idReceptor;

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
        return (string) $this->idReceptor . ' - ' . $this->fechaSeguimiento;
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
     * Set tallaReceptor
     *
     * @param string $tallaReceptor
     *
     * @return BlhSeguimientoReceptor
     */
    public function setTallaReceptor($tallaReceptor)
    {
        $this->tallaReceptor = $tallaReceptor;

        return $this;
    }

    /**
     * Get tallaReceptor
     *
     * @return string
     */
    public function getTallaReceptor()
    {
        return $this->tallaReceptor;
    }

    /**
     * Set pesoSeguimiento
     *
     * @param string $pesoSeguimiento
     *
     * @return BlhSeguimientoReceptor
     */
    public function setPesoSeguimiento($pesoSeguimiento)
    {
        $this->pesoSeguimiento = $pesoSeguimiento;

        return $this;
    }

    /**
     * Get pesoSeguimiento
     *
     * @return string
     */
    public function getPesoSeguimiento()
    {
        return $this->pesoSeguimiento;
    }

    /**
     * Set pcSeguimiento
     *
     * @param string $pcSeguimiento
     *
     * @return BlhSeguimientoReceptor
     */
    public function setPcSeguimiento($pcSeguimiento)
    {
        $this->pcSeguimiento = $pcSeguimiento;

        return $this;
    }

    /**
     * Get pcSeguimiento
     *
     * @return string
     */
    public function getPcSeguimiento()
    {
        return $this->pcSeguimiento;
    }

    /**
     * Set gananciaDiaPeso
     *
     * @param string $gananciaDiaPeso
     *
     * @return BlhSeguimientoReceptor
     */
    public function setGananciaDiaPeso($gananciaDiaPeso)
    {
        $this->gananciaDiaPeso = $gananciaDiaPeso;

        return $this;
    }

    /**
     * Get gananciaDiaPeso
     *
     * @return string
     */
    public function getGananciaDiaPeso()
    {
        return $this->gananciaDiaPeso;
    }

    /**
     * Set semana
     *
     * @param integer $semana
     *
     * @return BlhSeguimientoReceptor
     */
    public function setSemana($semana)
    {
        $this->semana = $semana;

        return $this;
    }

    /**
     * Get semana
     *
     * @return integer
     */
    public function getSemana()
    {
        return $this->semana;
    }

    /**
     * Set fechaSeguimiento
     *
     * @param \DateTime $fechaSeguimiento
     *
     * @return BlhSeguimientoReceptor
     */
    public function setFechaSeguimiento($fechaSeguimiento)
    {
        $this->fechaSeguimiento = $fechaSeguimiento;

        return $this;
    }

    /**
     * Get fechaSeguimiento
     *
     * @return \DateTime
     */
    public function getFechaSeguimiento()
    {
        return $this->fechaSeguimiento;
    }

    /**
     * Set gananciaDiaTalla
     *
     * @param string $gananciaDiaTalla
     *
     * @return BlhSeguimientoReceptor
     */
    public function setGananciaDiaTalla($gananciaDiaTalla)
    {
        $this->gananciaDiaTalla = $gananciaDiaTalla;

        return $this;
    }

    /**
     * Get gananciaDiaTalla
     *
     * @return string
     */
    public function getGananciaDiaTalla()
    {
        return $this->gananciaDiaTalla;
    }

    /**
     * Set complicaciones
     *
     * @param string $complicaciones
     *
     * @return BlhSeguimientoReceptor
     */
    public function setComplicaciones($complicaciones)
    {
        $this->complicaciones = $complicaciones;

        return $this;
    }

    /**
     * Get complicaciones
     *
     * @return string
     */
    public function getComplicaciones()
    {
        return $this->complicaciones;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     *
     * @return BlhSeguimientoReceptor
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set periodoEvaluacion
     *
     * @param integer $periodoEvaluacion
     *
     * @return BlhSeguimientoReceptor
     */
    public function setPeriodoEvaluacion($periodoEvaluacion)
    {
        $this->periodoEvaluacion = $periodoEvaluacion;

        return $this;
    }

    /**
     * Get periodoEvaluacion
     *
     * @return integer
     */
    public function getPeriodoEvaluacion()
    {
        return $this->periodoEvaluacion;
    }

    /**
     * Set gananciaDiaPc
     *
     * @param string $gananciaDiaPc
     *
     * @return BlhSeguimientoReceptor
     */
    public function setGananciaDiaPc($gananciaDiaPc)
    {
        $this->gananciaDiaPc = $gananciaDiaPc;

        return $this;
    }

    /**
     * Get gananciaDiaPc
     *
     * @return string
     */
    public function getGananciaDiaPc()
    {
        return $this->gananciaDiaPc;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhSeguimientoReceptor
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
     * @return BlhSeguimientoReceptor
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
     * Set idReceptor
     *
     * @param \Minsal\SiblhBundle\Entity\BlhReceptor $idReceptor
     *
     * @return BlhSeguimientoReceptor
     */
    public function setIdReceptor(\Minsal\SiblhBundle\Entity\BlhReceptor $idReceptor = null)
    {
        $this->idReceptor = $idReceptor;

        return $this;
    }

    /**
     * Get idReceptor
     *
     * @return \Minsal\SiblhBundle\Entity\BlhReceptor
     */
    public function getIdReceptor()
    {
        return $this->idReceptor;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     *
     * @return BlhSeguimientoReceptor
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