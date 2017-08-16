<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
// use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * MntExpediente
 *
 * @ORM\Table(name="mnt_expediente", uniqueConstraints={@ORM\UniqueConstraint(name="idx_id_id_paciente", columns={"id", "id_paciente"}), @ORM\UniqueConstraint(name="idx_numero_expediente", columns={"numero"})}, indexes={@ORM\Index(name="IDX_E4950F577DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_E4950F57961045CB", columns={"id_paciente"}), @ORM\Index(name="IDX_E4950F572DF9F9B6", columns={"id_banco_de_leche"})})
 * @ORM\Entity(repositoryClass="Minsal\SiapsBundle\Repository\MntExpedienteRepository")
 */
class MntExpediente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_expediente_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=12, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 12,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $numero;

    /**
     * @var boolean
     *
     * @ORM\Column(name="habilitado", type="boolean", nullable=false)
     */
    private $habilitado = true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="date", nullable=true)
     * @Assert\Date()
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_creacion", type="time", nullable=true)
     * @Assert\Time()
     */
    private $horaCreacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="numero_temporal", type="boolean", nullable=true)
     */
    private $numeroTemporal = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="expediente_fisico_eliminado", type="boolean", nullable=true)
     */
    private $expedienteFisicoEliminado = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cun", type="boolean", nullable=true)
     */
    private $cun = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_registro_siap", type="bigint", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 9223372036854775807,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $idRegistroSiap;

    /**
     * @var \CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idEstablecimiento;

    /**
     * @var \MntPaciente
     *
     * @ORM\ManyToOne(targetEntity="MntPaciente", inversedBy="expedientes", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_paciente", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idPaciente;

    /**
     * @var \Minsal\SiblhBundle\Entity\BlhBancoDeLeche
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiblhBundle\Entity\BlhBancoDeLeche")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_banco_de_leche", referencedColumnName="id")
     * })
     */
    private $idBancoDeLeche;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fechaCreacion = new \DateTime('now');
        $this->horaCreacion = new \DateTime('now');
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->numero ? : '';
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
     * Set numero
     *
     * @param string $numero
     *
     * @return MntExpediente
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set habilitado
     *
     * @param boolean $habilitado
     *
     * @return MntExpediente
     */
    public function setHabilitado($habilitado)
    {
        $this->habilitado = $habilitado;

        return $this;
    }

    /**
     * Get habilitado
     *
     * @return boolean
     */
    public function getHabilitado()
    {
        return $this->habilitado;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return MntExpediente
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set horaCreacion
     *
     * @param \DateTime $horaCreacion
     *
     * @return MntExpediente
     */
    public function setHoraCreacion($horaCreacion)
    {
        $this->horaCreacion = $horaCreacion;

        return $this;
    }

    /**
     * Get horaCreacion
     *
     * @return \DateTime
     */
    public function getHoraCreacion()
    {
        return $this->horaCreacion;
    }

    /**
     * Set numeroTemporal
     *
     * @param boolean $numeroTemporal
     *
     * @return MntExpediente
     */
    public function setNumeroTemporal($numeroTemporal)
    {
        $this->numeroTemporal = $numeroTemporal;

        return $this;
    }

    /**
     * Get numeroTemporal
     *
     * @return boolean
     */
    public function getNumeroTemporal()
    {
        return $this->numeroTemporal;
    }

    /**
     * Set expedienteFisicoEliminado
     *
     * @param boolean $expedienteFisicoEliminado
     *
     * @return MntExpediente
     */
    public function setExpedienteFisicoEliminado($expedienteFisicoEliminado)
    {
        $this->expedienteFisicoEliminado = $expedienteFisicoEliminado;

        return $this;
    }

    /**
     * Get expedienteFisicoEliminado
     *
     * @return boolean
     */
    public function getExpedienteFisicoEliminado()
    {
        return $this->expedienteFisicoEliminado;
    }

    /**
     * Set cun
     *
     * @param boolean $cun
     *
     * @return MntExpediente
     */
    public function setCun($cun)
    {
        $this->cun = $cun;

        return $this;
    }

    /**
     * Get cun
     *
     * @return boolean
     */
    public function getCun()
    {
        return $this->cun;
    }

    /**
     * Set idRegistroSiap
     *
     * @param integer $idRegistroSiap
     *
     * @return MntExpediente
     */
    public function setIdRegistroSiap($idRegistroSiap)
    {
        $this->idRegistroSiap = $idRegistroSiap;

        return $this;
    }

    /**
     * Get idRegistroSiap
     *
     * @return integer
     */
    public function getIdRegistroSiap()
    {
        return $this->idRegistroSiap;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     *
     * @return MntExpediente
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
     * Set idPaciente
     *
     * @param \Minsal\SiapsBundle\Entity\MntPaciente $idPaciente
     *
     * @return MntExpediente
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
     * Set idBancoDeLeche
     *
     * @param \Minsal\SiblhBundle\Entity\BlhBancoDeLeche $idBancoDeLeche
     *
     * @return MntExpediente
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

}