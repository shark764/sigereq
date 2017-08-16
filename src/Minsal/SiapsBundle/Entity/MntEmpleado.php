<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
// use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * MntEmpleado
 *
 * @ORM\Table(name="mnt_empleado", indexes={@ORM\Index(name="IDX_2138DDC94F664059", columns={"id_cargo_empleado"}), @ORM\Index(name="IDX_2138DDC97DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_2138DDC9DA799B26", columns={"id_establecimiento_externo"}), @ORM\Index(name="IDX_2138DDC9B13434FE", columns={"id_tipo_empleado"}), @ORM\Index(name="IDX_2138DDC92DF9F9B6", columns={"id_banco_de_leche"}), @ORM\Index(name="IDX_2138DDC98653A7AF", columns={"id_centro_recoleccion"}), @ORM\Index(name="IDX_2138DDC9D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SiapsBundle\Repository\MntEmpleadoRepository")
 */
class MntEmpleado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_empleado_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=true)
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
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=100, nullable=true)
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
    private $apellido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=true)
     * @Assert\Date()
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="dui", type="string", length=12, nullable=true)
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
    private $dui;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_junta_vigilancia", type="string", length=20, nullable=true)
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
    private $numeroJuntaVigilancia;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_celular", type="string", length=10, nullable=true)
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
    private $numeroCelular;

    /**
     * @var string
     *
     * @ORM\Column(name="correo_electronico", type="string", length=50, nullable=true)
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
    private $correoElectronico;

    /**
     * @var integer
     *
     * @ORM\Column(name="correlativo", type="smallint", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 32767,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $correlativo;

    /**
     * @var string
     *
     * @ORM\Column(name="firma_digital", type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $firmaDigital;

    /**
     * @var integer
     *
     * @ORM\Column(name="idusuarioreg", type="smallint", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 32767,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $idusuarioreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahorareg", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechahorareg;

    /**
     * @var integer
     *
     * @ORM\Column(name="idusuariomod", type="smallint", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 32767,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $idusuariomod;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahoramod", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechahoramod;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreempleado", type="string", length=200, nullable=true)
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
    private $nombreempleado;

    /**
     * @var boolean
     *
     * @ORM\Column(name="habilitado", type="boolean", nullable=true)
     */
    private $habilitado = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="residente", type="boolean", nullable=true)
     */
    private $residente = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_nuevo_empleado", type="integer", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $idNuevoEmpleado;

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
     * @var \MntCargoempleados
     *
     * @ORM\ManyToOne(targetEntity="MntCargoempleados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cargo_empleado", referencedColumnName="id")
     * })
     */
    private $idCargoEmpleado;

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
     * @var \CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento_externo", referencedColumnName="id")
     * })
     */
    private $idEstablecimientoExterno;

    /**
     * @var \MntTipoEmpleado
     *
     * @ORM\ManyToOne(targetEntity="MntTipoEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_empleado", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idTipoEmpleado;

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
     * @var \Minsal\SiblhBundle\Entity\BlhCtlCentroRecoleccion
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiblhBundle\Entity\BlhCtlCentroRecoleccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_centro_recoleccion", referencedColumnName="id")
     * })
     */
    private $idCentroRecoleccion;

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
     * @ORM\OneToMany(targetEntity="Application\Sonata\UserBundle\Entity\User", mappedBy="idEmpleado", cascade={"all"}, orphanRemoval=true)
     * @Assert\Count(
     *      min = 0,
     *      max = 1,
     *      minMessage = "Debe poseer al menos {{ limit }} usuario(s)",
     *      maxMessage = "No puede poseer más de {{ limit }} usuario(s)"
     * )
     */
    private $empleadoUsuario;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fechahorareg = new \DateTime('now');
        
        $this->empleadoUsuario = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->nombreempleado ? ucwords(strtolower($this->nombreempleado)) : '';
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return MntEmpleado
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     *
     * @return MntEmpleado
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return MntEmpleado
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
     * Set dui
     *
     * @param string $dui
     *
     * @return MntEmpleado
     */
    public function setDui($dui)
    {
        $this->dui = $dui;

        return $this;
    }

    /**
     * Get dui
     *
     * @return string
     */
    public function getDui()
    {
        return $this->dui;
    }

    /**
     * Set numeroJuntaVigilancia
     *
     * @param string $numeroJuntaVigilancia
     *
     * @return MntEmpleado
     */
    public function setNumeroJuntaVigilancia($numeroJuntaVigilancia)
    {
        $this->numeroJuntaVigilancia = $numeroJuntaVigilancia;

        return $this;
    }

    /**
     * Get numeroJuntaVigilancia
     *
     * @return string
     */
    public function getNumeroJuntaVigilancia()
    {
        return $this->numeroJuntaVigilancia;
    }

    /**
     * Set numeroCelular
     *
     * @param string $numeroCelular
     *
     * @return MntEmpleado
     */
    public function setNumeroCelular($numeroCelular)
    {
        $this->numeroCelular = $numeroCelular;

        return $this;
    }

    /**
     * Get numeroCelular
     *
     * @return string
     */
    public function getNumeroCelular()
    {
        return $this->numeroCelular;
    }

    /**
     * Set correoElectronico
     *
     * @param string $correoElectronico
     *
     * @return MntEmpleado
     */
    public function setCorreoElectronico($correoElectronico)
    {
        $this->correoElectronico = $correoElectronico;

        return $this;
    }

    /**
     * Get correoElectronico
     *
     * @return string
     */
    public function getCorreoElectronico()
    {
        return $this->correoElectronico;
    }

    /**
     * Set correlativo
     *
     * @param integer $correlativo
     *
     * @return MntEmpleado
     */
    public function setCorrelativo($correlativo)
    {
        $this->correlativo = $correlativo;

        return $this;
    }

    /**
     * Get correlativo
     *
     * @return integer
     */
    public function getCorrelativo()
    {
        return $this->correlativo;
    }

    /**
     * Set firmaDigital
     *
     * @param string $firmaDigital
     *
     * @return MntEmpleado
     */
    public function setFirmaDigital($firmaDigital)
    {
        $this->firmaDigital = $firmaDigital;

        return $this;
    }

    /**
     * Get firmaDigital
     *
     * @return string
     */
    public function getFirmaDigital()
    {
        return $this->firmaDigital;
    }

    /**
     * Set idusuarioreg
     *
     * @param integer $idusuarioreg
     *
     * @return MntEmpleado
     */
    public function setIdusuarioreg($idusuarioreg)
    {
        $this->idusuarioreg = $idusuarioreg;

        return $this;
    }

    /**
     * Get idusuarioreg
     *
     * @return integer
     */
    public function getIdusuarioreg()
    {
        return $this->idusuarioreg;
    }

    /**
     * Set fechahorareg
     *
     * @param \DateTime $fechahorareg
     *
     * @return MntEmpleado
     */
    public function setFechahorareg($fechahorareg)
    {
        $this->fechahorareg = $fechahorareg;

        return $this;
    }

    /**
     * Get fechahorareg
     *
     * @return \DateTime
     */
    public function getFechahorareg()
    {
        return $this->fechahorareg;
    }

    /**
     * Set idusuariomod
     *
     * @param integer $idusuariomod
     *
     * @return MntEmpleado
     */
    public function setIdusuariomod($idusuariomod)
    {
        $this->idusuariomod = $idusuariomod;

        return $this;
    }

    /**
     * Get idusuariomod
     *
     * @return integer
     */
    public function getIdusuariomod()
    {
        return $this->idusuariomod;
    }

    /**
     * Set fechahoramod
     *
     * @param \DateTime $fechahoramod
     *
     * @return MntEmpleado
     */
    public function setFechahoramod($fechahoramod)
    {
        $this->fechahoramod = $fechahoramod;

        return $this;
    }

    /**
     * Get fechahoramod
     *
     * @return \DateTime
     */
    public function getFechahoramod()
    {
        return $this->fechahoramod;
    }

    /**
     * Set nombreempleado
     *
     * @param string $nombreempleado
     *
     * @return MntEmpleado
     */
    public function setNombreempleado($nombreempleado)
    {
        $this->nombreempleado = $nombreempleado;

        return $this;
    }

    /**
     * Get nombreempleado
     *
     * @return string
     */
    public function getNombreempleado()
    {
        return $this->nombreempleado;
    }

    /**
     * Set habilitado
     *
     * @param boolean $habilitado
     *
     * @return MntEmpleado
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
     * Set residente
     *
     * @param boolean $residente
     *
     * @return MntEmpleado
     */
    public function setResidente($residente)
    {
        $this->residente = $residente;

        return $this;
    }

    /**
     * Get residente
     *
     * @return boolean
     */
    public function getResidente()
    {
        return $this->residente;
    }

    /**
     * Set idNuevoEmpleado
     *
     * @param integer $idNuevoEmpleado
     *
     * @return MntEmpleado
     */
    public function setIdNuevoEmpleado($idNuevoEmpleado)
    {
        $this->idNuevoEmpleado = $idNuevoEmpleado;

        return $this;
    }

    /**
     * Get idNuevoEmpleado
     *
     * @return integer
     */
    public function getIdNuevoEmpleado()
    {
        return $this->idNuevoEmpleado;
    }

    /**
     * Set idRegistroSiap
     *
     * @param integer $idRegistroSiap
     *
     * @return MntEmpleado
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
     * Set idCargoEmpleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntCargoempleados $idCargoEmpleado
     *
     * @return MntEmpleado
     */
    public function setIdCargoEmpleado(\Minsal\SiapsBundle\Entity\MntCargoempleados $idCargoEmpleado = null)
    {
        $this->idCargoEmpleado = $idCargoEmpleado;

        return $this;
    }

    /**
     * Get idCargoEmpleado
     *
     * @return \Minsal\SiapsBundle\Entity\MntCargoempleados
     */
    public function getIdCargoEmpleado()
    {
        return $this->idCargoEmpleado;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     *
     * @return MntEmpleado
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
     * Set idEstablecimientoExterno
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoExterno
     *
     * @return MntEmpleado
     */
    public function setIdEstablecimientoExterno(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoExterno = null)
    {
        $this->idEstablecimientoExterno = $idEstablecimientoExterno;

        return $this;
    }

    /**
     * Get idEstablecimientoExterno
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    public function getIdEstablecimientoExterno()
    {
        return $this->idEstablecimientoExterno;
    }

    /**
     * Set idTipoEmpleado
     *
     * @param \Minsal\SiapsBundle\Entity\MntTipoEmpleado $idTipoEmpleado
     *
     * @return MntEmpleado
     */
    public function setIdTipoEmpleado(\Minsal\SiapsBundle\Entity\MntTipoEmpleado $idTipoEmpleado = null)
    {
        $this->idTipoEmpleado = $idTipoEmpleado;

        return $this;
    }

    /**
     * Get idTipoEmpleado
     *
     * @return \Minsal\SiapsBundle\Entity\MntTipoEmpleado
     */
    public function getIdTipoEmpleado()
    {
        return $this->idTipoEmpleado;
    }

    /**
     * Set idBancoDeLeche
     *
     * @param \Minsal\SiblhBundle\Entity\BlhBancoDeLeche $idBancoDeLeche
     *
     * @return MntEmpleado
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
     * Set idCentroRecoleccion
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCtlCentroRecoleccion $idCentroRecoleccion
     *
     * @return MntEmpleado
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
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     *
     * @return MntEmpleado
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
     * Add empleadoUsuario
     *
     * @param \Application\Sonata\UserBundle\Entity\User $empleadoUsuario
     *
     * @return MntEmpleado
     */
    public function addEmpleadoUsuario(\Application\Sonata\UserBundle\Entity\User $empleadoUsuario)
    {
        $this->empleadoUsuario[] = $empleadoUsuario;

        return $this;
    }

    /**
     * Remove empleadoUsuario
     *
     * @param \Application\Sonata\UserBundle\Entity\User $empleadoUsuario
     */
    public function removeEmpleadoUsuario(\Application\Sonata\UserBundle\Entity\User $empleadoUsuario)
    {
        $this->empleadoUsuario->removeElement($empleadoUsuario);
    }

    /**
     * Get empleadoUsuario
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmpleadoUsuario()
    {
        return $this->empleadoUsuario;
    }

}