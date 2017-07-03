<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntEmpleado
 *
 * @ORM\Table(name="mnt_empleado", indexes={@ORM\Index(name="IDX_2138DDC945BCCC8", columns={"idarea"}), @ORM\Index(name="IDX_2138DDC94F664059", columns={"id_cargo_empleado"}), @ORM\Index(name="IDX_2138DDC97DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_2138DDC9DA799B26", columns={"id_establecimiento_externo"}), @ORM\Index(name="IDX_2138DDC9B13434FE", columns={"id_tipo_empleado"})})
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
     * @ORM\Column(name="codigo_farmacia", type="string", length=15, nullable=true)
     */
    private $codigoFarmacia;

    /**
     * @var string
     *
     * @ORM\Column(name="habilitado_farmacia", type="string", length=1, nullable=true)
     */
    private $habilitadoFarmacia = 'H';

    /**
     * @var string
     *
     * @ORM\Column(name="firma_digital", type="text", nullable=true)
     */
    private $firmaDigital;

    /**
     * @var string
     *
     * @ORM\Column(name="idempleado", type="string", length=7, nullable=true)
     */
    private $idempleado = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="idusuarioreg", type="smallint", nullable=true)
     */
    private $idusuarioreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahorareg", type="datetime", nullable=true)
     */
    private $fechahorareg;

    /**
     * @var integer
     *
     * @ORM\Column(name="idusuariomod", type="smallint", nullable=true)
     */
    private $idusuariomod;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahoramod", type="datetime", nullable=true)
     */
    private $fechahoramod;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreempleado", type="string", length=200, nullable=true)
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
     */
    private $idNuevoEmpleado;

    /**
     * @var \CtlAreaServicioDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="CtlAreaServicioDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idarea", referencedColumnName="id")
     * })
     */
    private $idarea;

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
     * Set codigoFarmacia
     *
     * @param string $codigoFarmacia
     *
     * @return MntEmpleado
     */
    public function setCodigoFarmacia($codigoFarmacia)
    {
        $this->codigoFarmacia = $codigoFarmacia;

        return $this;
    }

    /**
     * Get codigoFarmacia
     *
     * @return string
     */
    public function getCodigoFarmacia()
    {
        return $this->codigoFarmacia;
    }

    /**
     * Set habilitadoFarmacia
     *
     * @param string $habilitadoFarmacia
     *
     * @return MntEmpleado
     */
    public function setHabilitadoFarmacia($habilitadoFarmacia)
    {
        $this->habilitadoFarmacia = $habilitadoFarmacia;

        return $this;
    }

    /**
     * Get habilitadoFarmacia
     *
     * @return string
     */
    public function getHabilitadoFarmacia()
    {
        return $this->habilitadoFarmacia;
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
     * Set idempleado
     *
     * @param string $idempleado
     *
     * @return MntEmpleado
     */
    public function setIdempleado($idempleado)
    {
        $this->idempleado = $idempleado;

        return $this;
    }

    /**
     * Get idempleado
     *
     * @return string
     */
    public function getIdempleado()
    {
        return $this->idempleado;
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
     * Set idarea
     *
     * @param \Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico $idarea
     *
     * @return MntEmpleado
     */
    public function setIdarea(\Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico $idarea = null)
    {
        $this->idarea = $idarea;

        return $this;
    }

    /**
     * Get idarea
     *
     * @return \Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico
     */
    public function getIdarea()
    {
        return $this->idarea;
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