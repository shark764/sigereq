<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
// use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * CtlEstablecimiento
 *
 * @ORM\Table(name="ctl_establecimiento", indexes={@ORM\Index(name="IDX_332BD42CEF433A34", columns={"id_institucion"}), @ORM\Index(name="IDX_332BD42C3544B551", columns={"id_establecimiento_padre"}), @ORM\Index(name="IDX_332BD42C7EAD49C7", columns={"id_municipio"}), @ORM\Index(name="IDX_332BD42C4E0E50FD", columns={"id_tipo_establecimiento"})})
 * @ORM\Entity(repositoryClass="Minsal\SiapsBundle\Repository\CtlEstablecimientoRepository")
 */
class CtlEstablecimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_establecimiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=150, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
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
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=250, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 250,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=15, nullable=true)
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
    private $telefono;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_nivel_minsal", type="integer", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $idNivelMinsal;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_ucsf", type="integer", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $codUcsf;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=true)
     */
    private $activo;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_expediente", type="string", length=1, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 1,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $tipoExpediente;

    /**
     * @var boolean
     *
     * @ORM\Column(name="configurado", type="boolean", nullable=true)
     */
    private $configurado;

    /**
     * @var \CtlInstitucion
     *
     * @ORM\ManyToOne(targetEntity="CtlInstitucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_institucion", referencedColumnName="id")
     * })
     */
    private $idInstitucion;

    /**
     * @var \CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento_padre", referencedColumnName="id")
     * })
     */
    private $idEstablecimientoPadre;

    /**
     * @var \CtlMunicipio
     *
     * @ORM\ManyToOne(targetEntity="CtlMunicipio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_municipio", referencedColumnName="id")
     * })
     */
    private $idMunicipio;

    /**
     * @var \CtlTipoEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="CtlTipoEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_establecimiento", referencedColumnName="id")
     * })
     */
    private $idTipoEstablecimiento;

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->nombre ? : '';
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
     * @return CtlEstablecimiento
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
     * Set direccion
     *
     * @param string $direccion
     *
     * @return CtlEstablecimiento
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
     * Set telefono
     *
     * @param string $telefono
     *
     * @return CtlEstablecimiento
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set idNivelMinsal
     *
     * @param integer $idNivelMinsal
     *
     * @return CtlEstablecimiento
     */
    public function setIdNivelMinsal($idNivelMinsal)
    {
        $this->idNivelMinsal = $idNivelMinsal;

        return $this;
    }

    /**
     * Get idNivelMinsal
     *
     * @return integer
     */
    public function getIdNivelMinsal()
    {
        return $this->idNivelMinsal;
    }

    /**
     * Set codUcsf
     *
     * @param integer $codUcsf
     *
     * @return CtlEstablecimiento
     */
    public function setCodUcsf($codUcsf)
    {
        $this->codUcsf = $codUcsf;

        return $this;
    }

    /**
     * Get codUcsf
     *
     * @return integer
     */
    public function getCodUcsf()
    {
        return $this->codUcsf;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return CtlEstablecimiento
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
     * Set tipoExpediente
     *
     * @param string $tipoExpediente
     *
     * @return CtlEstablecimiento
     */
    public function setTipoExpediente($tipoExpediente)
    {
        $this->tipoExpediente = $tipoExpediente;

        return $this;
    }

    /**
     * Get tipoExpediente
     *
     * @return string
     */
    public function getTipoExpediente()
    {
        return $this->tipoExpediente;
    }

    /**
     * Set configurado
     *
     * @param boolean $configurado
     *
     * @return CtlEstablecimiento
     */
    public function setConfigurado($configurado)
    {
        $this->configurado = $configurado;

        return $this;
    }

    /**
     * Get configurado
     *
     * @return boolean
     */
    public function getConfigurado()
    {
        return $this->configurado;
    }

    /**
     * Set idInstitucion
     *
     * @param \Minsal\SiapsBundle\Entity\CtlInstitucion $idInstitucion
     *
     * @return CtlEstablecimiento
     */
    public function setIdInstitucion(\Minsal\SiapsBundle\Entity\CtlInstitucion $idInstitucion = null)
    {
        $this->idInstitucion = $idInstitucion;

        return $this;
    }

    /**
     * Get idInstitucion
     *
     * @return \Minsal\SiapsBundle\Entity\CtlInstitucion
     */
    public function getIdInstitucion()
    {
        return $this->idInstitucion;
    }

    /**
     * Set idEstablecimientoPadre
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoPadre
     *
     * @return CtlEstablecimiento
     */
    public function setIdEstablecimientoPadre(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoPadre = null)
    {
        $this->idEstablecimientoPadre = $idEstablecimientoPadre;

        return $this;
    }

    /**
     * Get idEstablecimientoPadre
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    public function getIdEstablecimientoPadre()
    {
        return $this->idEstablecimientoPadre;
    }

    /**
     * Set idMunicipio
     *
     * @param \Minsal\SiapsBundle\Entity\CtlMunicipio $idMunicipio
     *
     * @return CtlEstablecimiento
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
     * Set idTipoEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlTipoEstablecimiento $idTipoEstablecimiento
     *
     * @return CtlEstablecimiento
     */
    public function setIdTipoEstablecimiento(\Minsal\SiapsBundle\Entity\CtlTipoEstablecimiento $idTipoEstablecimiento = null)
    {
        $this->idTipoEstablecimiento = $idTipoEstablecimiento;

        return $this;
    }

    /**
     * Get idTipoEstablecimiento
     *
     * @return \Minsal\SiapsBundle\Entity\CtlTipoEstablecimiento
     */
    public function getIdTipoEstablecimiento()
    {
        return $this->idTipoEstablecimiento;
    }

}