<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
// use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * MntPaciente
 *
 * @ORM\Table(name="mnt_paciente", indexes={@ORM\Index(name="IDX_3E2ACBC5220BCD31", columns={"id_area_cotizacion"}), @ORM\Index(name="IDX_3E2ACBC57F1FADD6", columns={"area_geografica_domicilio"}), @ORM\Index(name="IDX_3E2ACBC5B490DCBC", columns={"id_canton_domicilio"}), @ORM\Index(name="IDX_3E2ACBC59CC1698E", columns={"id_condicion_persona"}), @ORM\Index(name="IDX_3E2ACBC5F4BEBFC8", columns={"id_departamento_domicilio"}), @ORM\Index(name="IDX_3E2ACBC5BB55CDF5", columns={"id_departamento_nacimiento"}), @ORM\Index(name="IDX_3E2ACBC5468B95CB", columns={"id_doc_ide_paciente"}), @ORM\Index(name="IDX_3E2ACBC5558DDFB5", columns={"id_doc_ide_proporciono_datos"}), @ORM\Index(name="IDX_3E2ACBC5ACA54FF3", columns={"id_doc_ide_responsable"}), @ORM\Index(name="IDX_3E2ACBC5D7E358F6", columns={"id_estado_civil"}), @ORM\Index(name="IDX_3E2ACBC5B3457663", columns={"id_municipio_domicilio"}), @ORM\Index(name="IDX_3E2ACBC5FA164C5C", columns={"id_municipio_nacimiento"}), @ORM\Index(name="IDX_3E2ACBC5B0DC2AB1", columns={"id_nacionalidad"}), @ORM\Index(name="IDX_3E2ACBC58C587E61", columns={"id_ocupacion"}), @ORM\Index(name="IDX_3E2ACBC5242CF91E", columns={"id_pais_nacimiento"}), @ORM\Index(name="IDX_3E2ACBC526DA8252", columns={"id_parentesco_propor_datos"}), @ORM\Index(name="IDX_3E2ACBC5FC412399", columns={"id_parentesco_responsable"}), @ORM\Index(name="IDX_3E2ACBC5A7194A90", columns={"id_sexo"}), @ORM\Index(name="IDX_3E2ACBC56B3CA4B", columns={"id_user"}), @ORM\Index(name="IDX_3E2ACBC5AC39DE56", columns={"id_user_mod"})})
 * @ORM\Entity(repositoryClass="Minsal\SiapsBundle\Repository\MntPacienteRepository")
 */
class MntPaciente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_paciente_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="primer_nombre", type="string", length=25, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 25,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $primerNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="segundo_nombre", type="string", length=25, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 25,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $segundoNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="tercer_nombre", type="string", length=25, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 25,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $tercerNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="primer_apellido", type="string", length=25, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 25,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $primerApellido;

    /**
     * @var string
     *
     * @ORM\Column(name="segundo_apellido", type="string", length=25, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 25,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $segundoApellido;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_casada", type="string", length=25, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 25,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $apellidoCasada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=true)
     * @Assert\Date()
     */
    private $fechaNacimiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_nacimiento", type="time", nullable=true)
     * @Assert\Time()
     */
    private $horaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_doc_ide_paciente", type="string", length=20, nullable=true)
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
    private $numeroDocIdePaciente;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=200, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 200,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_casa", type="string", length=10, nullable=true)
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
    private $telefonoCasa;

    /**
     * @var string
     *
     * @ORM\Column(name="lugar_trabajo", type="string", length=50, nullable=true)
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
    private $lugarTrabajo;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_trabajo", type="string", length=10, nullable=true)
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
    private $telefonoTrabajo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="asegurado", type="boolean", nullable=true)
     */
    private $asegurado;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_afiliacion", type="string", length=12, nullable=true)
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
    private $numeroAfiliacion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_padre", type="string", length=80, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 80,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $nombrePadre;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_madre", type="string", length=80, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 80,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $nombreMadre;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_conyuge", type="string", length=80, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 80,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $nombreConyuge;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_responsable", type="string", length=80, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 80,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $nombreResponsable;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion_responsable", type="string", length=200, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 200,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $direccionResponsable;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_responsable", type="string", length=10, nullable=true)
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
    private $telefonoResponsable;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_doc_ide_responsable", type="string", length=20, nullable=true)
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
    private $numeroDocIdeResponsable;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_proporciono_datos", type="string", length=80, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 80,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $nombreProporcionoDatos;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_doc_ide_propor_datos", type="string", length=20, nullable=true)
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
    private $numeroDocIdeProporDatos;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $observacion;

    /**
     * @var string
     *
     * @ORM\Column(name="conocido_por", type="string", length=70, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 70,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $conocidoPor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaRegistro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_mod", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaMod;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cotizante", type="boolean", nullable=true)
     */
    private $cotizante;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_completo_fonetico", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $nombreCompletoFonetico;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_completo_fonetico", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $apellidoCompletoFonetico;

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
     * @var \CtlAreaCotizante
     *
     * @ORM\ManyToOne(targetEntity="CtlAreaCotizante")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_cotizacion", referencedColumnName="id")
     * })
     */
    private $idAreaCotizacion;

    /**
     * @var \CtlAreaGeografica
     *
     * @ORM\ManyToOne(targetEntity="CtlAreaGeografica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="area_geografica_domicilio", referencedColumnName="id")
     * })
     */
    private $areaGeograficaDomicilio;

    /**
     * @var \CtlCanton
     *
     * @ORM\ManyToOne(targetEntity="CtlCanton")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_canton_domicilio", referencedColumnName="id")
     * })
     */
    private $idCantonDomicilio;

    /**
     * @var \CtlCondicionPersona
     *
     * @ORM\ManyToOne(targetEntity="CtlCondicionPersona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_condicion_persona", referencedColumnName="id")
     * })
     */
    private $idCondicionPersona;

    /**
     * @var \CtlDepartamento
     *
     * @ORM\ManyToOne(targetEntity="CtlDepartamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_departamento_domicilio", referencedColumnName="id")
     * })
     */
    private $idDepartamentoDomicilio;

    /**
     * @var \CtlDepartamento
     *
     * @ORM\ManyToOne(targetEntity="CtlDepartamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_departamento_nacimiento", referencedColumnName="id")
     * })
     */
    private $idDepartamentoNacimiento;

    /**
     * @var \CtlDocumentoIdentidad
     *
     * @ORM\ManyToOne(targetEntity="CtlDocumentoIdentidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_doc_ide_paciente", referencedColumnName="id")
     * })
     */
    private $idDocePaciente;

    /**
     * @var \CtlDocumentoIdentidad
     *
     * @ORM\ManyToOne(targetEntity="CtlDocumentoIdentidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_doc_ide_proporciono_datos", referencedColumnName="id")
     * })
     */
    private $idDoceProporcionoDatos;

    /**
     * @var \CtlDocumentoIdentidad
     *
     * @ORM\ManyToOne(targetEntity="CtlDocumentoIdentidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_doc_ide_responsable", referencedColumnName="id")
     * })
     */
    private $idDoceResponsable;

    /**
     * @var \CtlEstadoCivil
     *
     * @ORM\ManyToOne(targetEntity="CtlEstadoCivil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_civil", referencedColumnName="id")
     * })
     */
    private $idEstadoCivil;

    /**
     * @var \CtlMunicipio
     *
     * @ORM\ManyToOne(targetEntity="CtlMunicipio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_municipio_domicilio", referencedColumnName="id")
     * })
     */
    private $idMunicipioDomicilio;

    /**
     * @var \CtlMunicipio
     *
     * @ORM\ManyToOne(targetEntity="CtlMunicipio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_municipio_nacimiento", referencedColumnName="id")
     * })
     */
    private $idMunicipioNacimiento;

    /**
     * @var \CtlNacionalidad
     *
     * @ORM\ManyToOne(targetEntity="CtlNacionalidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_nacionalidad", referencedColumnName="id")
     * })
     */
    private $idNacionalidad;

    /**
     * @var \CtlOcupacion
     *
     * @ORM\ManyToOne(targetEntity="CtlOcupacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ocupacion", referencedColumnName="id")
     * })
     */
    private $idOcupacion;

    /**
     * @var \CtlPais
     *
     * @ORM\ManyToOne(targetEntity="CtlPais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pais_nacimiento", referencedColumnName="id")
     * })
     */
    private $idPaisNacimiento;

    /**
     * @var \CtlParentesco
     *
     * @ORM\ManyToOne(targetEntity="CtlParentesco")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parentesco_propor_datos", referencedColumnName="id")
     * })
     */
    private $idParentescoProporDatos;

    /**
     * @var \CtlParentesco
     *
     * @ORM\ManyToOne(targetEntity="CtlParentesco")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parentesco_responsable", referencedColumnName="id")
     * })
     */
    private $idParentescoResponsable;

    /**
     * @var \CtlSexo
     *
     * @ORM\ManyToOne(targetEntity="CtlSexo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sexo", referencedColumnName="id")
     * })
     */
    private $idSexo;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_mod", referencedColumnName="id")
     * })
     */
    private $idUserMod;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="MntExpediente", mappedBy="idPaciente", cascade={"all"}, orphanRemoval=true)
     * @Assert\Count(
     *      min = 1,
     *      max = 1,
     *      minMessage = "Debe poseer al menos {{ limit }} expediente(s)",
     *      maxMessage = "No puede poseer más de {{ limit }} expediente(s)"
     * )
     */
    private $expedientes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fechaNacimiento = new \DateTime('now');
        $this->horaNacimiento = new \DateTime('now');
        $this->fechaRegistro = new \DateTime('now');
        $this->expedientes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->estado = true;
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->primerApellido . ($this->segundoApellido ? ' ' . $this->segundoApellido : '') . ($this->apellidoCasada ? ' ' . $this->apellidoCasada : '' ) . ', ' . $this->primerNombre . ($this->segundoNombre ? ' ' . $this->segundoNombre : '') ? : '';
    }

    public function getNombrePaciente()
    {
        return ucfirst(strtolower($this->primerNombre)) . ' ' . ucfirst(strtolower($this->segundoNombre)) . ' ' . ucfirst(strtolower($this->primerApellido)) . ' ' . ucfirst(strtolower($this->segundoApellido)) . ' ' . ucfirst(strtolower($this->apellidoCasada)) ? : '';
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
     * Set primerNombre
     *
     * @param string $primerNombre
     *
     * @return MntPaciente
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
     * @return MntPaciente
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
     * Set tercerNombre
     *
     * @param string $tercerNombre
     *
     * @return MntPaciente
     */
    public function setTercerNombre($tercerNombre)
    {
        $this->tercerNombre = $tercerNombre;

        return $this;
    }

    /**
     * Get tercerNombre
     *
     * @return string
     */
    public function getTercerNombre()
    {
        return $this->tercerNombre;
    }

    /**
     * Set primerApellido
     *
     * @param string $primerApellido
     *
     * @return MntPaciente
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
     * @return MntPaciente
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
     * Set apellidoCasada
     *
     * @param string $apellidoCasada
     *
     * @return MntPaciente
     */
    public function setApellidoCasada($apellidoCasada)
    {
        $this->apellidoCasada = $apellidoCasada;

        return $this;
    }

    /**
     * Get apellidoCasada
     *
     * @return string
     */
    public function getApellidoCasada()
    {
        return $this->apellidoCasada;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return MntPaciente
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
     * Set horaNacimiento
     *
     * @param \DateTime $horaNacimiento
     *
     * @return MntPaciente
     */
    public function setHoraNacimiento($horaNacimiento)
    {
        $this->horaNacimiento = $horaNacimiento;

        return $this;
    }

    /**
     * Get horaNacimiento
     *
     * @return \DateTime
     */
    public function getHoraNacimiento()
    {
        return $this->horaNacimiento;
    }

    /**
     * Set numeroDocIdePaciente
     *
     * @param string $numeroDocIdePaciente
     *
     * @return MntPaciente
     */
    public function setNumeroDocIdePaciente($numeroDocIdePaciente)
    {
        $this->numeroDocIdePaciente = $numeroDocIdePaciente;

        return $this;
    }

    /**
     * Get numeroDocIdePaciente
     *
     * @return string
     */
    public function getNumeroDocIdePaciente()
    {
        return $this->numeroDocIdePaciente;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return MntPaciente
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
     * Set telefonoCasa
     *
     * @param string $telefonoCasa
     *
     * @return MntPaciente
     */
    public function setTelefonoCasa($telefonoCasa)
    {
        $this->telefonoCasa = $telefonoCasa;

        return $this;
    }

    /**
     * Get telefonoCasa
     *
     * @return string
     */
    public function getTelefonoCasa()
    {
        return $this->telefonoCasa;
    }

    /**
     * Set lugarTrabajo
     *
     * @param string $lugarTrabajo
     *
     * @return MntPaciente
     */
    public function setLugarTrabajo($lugarTrabajo)
    {
        $this->lugarTrabajo = $lugarTrabajo;

        return $this;
    }

    /**
     * Get lugarTrabajo
     *
     * @return string
     */
    public function getLugarTrabajo()
    {
        return $this->lugarTrabajo;
    }

    /**
     * Set telefonoTrabajo
     *
     * @param string $telefonoTrabajo
     *
     * @return MntPaciente
     */
    public function setTelefonoTrabajo($telefonoTrabajo)
    {
        $this->telefonoTrabajo = $telefonoTrabajo;

        return $this;
    }

    /**
     * Get telefonoTrabajo
     *
     * @return string
     */
    public function getTelefonoTrabajo()
    {
        return $this->telefonoTrabajo;
    }

    /**
     * Set asegurado
     *
     * @param boolean $asegurado
     *
     * @return MntPaciente
     */
    public function setAsegurado($asegurado)
    {
        $this->asegurado = $asegurado;

        return $this;
    }

    /**
     * Get asegurado
     *
     * @return boolean
     */
    public function getAsegurado()
    {
        return $this->asegurado;
    }

    /**
     * Set numeroAfiliacion
     *
     * @param string $numeroAfiliacion
     *
     * @return MntPaciente
     */
    public function setNumeroAfiliacion($numeroAfiliacion)
    {
        $this->numeroAfiliacion = $numeroAfiliacion;

        return $this;
    }

    /**
     * Get numeroAfiliacion
     *
     * @return string
     */
    public function getNumeroAfiliacion()
    {
        return $this->numeroAfiliacion;
    }

    /**
     * Set nombrePadre
     *
     * @param string $nombrePadre
     *
     * @return MntPaciente
     */
    public function setNombrePadre($nombrePadre)
    {
        $this->nombrePadre = $nombrePadre;

        return $this;
    }

    /**
     * Get nombrePadre
     *
     * @return string
     */
    public function getNombrePadre()
    {
        return $this->nombrePadre;
    }

    /**
     * Set nombreMadre
     *
     * @param string $nombreMadre
     *
     * @return MntPaciente
     */
    public function setNombreMadre($nombreMadre)
    {
        $this->nombreMadre = $nombreMadre;

        return $this;
    }

    /**
     * Get nombreMadre
     *
     * @return string
     */
    public function getNombreMadre()
    {
        return $this->nombreMadre;
    }

    /**
     * Set nombreConyuge
     *
     * @param string $nombreConyuge
     *
     * @return MntPaciente
     */
    public function setNombreConyuge($nombreConyuge)
    {
        $this->nombreConyuge = $nombreConyuge;

        return $this;
    }

    /**
     * Get nombreConyuge
     *
     * @return string
     */
    public function getNombreConyuge()
    {
        return $this->nombreConyuge;
    }

    /**
     * Set nombreResponsable
     *
     * @param string $nombreResponsable
     *
     * @return MntPaciente
     */
    public function setNombreResponsable($nombreResponsable)
    {
        $this->nombreResponsable = $nombreResponsable;

        return $this;
    }

    /**
     * Get nombreResponsable
     *
     * @return string
     */
    public function getNombreResponsable()
    {
        return $this->nombreResponsable;
    }

    /**
     * Set direccionResponsable
     *
     * @param string $direccionResponsable
     *
     * @return MntPaciente
     */
    public function setDireccionResponsable($direccionResponsable)
    {
        $this->direccionResponsable = $direccionResponsable;

        return $this;
    }

    /**
     * Get direccionResponsable
     *
     * @return string
     */
    public function getDireccionResponsable()
    {
        return $this->direccionResponsable;
    }

    /**
     * Set telefonoResponsable
     *
     * @param string $telefonoResponsable
     *
     * @return MntPaciente
     */
    public function setTelefonoResponsable($telefonoResponsable)
    {
        $this->telefonoResponsable = $telefonoResponsable;

        return $this;
    }

    /**
     * Get telefonoResponsable
     *
     * @return string
     */
    public function getTelefonoResponsable()
    {
        return $this->telefonoResponsable;
    }

    /**
     * Set numeroDocIdeResponsable
     *
     * @param string $numeroDocIdeResponsable
     *
     * @return MntPaciente
     */
    public function setNumeroDocIdeResponsable($numeroDocIdeResponsable)
    {
        $this->numeroDocIdeResponsable = $numeroDocIdeResponsable;

        return $this;
    }

    /**
     * Get numeroDocIdeResponsable
     *
     * @return string
     */
    public function getNumeroDocIdeResponsable()
    {
        return $this->numeroDocIdeResponsable;
    }

    /**
     * Set nombreProporcionoDatos
     *
     * @param string $nombreProporcionoDatos
     *
     * @return MntPaciente
     */
    public function setNombreProporcionoDatos($nombreProporcionoDatos)
    {
        $this->nombreProporcionoDatos = $nombreProporcionoDatos;

        return $this;
    }

    /**
     * Get nombreProporcionoDatos
     *
     * @return string
     */
    public function getNombreProporcionoDatos()
    {
        return $this->nombreProporcionoDatos;
    }

    /**
     * Set numeroDocIdeProporDatos
     *
     * @param string $numeroDocIdeProporDatos
     *
     * @return MntPaciente
     */
    public function setNumeroDocIdeProporDatos($numeroDocIdeProporDatos)
    {
        $this->numeroDocIdeProporDatos = $numeroDocIdeProporDatos;

        return $this;
    }

    /**
     * Get numeroDocIdeProporDatos
     *
     * @return string
     */
    public function getNumeroDocIdeProporDatos()
    {
        return $this->numeroDocIdeProporDatos;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     *
     * @return MntPaciente
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
     * Set conocidoPor
     *
     * @param string $conocidoPor
     *
     * @return MntPaciente
     */
    public function setConocidoPor($conocidoPor)
    {
        $this->conocidoPor = $conocidoPor;

        return $this;
    }

    /**
     * Get conocidoPor
     *
     * @return string
     */
    public function getConocidoPor()
    {
        return $this->conocidoPor;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return MntPaciente
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set fechaMod
     *
     * @param \DateTime $fechaMod
     *
     * @return MntPaciente
     */
    public function setFechaMod($fechaMod)
    {
        $this->fechaMod = $fechaMod;

        return $this;
    }

    /**
     * Get fechaMod
     *
     * @return \DateTime
     */
    public function getFechaMod()
    {
        return $this->fechaMod;
    }

    /**
     * Set cotizante
     *
     * @param boolean $cotizante
     *
     * @return MntPaciente
     */
    public function setCotizante($cotizante)
    {
        $this->cotizante = $cotizante;

        return $this;
    }

    /**
     * Get cotizante
     *
     * @return boolean
     */
    public function getCotizante()
    {
        return $this->cotizante;
    }

    /**
     * Set nombreCompletoFonetico
     *
     * @param string $nombreCompletoFonetico
     *
     * @return MntPaciente
     */
    public function setNombreCompletoFonetico($nombreCompletoFonetico)
    {
        $this->nombreCompletoFonetico = $nombreCompletoFonetico;

        return $this;
    }

    /**
     * Get nombreCompletoFonetico
     *
     * @return string
     */
    public function getNombreCompletoFonetico()
    {
        return $this->nombreCompletoFonetico;
    }

    /**
     * Set apellidoCompletoFonetico
     *
     * @param string $apellidoCompletoFonetico
     *
     * @return MntPaciente
     */
    public function setApellidoCompletoFonetico($apellidoCompletoFonetico)
    {
        $this->apellidoCompletoFonetico = $apellidoCompletoFonetico;

        return $this;
    }

    /**
     * Get apellidoCompletoFonetico
     *
     * @return string
     */
    public function getApellidoCompletoFonetico()
    {
        return $this->apellidoCompletoFonetico;
    }

    /**
     * Set idRegistroSiap
     *
     * @param integer $idRegistroSiap
     *
     * @return MntPaciente
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
     * Set idAreaCotizacion
     *
     * @param \Minsal\SiapsBundle\Entity\CtlAreaCotizante $idAreaCotizacion
     *
     * @return MntPaciente
     */
    public function setIdAreaCotizacion(\Minsal\SiapsBundle\Entity\CtlAreaCotizante $idAreaCotizacion = null)
    {
        $this->idAreaCotizacion = $idAreaCotizacion;

        return $this;
    }

    /**
     * Get idAreaCotizacion
     *
     * @return \Minsal\SiapsBundle\Entity\CtlAreaCotizante
     */
    public function getIdAreaCotizacion()
    {
        return $this->idAreaCotizacion;
    }

    /**
     * Set areaGeograficaDomicilio
     *
     * @param \Minsal\SiapsBundle\Entity\CtlAreaGeografica $areaGeograficaDomicilio
     *
     * @return MntPaciente
     */
    public function setAreaGeograficaDomicilio(\Minsal\SiapsBundle\Entity\CtlAreaGeografica $areaGeograficaDomicilio = null)
    {
        $this->areaGeograficaDomicilio = $areaGeograficaDomicilio;

        return $this;
    }

    /**
     * Get areaGeograficaDomicilio
     *
     * @return \Minsal\SiapsBundle\Entity\CtlAreaGeografica
     */
    public function getAreaGeograficaDomicilio()
    {
        return $this->areaGeograficaDomicilio;
    }

    /**
     * Set idCantonDomicilio
     *
     * @param \Minsal\SiapsBundle\Entity\CtlCanton $idCantonDomicilio
     *
     * @return MntPaciente
     */
    public function setIdCantonDomicilio(\Minsal\SiapsBundle\Entity\CtlCanton $idCantonDomicilio = null)
    {
        $this->idCantonDomicilio = $idCantonDomicilio;

        return $this;
    }

    /**
     * Get idCantonDomicilio
     *
     * @return \Minsal\SiapsBundle\Entity\CtlCanton
     */
    public function getIdCantonDomicilio()
    {
        return $this->idCantonDomicilio;
    }

    /**
     * Set idCondicionPersona
     *
     * @param \Minsal\SiapsBundle\Entity\CtlCondicionPersona $idCondicionPersona
     *
     * @return MntPaciente
     */
    public function setIdCondicionPersona(\Minsal\SiapsBundle\Entity\CtlCondicionPersona $idCondicionPersona = null)
    {
        $this->idCondicionPersona = $idCondicionPersona;

        return $this;
    }

    /**
     * Get idCondicionPersona
     *
     * @return \Minsal\SiapsBundle\Entity\CtlCondicionPersona
     */
    public function getIdCondicionPersona()
    {
        return $this->idCondicionPersona;
    }

    /**
     * Set idDepartamentoDomicilio
     *
     * @param \Minsal\SiapsBundle\Entity\CtlDepartamento $idDepartamentoDomicilio
     *
     * @return MntPaciente
     */
    public function setIdDepartamentoDomicilio(\Minsal\SiapsBundle\Entity\CtlDepartamento $idDepartamentoDomicilio = null)
    {
        $this->idDepartamentoDomicilio = $idDepartamentoDomicilio;

        return $this;
    }

    /**
     * Get idDepartamentoDomicilio
     *
     * @return \Minsal\SiapsBundle\Entity\CtlDepartamento
     */
    public function getIdDepartamentoDomicilio()
    {
        return $this->idDepartamentoDomicilio;
    }

    /**
     * Set idDepartamentoNacimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlDepartamento $idDepartamentoNacimiento
     *
     * @return MntPaciente
     */
    public function setIdDepartamentoNacimiento(\Minsal\SiapsBundle\Entity\CtlDepartamento $idDepartamentoNacimiento = null)
    {
        $this->idDepartamentoNacimiento = $idDepartamentoNacimiento;

        return $this;
    }

    /**
     * Get idDepartamentoNacimiento
     *
     * @return \Minsal\SiapsBundle\Entity\CtlDepartamento
     */
    public function getIdDepartamentoNacimiento()
    {
        return $this->idDepartamentoNacimiento;
    }

    /**
     * Set idDocePaciente
     *
     * @param \Minsal\SiapsBundle\Entity\CtlDocumentoIdentidad $idDocePaciente
     *
     * @return MntPaciente
     */
    public function setIdDocePaciente(\Minsal\SiapsBundle\Entity\CtlDocumentoIdentidad $idDocePaciente = null)
    {
        $this->idDocePaciente = $idDocePaciente;

        return $this;
    }

    /**
     * Get idDocePaciente
     *
     * @return \Minsal\SiapsBundle\Entity\CtlDocumentoIdentidad
     */
    public function getIdDocePaciente()
    {
        return $this->idDocePaciente;
    }

    /**
     * Set idDoceProporcionoDatos
     *
     * @param \Minsal\SiapsBundle\Entity\CtlDocumentoIdentidad $idDoceProporcionoDatos
     *
     * @return MntPaciente
     */
    public function setIdDoceProporcionoDatos(\Minsal\SiapsBundle\Entity\CtlDocumentoIdentidad $idDoceProporcionoDatos = null)
    {
        $this->idDoceProporcionoDatos = $idDoceProporcionoDatos;

        return $this;
    }

    /**
     * Get idDoceProporcionoDatos
     *
     * @return \Minsal\SiapsBundle\Entity\CtlDocumentoIdentidad
     */
    public function getIdDoceProporcionoDatos()
    {
        return $this->idDoceProporcionoDatos;
    }

    /**
     * Set idDoceResponsable
     *
     * @param \Minsal\SiapsBundle\Entity\CtlDocumentoIdentidad $idDoceResponsable
     *
     * @return MntPaciente
     */
    public function setIdDoceResponsable(\Minsal\SiapsBundle\Entity\CtlDocumentoIdentidad $idDoceResponsable = null)
    {
        $this->idDoceResponsable = $idDoceResponsable;

        return $this;
    }

    /**
     * Get idDoceResponsable
     *
     * @return \Minsal\SiapsBundle\Entity\CtlDocumentoIdentidad
     */
    public function getIdDoceResponsable()
    {
        return $this->idDoceResponsable;
    }

    /**
     * Set idEstadoCivil
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstadoCivil $idEstadoCivil
     *
     * @return MntPaciente
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
     * Set idMunicipioDomicilio
     *
     * @param \Minsal\SiapsBundle\Entity\CtlMunicipio $idMunicipioDomicilio
     *
     * @return MntPaciente
     */
    public function setIdMunicipioDomicilio(\Minsal\SiapsBundle\Entity\CtlMunicipio $idMunicipioDomicilio = null)
    {
        $this->idMunicipioDomicilio = $idMunicipioDomicilio;

        return $this;
    }

    /**
     * Get idMunicipioDomicilio
     *
     * @return \Minsal\SiapsBundle\Entity\CtlMunicipio
     */
    public function getIdMunicipioDomicilio()
    {
        return $this->idMunicipioDomicilio;
    }

    /**
     * Set idMunicipioNacimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlMunicipio $idMunicipioNacimiento
     *
     * @return MntPaciente
     */
    public function setIdMunicipioNacimiento(\Minsal\SiapsBundle\Entity\CtlMunicipio $idMunicipioNacimiento = null)
    {
        $this->idMunicipioNacimiento = $idMunicipioNacimiento;

        return $this;
    }

    /**
     * Get idMunicipioNacimiento
     *
     * @return \Minsal\SiapsBundle\Entity\CtlMunicipio
     */
    public function getIdMunicipioNacimiento()
    {
        return $this->idMunicipioNacimiento;
    }

    /**
     * Set idNacionalidad
     *
     * @param \Minsal\SiapsBundle\Entity\CtlNacionalidad $idNacionalidad
     *
     * @return MntPaciente
     */
    public function setIdNacionalidad(\Minsal\SiapsBundle\Entity\CtlNacionalidad $idNacionalidad = null)
    {
        $this->idNacionalidad = $idNacionalidad;

        return $this;
    }

    /**
     * Get idNacionalidad
     *
     * @return \Minsal\SiapsBundle\Entity\CtlNacionalidad
     */
    public function getIdNacionalidad()
    {
        return $this->idNacionalidad;
    }

    /**
     * Set idOcupacion
     *
     * @param \Minsal\SiapsBundle\Entity\CtlOcupacion $idOcupacion
     *
     * @return MntPaciente
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
     * Set idPaisNacimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlPais $idPaisNacimiento
     *
     * @return MntPaciente
     */
    public function setIdPaisNacimiento(\Minsal\SiapsBundle\Entity\CtlPais $idPaisNacimiento = null)
    {
        $this->idPaisNacimiento = $idPaisNacimiento;

        return $this;
    }

    /**
     * Get idPaisNacimiento
     *
     * @return \Minsal\SiapsBundle\Entity\CtlPais
     */
    public function getIdPaisNacimiento()
    {
        return $this->idPaisNacimiento;
    }

    /**
     * Set idParentescoProporDatos
     *
     * @param \Minsal\SiapsBundle\Entity\CtlParentesco $idParentescoProporDatos
     *
     * @return MntPaciente
     */
    public function setIdParentescoProporDatos(\Minsal\SiapsBundle\Entity\CtlParentesco $idParentescoProporDatos = null)
    {
        $this->idParentescoProporDatos = $idParentescoProporDatos;

        return $this;
    }

    /**
     * Get idParentescoProporDatos
     *
     * @return \Minsal\SiapsBundle\Entity\CtlParentesco
     */
    public function getIdParentescoProporDatos()
    {
        return $this->idParentescoProporDatos;
    }

    /**
     * Set idParentescoResponsable
     *
     * @param \Minsal\SiapsBundle\Entity\CtlParentesco $idParentescoResponsable
     *
     * @return MntPaciente
     */
    public function setIdParentescoResponsable(\Minsal\SiapsBundle\Entity\CtlParentesco $idParentescoResponsable = null)
    {
        $this->idParentescoResponsable = $idParentescoResponsable;

        return $this;
    }

    /**
     * Get idParentescoResponsable
     *
     * @return \Minsal\SiapsBundle\Entity\CtlParentesco
     */
    public function getIdParentescoResponsable()
    {
        return $this->idParentescoResponsable;
    }

    /**
     * Set idSexo
     *
     * @param \Minsal\SiapsBundle\Entity\CtlSexo $idSexo
     *
     * @return MntPaciente
     */
    public function setIdSexo(\Minsal\SiapsBundle\Entity\CtlSexo $idSexo = null)
    {
        $this->idSexo = $idSexo;

        return $this;
    }

    /**
     * Get idSexo
     *
     * @return \Minsal\SiapsBundle\Entity\CtlSexo
     */
    public function getIdSexo()
    {
        return $this->idSexo;
    }

    /**
     * Set idUser
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUser
     *
     * @return MntPaciente
     */
    public function setIdUser(\Application\Sonata\UserBundle\Entity\User $idUser = null)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idUserMod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserMod
     *
     * @return MntPaciente
     */
    public function setIdUserMod(\Application\Sonata\UserBundle\Entity\User $idUserMod = null)
    {
        $this->idUserMod = $idUserMod;

        return $this;
    }

    /**
     * Get idUserMod
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getIdUserMod()
    {
        return $this->idUserMod;
    }

    /**
     * Add expediente
     *
     * @param \Minsal\SiapsBundle\Entity\MntExpediente $expediente
     *
     * @return MntPaciente
     */
    public function addExpediente(\Minsal\SiapsBundle\Entity\MntExpediente $expediente)
    {
        $this->expedientes[] = $expediente;

        return $this;
    }

    /**
     * Remove expediente
     *
     * @param \Minsal\SiapsBundle\Entity\MntExpediente $expediente
     */
    public function removeExpediente(\Minsal\SiapsBundle\Entity\MntExpediente $expediente)
    {
        $this->expedientes->removeElement($expediente);
    }

    /**
     * Get expedientes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExpedientes()
    {
        return $this->expedientes;
    }

}
