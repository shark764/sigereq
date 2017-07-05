<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhReceptor
 *
 * @ORM\Table(name="blh_receptor", indexes={@ORM\Index(name="fk_paciente_receptor", columns={"id_paciente"}), @ORM\Index(name="fk_banco_de_leche_receptor", columns={"id_banco_de_leche"}), @ORM\Index(name="IDX_6498D2AD8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class BlhReceptor implements EntityInterface
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
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 14,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $codigoReceptor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro_blh", type="date", nullable=true)
     * @Assert\Date()
     */
    private $fechaRegistroBlh;

    /**
     * @var string
     *
     * @ORM\Column(name="procedencia", type="string", length=20, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 20,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $procedencia;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_receptor", type="string", length=8, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 8,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $estadoReceptor;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_dias", type="integer", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $edadDias;

    /**
     * @var string
     *
     * @ORM\Column(name="peso_receptor", type="decimal", precision=8, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $pesoReceptor;

    /**
     * @var integer
     *
     * @ORM\Column(name="duracion_cpap", type="integer", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $duracionCpap;

    /**
     * @var string
     *
     * @ORM\Column(name="clasificacion_lubchengo", type="string", length=3, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 3,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $clasificacionLubchengo;

    /**
     * @var string
     *
     * @ORM\Column(name="diagnostico_ingreso", type="string", length=50, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 50,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $diagnosticoIngreso;

    /**
     * @var integer
     *
     * @ORM\Column(name="duracion_npt", type="integer", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $duracionNpt;

    /**
     * @var string
     *
     * @ORM\Column(name="apgar_primer_minuto", type="decimal", precision=6, scale=4, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $apgarPrimerMinuto;

    /**
     * @var string
     *
     * @ORM\Column(name="edad_gest_fur", type="decimal", precision=6, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $edadGestFur;

    /**
     * @var integer
     *
     * @ORM\Column(name="duracion_ventilacion", type="integer", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $duracionVentilacion;

    /**
     * @var string
     *
     * @ORM\Column(name="edad_gest_ballard", type="decimal", precision=6, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $edadGestBallard;

    /**
     * @var string
     *
     * @ORM\Column(name="pc", type="decimal", precision=6, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $pc;

    /**
     * @var string
     *
     * @ORM\Column(name="talla_ingreso", type="decimal", precision=7, scale=4, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $tallaIngreso;

    /**
     * @var string
     *
     * @ORM\Column(name="apgar_quinto_minuto", type="decimal", precision=6, scale=4, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $apgarQuintoMinuto;

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
     * @ORM\Column(name="fecha_hora_reg", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaHoraReg;

    /**
     * @var \BlhBancoDeLeche
     *
     * @ORM\ManyToOne(targetEntity="BlhBancoDeLeche")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_banco_de_leche", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idBancoDeLeche;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntPaciente
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntPaciente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_paciente", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idPaciente;

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
        $this->fechaRegistroBlh = new \DateTime('now');
        $this->fechaHoraReg = new \DateTime('now');
    }

    /**
     * ToString
     */
    public function __toString()
    {
        if ($this->idPaciente !== null) {
            return (string) $this->idPaciente . ' - ' . $this->codigoReceptor;
        }
        return (string) $this->codigoReceptor;
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
     * Set codigoReceptor
     *
     * @param string $codigoReceptor
     *
     * @return BlhReceptor
     */
    public function setCodigoReceptor($codigoReceptor)
    {
        $this->codigoReceptor = $codigoReceptor;

        return $this;
    }

    /**
     * Get codigoReceptor
     *
     * @return string
     */
    public function getCodigoReceptor()
    {
        return $this->codigoReceptor;
    }

    /**
     * Set fechaRegistroBlh
     *
     * @param \DateTime $fechaRegistroBlh
     *
     * @return BlhReceptor
     */
    public function setFechaRegistroBlh($fechaRegistroBlh)
    {
        $this->fechaRegistroBlh = $fechaRegistroBlh;

        return $this;
    }

    /**
     * Get fechaRegistroBlh
     *
     * @return \DateTime
     */
    public function getFechaRegistroBlh()
    {
        return $this->fechaRegistroBlh;
    }

    /**
     * Set procedencia
     *
     * @param string $procedencia
     *
     * @return BlhReceptor
     */
    public function setProcedencia($procedencia)
    {
        $this->procedencia = $procedencia;

        return $this;
    }

    /**
     * Get procedencia
     *
     * @return string
     */
    public function getProcedencia()
    {
        return $this->procedencia;
    }

    /**
     * Set estadoReceptor
     *
     * @param string $estadoReceptor
     *
     * @return BlhReceptor
     */
    public function setEstadoReceptor($estadoReceptor)
    {
        $this->estadoReceptor = $estadoReceptor;

        return $this;
    }

    /**
     * Get estadoReceptor
     *
     * @return string
     */
    public function getEstadoReceptor()
    {
        return $this->estadoReceptor;
    }

    /**
     * Set edadDias
     *
     * @param integer $edadDias
     *
     * @return BlhReceptor
     */
    public function setEdadDias($edadDias)
    {
        $this->edadDias = $edadDias;

        return $this;
    }

    /**
     * Get edadDias
     *
     * @return integer
     */
    public function getEdadDias()
    {
        return $this->edadDias;
    }

    /**
     * Set pesoReceptor
     *
     * @param string $pesoReceptor
     *
     * @return BlhReceptor
     */
    public function setPesoReceptor($pesoReceptor)
    {
        $this->pesoReceptor = $pesoReceptor;

        return $this;
    }

    /**
     * Get pesoReceptor
     *
     * @return string
     */
    public function getPesoReceptor()
    {
        return $this->pesoReceptor;
    }

    /**
     * Set duracionCpap
     *
     * @param integer $duracionCpap
     *
     * @return BlhReceptor
     */
    public function setDuracionCpap($duracionCpap)
    {
        $this->duracionCpap = $duracionCpap;

        return $this;
    }

    /**
     * Get duracionCpap
     *
     * @return integer
     */
    public function getDuracionCpap()
    {
        return $this->duracionCpap;
    }

    /**
     * Set clasificacionLubchengo
     *
     * @param string $clasificacionLubchengo
     *
     * @return BlhReceptor
     */
    public function setClasificacionLubchengo($clasificacionLubchengo)
    {
        $this->clasificacionLubchengo = $clasificacionLubchengo;

        return $this;
    }

    /**
     * Get clasificacionLubchengo
     *
     * @return string
     */
    public function getClasificacionLubchengo()
    {
        return $this->clasificacionLubchengo;
    }

    /**
     * Set diagnosticoIngreso
     *
     * @param string $diagnosticoIngreso
     *
     * @return BlhReceptor
     */
    public function setDiagnosticoIngreso($diagnosticoIngreso)
    {
        $this->diagnosticoIngreso = $diagnosticoIngreso;

        return $this;
    }

    /**
     * Get diagnosticoIngreso
     *
     * @return string
     */
    public function getDiagnosticoIngreso()
    {
        return $this->diagnosticoIngreso;
    }

    /**
     * Set duracionNpt
     *
     * @param integer $duracionNpt
     *
     * @return BlhReceptor
     */
    public function setDuracionNpt($duracionNpt)
    {
        $this->duracionNpt = $duracionNpt;

        return $this;
    }

    /**
     * Get duracionNpt
     *
     * @return integer
     */
    public function getDuracionNpt()
    {
        return $this->duracionNpt;
    }

    /**
     * Set apgarPrimerMinuto
     *
     * @param string $apgarPrimerMinuto
     *
     * @return BlhReceptor
     */
    public function setApgarPrimerMinuto($apgarPrimerMinuto)
    {
        $this->apgarPrimerMinuto = $apgarPrimerMinuto;

        return $this;
    }

    /**
     * Get apgarPrimerMinuto
     *
     * @return string
     */
    public function getApgarPrimerMinuto()
    {
        return $this->apgarPrimerMinuto;
    }

    /**
     * Set edadGestFur
     *
     * @param string $edadGestFur
     *
     * @return BlhReceptor
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
     * Set duracionVentilacion
     *
     * @param integer $duracionVentilacion
     *
     * @return BlhReceptor
     */
    public function setDuracionVentilacion($duracionVentilacion)
    {
        $this->duracionVentilacion = $duracionVentilacion;

        return $this;
    }

    /**
     * Get duracionVentilacion
     *
     * @return integer
     */
    public function getDuracionVentilacion()
    {
        return $this->duracionVentilacion;
    }

    /**
     * Set edadGestBallard
     *
     * @param string $edadGestBallard
     *
     * @return BlhReceptor
     */
    public function setEdadGestBallard($edadGestBallard)
    {
        $this->edadGestBallard = $edadGestBallard;

        return $this;
    }

    /**
     * Get edadGestBallard
     *
     * @return string
     */
    public function getEdadGestBallard()
    {
        return $this->edadGestBallard;
    }

    /**
     * Set pc
     *
     * @param string $pc
     *
     * @return BlhReceptor
     */
    public function setPc($pc)
    {
        $this->pc = $pc;

        return $this;
    }

    /**
     * Get pc
     *
     * @return string
     */
    public function getPc()
    {
        return $this->pc;
    }

    /**
     * Set tallaIngreso
     *
     * @param string $tallaIngreso
     *
     * @return BlhReceptor
     */
    public function setTallaIngreso($tallaIngreso)
    {
        $this->tallaIngreso = $tallaIngreso;

        return $this;
    }

    /**
     * Get tallaIngreso
     *
     * @return string
     */
    public function getTallaIngreso()
    {
        return $this->tallaIngreso;
    }

    /**
     * Set apgarQuintoMinuto
     *
     * @param string $apgarQuintoMinuto
     *
     * @return BlhReceptor
     */
    public function setApgarQuintoMinuto($apgarQuintoMinuto)
    {
        $this->apgarQuintoMinuto = $apgarQuintoMinuto;

        return $this;
    }

    /**
     * Get apgarQuintoMinuto
     *
     * @return string
     */
    public function getApgarQuintoMinuto()
    {
        return $this->apgarQuintoMinuto;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhReceptor
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
     * @return BlhReceptor
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
     * Set idBancoDeLeche
     *
     * @param \Minsal\SiblhBundle\Entity\BlhBancoDeLeche $idBancoDeLeche
     *
     * @return BlhReceptor
     */
    public function setIdBancoDeLeche(\Minsal\SiblhBundle\Entity\BlhBancoDeLeche $idBancoDeLeche = null)
    {
        $this->idBancoDeLeche = $idBancoDeLeche;

        return $this;
    }

    /**
     * Get idBancoDeLeche
     *
     * @return \Minsal\SiblhBundle\Entity\BlhBancoDeLeche
     */
    public function getIdBancoDeLeche()
    {
        return $this->idBancoDeLeche;
    }

    /**
     * Set idPaciente
     *
     * @param \Minsal\SiapsBundle\Entity\MntPaciente $idPaciente
     *
     * @return BlhReceptor
     */
    public function setIdPaciente(\Minsal\SiapsBundle\Entity\MntPaciente $idPaciente = null)
    {
        $this->idPaciente = $idPaciente;

        return $this;
    }

    /**
     * Get idPaciente
     *
     * @return \Minsal\SiapsBundle\Entity\MntPaciente
     */
    public function getIdPaciente()
    {
        return $this->idPaciente;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     *
     * @return BlhReceptor
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