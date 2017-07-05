<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhHistoriaActual
 *
 * @ORM\Table(name="blh_historia_actual", indexes={@ORM\Index(name="fki_blh_his_fk_pat", columns={"patologia"}), @ORM\Index(name="fki_blh_his_fk_hab_tox", columns={"habito_toxico"}), @ORM\Index(name="fki_blh_his_hab", columns={"habito_toxico"}), @ORM\Index(name="IDX_F93902A254F03532", columns={"id_donante"}), @ORM\Index(name="IDX_F93902A2D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class BlhHistoriaActual implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_historia_actual_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="peso_donante", type="decimal", precision=7, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $pesoDonante;

    /**
     * @var string
     *
     * @ORM\Column(name="talla_donante", type="decimal", precision=7, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $tallaDonante;

    /**
     * @var string
     *
     * @ORM\Column(name="medicamento", type="string", length=50, nullable=true)
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
    private $medicamento;

    /**
     * @var string
     *
     * @ORM\Column(name="motivo_donacion", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
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
    private $motivoDonacion;

    /**
     * @var string
     *
     * @ORM\Column(name="imc", type="decimal", precision=7, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $imc;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_donante", type="string", length=12, nullable=false)
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
    private $estadoDonante;

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
     * @var \Minsal\SiapsBundle\Entity\CtlPatologia
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlPatologia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="patologia", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $patologia;

    /**
     * @var \BlhCtlHabitoToxico
     *
     * @ORM\ManyToOne(targetEntity="BlhCtlHabitoToxico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="habito_toxico", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $habitoToxico;

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
        $this->fechaHoraReg = new \DateTime('now');
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->idDonante . ' - ' . $this->estadoDonante;
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
     * Set pesoDonante
     *
     * @param string $pesoDonante
     *
     * @return BlhHistoriaActual
     */
    public function setPesoDonante($pesoDonante)
    {
        $this->pesoDonante = $pesoDonante;

        return $this;
    }

    /**
     * Get pesoDonante
     *
     * @return string
     */
    public function getPesoDonante()
    {
        return $this->pesoDonante;
    }

    /**
     * Set tallaDonante
     *
     * @param string $tallaDonante
     *
     * @return BlhHistoriaActual
     */
    public function setTallaDonante($tallaDonante)
    {
        $this->tallaDonante = $tallaDonante;

        return $this;
    }

    /**
     * Get tallaDonante
     *
     * @return string
     */
    public function getTallaDonante()
    {
        return $this->tallaDonante;
    }

    /**
     * Set medicamento
     *
     * @param string $medicamento
     *
     * @return BlhHistoriaActual
     */
    public function setMedicamento($medicamento)
    {
        $this->medicamento = $medicamento;

        return $this;
    }

    /**
     * Get medicamento
     *
     * @return string
     */
    public function getMedicamento()
    {
        return $this->medicamento;
    }

    /**
     * Set motivoDonacion
     *
     * @param string $motivoDonacion
     *
     * @return BlhHistoriaActual
     */
    public function setMotivoDonacion($motivoDonacion)
    {
        $this->motivoDonacion = $motivoDonacion;

        return $this;
    }

    /**
     * Get motivoDonacion
     *
     * @return string
     */
    public function getMotivoDonacion()
    {
        return $this->motivoDonacion;
    }

    /**
     * Set imc
     *
     * @param string $imc
     *
     * @return BlhHistoriaActual
     */
    public function setImc($imc)
    {
        $this->imc = $imc;

        return $this;
    }

    /**
     * Get imc
     *
     * @return string
     */
    public function getImc()
    {
        return $this->imc;
    }

    /**
     * Set estadoDonante
     *
     * @param string $estadoDonante
     *
     * @return BlhHistoriaActual
     */
    public function setEstadoDonante($estadoDonante)
    {
        $this->estadoDonante = $estadoDonante;

        return $this;
    }

    /**
     * Get estadoDonante
     *
     * @return string
     */
    public function getEstadoDonante()
    {
        return $this->estadoDonante;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhHistoriaActual
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
     * @return BlhHistoriaActual
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
     * @return BlhHistoriaActual
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
     * Set patologia
     *
     * @param \Minsal\SiapsBundle\Entity\CtlPatologia $patologia
     *
     * @return BlhHistoriaActual
     */
    public function setPatologia(\Minsal\SiapsBundle\Entity\CtlPatologia $patologia = null)
    {
        $this->patologia = $patologia;

        return $this;
    }

    /**
     * Get patologia
     *
     * @return \Minsal\SiapsBundle\Entity\CtlPatologia
     */
    public function getPatologia()
    {
        return $this->patologia;
    }

    /**
     * Set habitoToxico
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCtlHabitoToxico $habitoToxico
     *
     * @return BlhHistoriaActual
     */
    public function setHabitoToxico(\Minsal\SiblhBundle\Entity\BlhCtlHabitoToxico $habitoToxico = null)
    {
        $this->habitoToxico = $habitoToxico;

        return $this;
    }

    /**
     * Get habitoToxico
     *
     * @return \Minsal\SiblhBundle\Entity\BlhCtlHabitoToxico
     */
    public function getHabitoToxico()
    {
        return $this->habitoToxico;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     *
     * @return BlhHistoriaActual
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