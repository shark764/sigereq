<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhDonante
 *
 * @ORM\Table(name="blh_donante", indexes={@ORM\Index(name="fk_municipio_donante", columns={"id_municipio"}), @ORM\Index(name="fki_blh_dona_fk_nacionalidad_blh", columns={"nacionalidad"}), @ORM\Index(name="fk_banco_de_leche_donante", columns={"id_banco_de_leche"}), @ORM\Index(name="fki_blh_dona_fk_naciona_blh", columns={"nacionalidad"}), @ORM\Index(name="IDX_D458FB01D8A5832B", columns={"id_user_reg"}), @ORM\Index(name="IDX_D458FB0110281A9F", columns={"id_escolaridad"}), @ORM\Index(name="IDX_D458FB0185E56563", columns={"id_tipo_colecta"}), @ORM\Index(name="IDX_D458FB01D7E358F6", columns={"id_estado_civil"}), @ORM\Index(name="IDX_D458FB018C587E61", columns={"id_ocupacion"}), @ORM\Index(name="IDX_D458FB01AF36C2D7", columns={"id_doc_ide_donante"}), @ORM\Index(name="IDX_D458FB018653A7AF", columns={"id_centro_recoleccion"}), @ORM\Index(name="IDX_D458FB01701624C4", columns={"id_expediente"})})
 * @ORM\Entity
 */
class BlhDonante implements EntityInterface
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
     * @Assert\NotBlank(message = "foreign.default.not_blank")
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
    private $codigoDonante;

    /**
     * @var string
     *
     * @ORM\Column(name="primer_nombre", type="string", length=15, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 15,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $primerNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="segundo_nombre", type="string", length=15, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 15,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $segundoNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="primer_apellido", type="string", length=15, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 15,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $primerApellido;

    /**
     * @var string
     *
     * @ORM\Column(name="segundo_apellido", type="string", length=15, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 15,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $segundoApellido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Date()
     */
    private $fechaNacimiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro_donante_blh", type="date", nullable=true)
     * @Assert\Date()
     */
    private $fechaRegistroDonanteBlh;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_fijo", type="string", length=9, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 9,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $telefonoFijo;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_movil", type="string", length=9, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 9,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $telefonoMovil;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=100, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 100,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $direccion;

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
     * @ORM\Column(name="registro", type="string", length=12, nullable=true)
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
    private $registro;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_documento_identificacion", type="string", length=10, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 10,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $numeroDocumentoIdentificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="documento_identificacion", type="string", length=20, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
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
    private $documentoIdentificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad", type="integer", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $edad;

    /**
     * @var string
     *
     * @ORM\Column(name="ocupacion", type="string", length=15, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 15,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $ocupacion;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_civil", type="string", length=10, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 10,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $estadoCivil;

    /**
     * @var string
     *
     * @ORM\Column(name="escolaridad", type="string", length=15, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 15,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $escolaridad;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_colecta", type="string", length=10, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 10,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $tipoColecta;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=150, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 150,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=8, nullable=true)
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
    private $estado;

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
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=true)
     */
    private $activo = false;

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
     * @var \Minsal\SiapsBundle\Entity\CtlMunicipio
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlMunicipio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_municipio", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idMunicipio;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlNacionalidad
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlNacionalidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nacionalidad", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $nacionalidad;

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
     * @var \BlhCtlEscolaridad
     *
     * @ORM\ManyToOne(targetEntity="BlhCtlEscolaridad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_escolaridad", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idEscolaridad;

    /**
     * @var \BlhCtlTipoColecta
     *
     * @ORM\ManyToOne(targetEntity="BlhCtlTipoColecta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_colecta", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idTipoColecta;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstadoCivil
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstadoCivil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_civil", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idEstadoCivil;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlOcupacion
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlOcupacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ocupacion", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idOcupacion;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlDocumentoIdentidad
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlDocumentoIdentidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_doc_ide_donante", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idDoceDonante;

    /**
     * @var \BlhCtlCentroRecoleccion
     *
     * @ORM\ManyToOne(targetEntity="BlhCtlCentroRecoleccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_centro_recoleccion", referencedColumnName="id")
     * })
     */
    private $idCentroRecoleccion;

    /**
     * @var \Minsal\SiapsBundle\Entity\MntExpediente
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntExpediente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_expediente", referencedColumnName="id")
     * })
     */
    private $idExpediente;

    /**
     * @ORM\OneToMany(targetEntity="BlhDonacion", mappedBy="idDonante", cascade={"all"}, orphanRemoval=true)
     */
    private $donanteDonaciones;

    /**
     * @ORM\OneToMany(targetEntity="BlhReceptor", mappedBy="idMadreDonante", cascade={"all"}, orphanRemoval=true)
     */
    private $madreDonanteReceptor;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fechaRegistroDonanteBlh = new \DateTime('now');
        $this->fechaNacimiento = new \DateTime('now');
        $this->fechaHoraReg = new \DateTime('now');
        
        $this->donanteDonaciones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->madreDonanteReceptor = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return ucfirst(strtolower($this->primerApellido)) . ' ' . ucfirst(strtolower($this->segundoApellido)) . ', ' . ucfirst(strtolower($this->primerNombre)) . ' ' . ucfirst(strtolower($this->segundoNombre)) ? : '';
    }

    public function getNombrePaciente()
    {
        return ucfirst(strtolower($this->primerNombre)) . ' ' . ucfirst(strtolower($this->segundoNombre)) . ' ' . ucfirst(strtolower($this->primerApellido)) . ' ' . ucfirst(strtolower($this->segundoApellido)) ? : '';
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
     * Set codigoDonante
     *
     * @param string $codigoDonante
     *
     * @return BlhDonante
     */
    public function setCodigoDonante($codigoDonante)
    {
        $this->codigoDonante = $codigoDonante;

        return $this;
    }

    /**
     * Get codigoDonante
     *
     * @return string
     */
    public function getCodigoDonante()
    {
        return $this->codigoDonante;
    }

    /**
     * Set primerNombre
     *
     * @param string $primerNombre
     *
     * @return BlhDonante
     */
    public function setPrimerNombre($primerNombre)
    {
        $this->primerNombre = $primerNombre;

        return $this;
    }

    /**
     * Get primerNombre
     *
     * @return string
     */
    public function getPrimerNombre()
    {
        return $this->primerNombre;
    }

    /**
     * Set segundoNombre
     *
     * @param string $segundoNombre
     *
     * @return BlhDonante
     */
    public function setSegundoNombre($segundoNombre)
    {
        $this->segundoNombre = $segundoNombre;

        return $this;
    }

    /**
     * Get segundoNombre
     *
     * @return string
     */
    public function getSegundoNombre()
    {
        return $this->segundoNombre;
    }

    /**
     * Set primerApellido
     *
     * @param string $primerApellido
     *
     * @return BlhDonante
     */
    public function setPrimerApellido($primerApellido)
    {
        $this->primerApellido = $primerApellido;

        return $this;
    }

    /**
     * Get primerApellido
     *
     * @return string
     */
    public function getPrimerApellido()
    {
        return $this->primerApellido;
    }

    /**
     * Set segundoApellido
     *
     * @param string $segundoApellido
     *
     * @return BlhDonante
     */
    public function setSegundoApellido($segundoApellido)
    {
        $this->segundoApellido = $segundoApellido;

        return $this;
    }

    /**
     * Get segundoApellido
     *
     * @return string
     */
    public function getSegundoApellido()
    {
        return $this->segundoApellido;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return BlhDonante
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set fechaRegistroDonanteBlh
     *
     * @param \DateTime $fechaRegistroDonanteBlh
     *
     * @return BlhDonante
     */
    public function setFechaRegistroDonanteBlh($fechaRegistroDonanteBlh)
    {
        $this->fechaRegistroDonanteBlh = $fechaRegistroDonanteBlh;

        return $this;
    }

    /**
     * Get fechaRegistroDonanteBlh
     *
     * @return \DateTime
     */
    public function getFechaRegistroDonanteBlh()
    {
        return $this->fechaRegistroDonanteBlh;
    }

    /**
     * Set telefonoFijo
     *
     * @param string $telefonoFijo
     *
     * @return BlhDonante
     */
    public function setTelefonoFijo($telefonoFijo)
    {
        $this->telefonoFijo = $telefonoFijo;

        return $this;
    }

    /**
     * Get telefonoFijo
     *
     * @return string
     */
    public function getTelefonoFijo()
    {
        return $this->telefonoFijo;
    }

    /**
     * Set telefonoMovil
     *
     * @param string $telefonoMovil
     *
     * @return BlhDonante
     */
    public function setTelefonoMovil($telefonoMovil)
    {
        $this->telefonoMovil = $telefonoMovil;

        return $this;
    }

    /**
     * Get telefonoMovil
     *
     * @return string
     */
    public function getTelefonoMovil()
    {
        return $this->telefonoMovil;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return BlhDonante
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set procedencia
     *
     * @param string $procedencia
     *
     * @return BlhDonante
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
     * Set registro
     *
     * @param string $registro
     *
     * @return BlhDonante
     */
    public function setRegistro($registro)
    {
        $this->registro = $registro;

        return $this;
    }

    /**
     * Get registro
     *
     * @return string
     */
    public function getRegistro()
    {
        return $this->registro;
    }

    /**
     * Set numeroDocumentoIdentificacion
     *
     * @param string $numeroDocumentoIdentificacion
     *
     * @return BlhDonante
     */
    public function setNumeroDocumentoIdentificacion($numeroDocumentoIdentificacion)
    {
        $this->numeroDocumentoIdentificacion = $numeroDocumentoIdentificacion;

        return $this;
    }

    /**
     * Get numeroDocumentoIdentificacion
     *
     * @return string
     */
    public function getNumeroDocumentoIdentificacion()
    {
        return $this->numeroDocumentoIdentificacion;
    }

    /**
     * Set documentoIdentificacion
     *
     * @param string $documentoIdentificacion
     *
     * @return BlhDonante
     */
    public function setDocumentoIdentificacion($documentoIdentificacion)
    {
        $this->documentoIdentificacion = $documentoIdentificacion;

        return $this;
    }

    /**
     * Get documentoIdentificacion
     *
     * @return string
     */
    public function getDocumentoIdentificacion()
    {
        return $this->documentoIdentificacion;
    }

    /**
     * Set edad
     *
     * @param integer $edad
     *
     * @return BlhDonante
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;

        return $this;
    }

    /**
     * Get edad
     *
     * @return integer
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Set ocupacion
     *
     * @param string $ocupacion
     *
     * @return BlhDonante
     */
    public function setOcupacion($ocupacion)
    {
        $this->ocupacion = $ocupacion;

        return $this;
    }

    /**
     * Get ocupacion
     *
     * @return string
     */
    public function getOcupacion()
    {
        return $this->ocupacion;
    }

    /**
     * Set estadoCivil
     *
     * @param string $estadoCivil
     *
     * @return BlhDonante
     */
    public function setEstadoCivil($estadoCivil)
    {
        $this->estadoCivil = $estadoCivil;

        return $this;
    }

    /**
     * Get estadoCivil
     *
     * @return string
     */
    public function getEstadoCivil()
    {
        return $this->estadoCivil;
    }

    /**
     * Set escolaridad
     *
     * @param string $escolaridad
     *
     * @return BlhDonante
     */
    public function setEscolaridad($escolaridad)
    {
        $this->escolaridad = $escolaridad;

        return $this;
    }

    /**
     * Get escolaridad
     *
     * @return string
     */
    public function getEscolaridad()
    {
        return $this->escolaridad;
    }

    /**
     * Set tipoColecta
     *
     * @param string $tipoColecta
     *
     * @return BlhDonante
     */
    public function setTipoColecta($tipoColecta)
    {
        $this->tipoColecta = $tipoColecta;

        return $this;
    }

    /**
     * Get tipoColecta
     *
     * @return string
     */
    public function getTipoColecta()
    {
        return $this->tipoColecta;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return BlhDonante
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return BlhDonante
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhDonante
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
     * @return BlhDonante
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
     * Set activo
     *
     * @param boolean $activo
     * @return BlhDonante
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set idBancoDeLeche
     *
     * @param \Minsal\SiblhBundle\Entity\BlhBancoDeLeche $idBancoDeLeche
     *
     * @return BlhDonante
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
     * Set idMunicipio
     *
     * @param \Minsal\SiapsBundle\Entity\CtlMunicipio $idMunicipio
     *
     * @return BlhDonante
     */
    public function setIdMunicipio(\Minsal\SiapsBundle\Entity\CtlMunicipio $idMunicipio = null)
    {
        $this->idMunicipio = $idMunicipio;

        return $this;
    }

    /**
     * Get idMunicipio
     *
     * @return \Minsal\SiapsBundle\Entity\CtlMunicipio
     */
    public function getIdMunicipio()
    {
        return $this->idMunicipio;
    }

    /**
     * Set nacionalidad
     *
     * @param \Minsal\SiapsBundle\Entity\CtlNacionalidad $nacionalidad
     *
     * @return BlhDonante
     */
    public function setNacionalidad(\Minsal\SiapsBundle\Entity\CtlNacionalidad $nacionalidad = null)
    {
        $this->nacionalidad = $nacionalidad;

        return $this;
    }

    /**
     * Get nacionalidad
     *
     * @return \Minsal\SiapsBundle\Entity\CtlNacionalidad
     */
    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     *
     * @return BlhDonante
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

    /**
     * Set idEscolaridad
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCtlEscolaridad $idEscolaridad
     *
     * @return BlhDonante
     */
    public function setIdEscolaridad(\Minsal\SiblhBundle\Entity\BlhCtlEscolaridad $idEscolaridad = null)
    {
        $this->idEscolaridad = $idEscolaridad;

        return $this;
    }

    /**
     * Get idEscolaridad
     *
     * @return \Minsal\SiblhBundle\Entity\BlhCtlEscolaridad
     */
    public function getIdEscolaridad()
    {
        return $this->idEscolaridad;
    }

    /**
     * Set idTipoColecta
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCtlTipoColecta $idTipoColecta
     *
     * @return BlhDonante
     */
    public function setIdTipoColecta(\Minsal\SiblhBundle\Entity\BlhCtlTipoColecta $idTipoColecta = null)
    {
        $this->idTipoColecta = $idTipoColecta;

        return $this;
    }

    /**
     * Get idTipoColecta
     *
     * @return \Minsal\SiblhBundle\Entity\BlhCtlTipoColecta
     */
    public function getIdTipoColecta()
    {
        return $this->idTipoColecta;
    }

    /**
     * Set idEstadoCivil
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstadoCivil $idEstadoCivil
     *
     * @return BlhDonante
     */
    public function setIdEstadoCivil(\Minsal\SiapsBundle\Entity\CtlEstadoCivil $idEstadoCivil = null)
    {
        $this->idEstadoCivil = $idEstadoCivil;

        return $this;
    }

    /**
     * Get idEstadoCivil
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstadoCivil
     */
    public function getIdEstadoCivil()
    {
        return $this->idEstadoCivil;
    }

    /**
     * Set idOcupacion
     *
     * @param \Minsal\SiapsBundle\Entity\CtlOcupacion $idOcupacion
     *
     * @return BlhDonante
     */
    public function setIdOcupacion(\Minsal\SiapsBundle\Entity\CtlOcupacion $idOcupacion = null)
    {
        $this->idOcupacion = $idOcupacion;

        return $this;
    }

    /**
     * Get idOcupacion
     *
     * @return \Minsal\SiapsBundle\Entity\CtlOcupacion
     */
    public function getIdOcupacion()
    {
        return $this->idOcupacion;
    }

    /**
     * Set idDoceDonante
     *
     * @param \Minsal\SiapsBundle\Entity\CtlDocumentoIdentidad $idDoceDonante
     *
     * @return BlhDonante
     */
    public function setIdDoceDonante(\Minsal\SiapsBundle\Entity\CtlDocumentoIdentidad $idDoceDonante = null)
    {
        $this->idDoceDonante = $idDoceDonante;

        return $this;
    }

    /**
     * Get idDoceDonante
     *
     * @return \Minsal\SiapsBundle\Entity\CtlDocumentoIdentidad
     */
    public function getIdDoceDonante()
    {
        return $this->idDoceDonante;
    }

    /**
     * Set idCentroRecoleccion
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCtlCentroRecoleccion $idCentroRecoleccion
     *
     * @return BlhDonante
     */
    public function setIdCentroRecoleccion(\Minsal\SiblhBundle\Entity\BlhCtlCentroRecoleccion $idCentroRecoleccion = null)
    {
        $this->idCentroRecoleccion = $idCentroRecoleccion;

        return $this;
    }

    /**
     * Get idCentroRecoleccion
     *
     * @return \Minsal\SiblhBundle\Entity\BlhCtlCentroRecoleccion
     */
    public function getIdCentroRecoleccion()
    {
        return $this->idCentroRecoleccion;
    }

    /**
     * Add donanteDonacione
     *
     * @param \Minsal\SiblhBundle\Entity\BlhDonacion $donanteDonacione
     *
     * @return BlhDonante
     */
    public function addDonanteDonacione(\Minsal\SiblhBundle\Entity\BlhDonacion $donanteDonacione)
    {
        $this->donanteDonaciones[] = $donanteDonacione;

        return $this;
    }

    /**
     * Remove donanteDonacione
     *
     * @param \Minsal\SiblhBundle\Entity\BlhDonacion $donanteDonacione
     */
    public function removeDonanteDonacione(\Minsal\SiblhBundle\Entity\BlhDonacion $donanteDonacione)
    {
        $this->donanteDonaciones->removeElement($donanteDonacione);
    }

    /**
     * Get donanteDonaciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDonanteDonaciones()
    {
        return $this->donanteDonaciones;
    }

    /**
     * Set idExpediente
     *
     * @param \Minsal\SiapsBundle\Entity\MntExpediente $idExpediente
     *
     * @return BlhDonante
     */
    public function setIdExpediente(\Minsal\SiapsBundle\Entity\MntExpediente $idExpediente = null)
    {
        $this->idExpediente = $idExpediente;

        return $this;
    }

    /**
     * Get idExpediente
     *
     * @return \Minsal\SiapsBundle\Entity\MntExpediente
     */
    public function getIdExpediente()
    {
        return $this->idExpediente;
    }

}
