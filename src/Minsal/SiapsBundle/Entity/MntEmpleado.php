<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntEmpleado
 *
 * @ORM\Table(name="mnt_empleado", indexes={@ORM\Index(name="IDX_2138DDC94F664059", columns={"id_cargo_empleado"}), @ORM\Index(name="IDX_2138DDC97DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_2138DDC9DA799B26", columns={"id_establecimiento_externo"}), @ORM\Index(name="IDX_2138DDC9B13434FE", columns={"id_tipo_empleado"})})
 * @ORM\Entity
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
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=100, nullable=true)
     */
    private $apellido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=true)
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="dui", type="string", length=12, nullable=true)
     */
    private $dui;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_junta_vigilancia", type="string", length=20, nullable=true)
     */
    private $numeroJuntaVigilancia;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_celular", type="string", length=10, nullable=true)
     */
    private $numeroCelular;

    /**
     * @var string
     *
     * @ORM\Column(name="correo_electronico", type="string", length=50, nullable=true)
     */
    private $correoElectronico;

    /**
     * @var integer
     *
     * @ORM\Column(name="correlativo", type="smallint", nullable=true)
     */
    private $correlativo;

    /**
     * @var string
     *
     * @ORM\Column(name="firma_digital", type="text", nullable=true)
     */
    private $firmaDigital;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_user_reg", type="smallint", nullable=true)
     */
    private $idUserReg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_reg", type="datetime", nullable=true)
     */
    private $fechaHoraReg;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_user_mod", type="smallint", nullable=true)
     */
    private $idUserMod;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_mod", type="datetime", nullable=true)
     */
    private $fechaHoraMod;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_empleado", type="string", length=200, nullable=true)
     */
    private $nombreEmpleado;

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
     */
    private $idNuevoEmpleado;

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
     */
    private $idTipoEmpleado;

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->nombreEmpleado ? ucwords(strtolower($this->nombreEmpleado)) : '';
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
     * Set idUserReg
     *
     * @param integer $idUserReg
     *
     * @return MntEmpleado
     */
    public function setIdUserReg($idUserReg)
    {
        $this->idUserReg = $idUserReg;

        return $this;
    }

    /**
     * Get idUserReg
     *
     * @return integer
     */
    public function getIdUserReg()
    {
        return $this->idUserReg;
    }

    /**
     * Set fechaHoraReg
     *
     * @param \DateTime $fechaHoraReg
     *
     * @return MntEmpleado
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
     * Set idUserMod
     *
     * @param integer $idUserMod
     *
     * @return MntEmpleado
     */
    public function setIdUserMod($idUserMod)
    {
        $this->idUserMod = $idUserMod;

        return $this;
    }

    /**
     * Get idUserMod
     *
     * @return integer
     */
    public function getIdUserMod()
    {
        return $this->idUserMod;
    }

    /**
     * Set fechaHoraMod
     *
     * @param \DateTime $fechaHoraMod
     *
     * @return MntEmpleado
     */
    public function setFechaHoraMod($fechaHoraMod)
    {
        $this->fechaHoraMod = $fechaHoraMod;

        return $this;
    }

    /**
     * Get fechaHoraMod
     *
     * @return \DateTime
     */
    public function getFechaHoraMod()
    {
        return $this->fechaHoraMod;
    }

    /**
     * Set nombreEmpleado
     *
     * @param string $nombreEmpleado
     *
     * @return MntEmpleado
     */
    public function setNombreEmpleado($nombreEmpleado)
    {
        $this->nombreEmpleado = $nombreEmpleado;

        return $this;
    }

    /**
     * Get nombreEmpleado
     *
     * @return string
     */
    public function getNombreEmpleado()
    {
        return $this->nombreEmpleado;
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

}
