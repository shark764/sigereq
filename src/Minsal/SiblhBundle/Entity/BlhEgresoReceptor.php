<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhEgresoReceptor
 *
 * @ORM\Table(name="blh_egreso_receptor", indexes={@ORM\Index(name="fk_receptor_egreso_receptor", columns={"id_receptor"}), @ORM\Index(name="IDX_7993CDC67DFA12F6", columns={"id_establecimiento"}), @ORM\Index(name="IDX_7993CDC6D8A5832B", columns={"id_user_reg"}), @ORM\Index(name="IDX_7993CDC6D8A5832B", columns={"id_tipo_egreso"}), @ORM\Index(name="IDX_7993CDC6D8A5832B", columns={"id_banco_de_leche"})})
 * @ORM\Entity(repositoryClass="Minsal\SiblhBundle\Repository\BlhEgresoReceptorRepository")
 */
class BlhEgresoReceptor implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_egreso_receptor_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="diagnostico_egreso", type="string", length=50, nullable=false)
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
    private $diagnosticoEgreso;

    /**
     * @var string
     *
     * @ORM\Column(name="madre_canguro", type="string", length=2, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 2,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $madreCanguro;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_egreso", type="string", length=6, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 6,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $tipoEgreso;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario_egreso", type="string", length=150, nullable=true)
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
    private $comentarioEgreso;

    /**
     * @var string
     *
     * @ORM\Column(name="traslado_periferico", type="string", length=2, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 2,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $trasladoPeriferico;

    /**
     * @var integer
     *
     * @ORM\Column(name="permanencia_ucin", type="integer", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $permanenciaUcin;

    /**
     * @var string
     *
     * @ORM\Column(name="hospital_seguimiento_egreso", type="string", length=80, nullable=true)
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
    private $hospitalSeguimientoEgreso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_egreso", type="date", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Date()
     */
    private $fechaEgreso;

    /**
     * @var integer
     *
     * @ORM\Column(name="estancia_hospitalaria", type="integer", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $estanciaHospitalaria;

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
     * @var integer
     *
     * @ORM\Column(name="dias_permanencia", type="integer", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $diasPermanencia;

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
     * @ORM\Column(name="metodo_madre_canguro", type="boolean", nullable=true)
     */
    private $metodoMadreCanguro = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="trasladar_periferico", type="boolean", nullable=true)
     */
    private $trasladarPeriferico = false;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idEstablecimiento;

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
     * @var \BlhCtlTipoEgreso
     *
     * @ORM\ManyToOne(targetEntity="BlhCtlTipoEgreso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_egreso", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idTipoEgreso;

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
     * Constructor
     */
    public function __construct()
    {
        $this->fechaEgreso = new \DateTime('now');
        $this->fechaHoraReg = new \DateTime('now');
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->idReceptor . ' - ' . $this->diasPermanencia;
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
     * Set diagnosticoEgreso
     *
     * @param string $diagnosticoEgreso
     *
     * @return BlhEgresoReceptor
     */
    public function setDiagnosticoEgreso($diagnosticoEgreso)
    {
        $this->diagnosticoEgreso = $diagnosticoEgreso;

        return $this;
    }

    /**
     * Get diagnosticoEgreso
     *
     * @return string
     */
    public function getDiagnosticoEgreso()
    {
        return $this->diagnosticoEgreso;
    }

    /**
     * Set madreCanguro
     *
     * @param string $madreCanguro
     *
     * @return BlhEgresoReceptor
     */
    public function setMadreCanguro($madreCanguro)
    {
        $this->madreCanguro = $madreCanguro;

        return $this;
    }

    /**
     * Get madreCanguro
     *
     * @return string
     */
    public function getMadreCanguro()
    {
        return $this->madreCanguro;
    }

    /**
     * Set tipoEgreso
     *
     * @param string $tipoEgreso
     *
     * @return BlhEgresoReceptor
     */
    public function setTipoEgreso($tipoEgreso)
    {
        $this->tipoEgreso = $tipoEgreso;

        return $this;
    }

    /**
     * Get tipoEgreso
     *
     * @return string
     */
    public function getTipoEgreso()
    {
        return $this->tipoEgreso;
    }

    /**
     * Set comentarioEgreso
     *
     * @param string $comentarioEgreso
     *
     * @return BlhEgresoReceptor
     */
    public function setComentarioEgreso($comentarioEgreso)
    {
        $this->comentarioEgreso = $comentarioEgreso;

        return $this;
    }

    /**
     * Get comentarioEgreso
     *
     * @return string
     */
    public function getComentarioEgreso()
    {
        return $this->comentarioEgreso;
    }

    /**
     * Set trasladoPeriferico
     *
     * @param string $trasladoPeriferico
     *
     * @return BlhEgresoReceptor
     */
    public function setTrasladoPeriferico($trasladoPeriferico)
    {
        $this->trasladoPeriferico = $trasladoPeriferico;

        return $this;
    }

    /**
     * Get trasladoPeriferico
     *
     * @return string
     */
    public function getTrasladoPeriferico()
    {
        return $this->trasladoPeriferico;
    }

    /**
     * Set permanenciaUcin
     *
     * @param integer $permanenciaUcin
     *
     * @return BlhEgresoReceptor
     */
    public function setPermanenciaUcin($permanenciaUcin)
    {
        $this->permanenciaUcin = $permanenciaUcin;

        return $this;
    }

    /**
     * Get permanenciaUcin
     *
     * @return integer
     */
    public function getPermanenciaUcin()
    {
        return $this->permanenciaUcin;
    }

    /**
     * Set hospitalSeguimientoEgreso
     *
     * @param string $hospitalSeguimientoEgreso
     *
     * @return BlhEgresoReceptor
     */
    public function setHospitalSeguimientoEgreso($hospitalSeguimientoEgreso)
    {
        $this->hospitalSeguimientoEgreso = $hospitalSeguimientoEgreso;

        return $this;
    }

    /**
     * Get hospitalSeguimientoEgreso
     *
     * @return string
     */
    public function getHospitalSeguimientoEgreso()
    {
        return $this->hospitalSeguimientoEgreso;
    }

    /**
     * Set fechaEgreso
     *
     * @param \DateTime $fechaEgreso
     *
     * @return BlhEgresoReceptor
     */
    public function setFechaEgreso($fechaEgreso)
    {
        $this->fechaEgreso = $fechaEgreso;

        return $this;
    }

    /**
     * Get fechaEgreso
     *
     * @return \DateTime
     */
    public function getFechaEgreso()
    {
        return $this->fechaEgreso;
    }

    /**
     * Set estanciaHospitalaria
     *
     * @param integer $estanciaHospitalaria
     *
     * @return BlhEgresoReceptor
     */
    public function setEstanciaHospitalaria($estanciaHospitalaria)
    {
        $this->estanciaHospitalaria = $estanciaHospitalaria;

        return $this;
    }

    /**
     * Get estanciaHospitalaria
     *
     * @return integer
     */
    public function getEstanciaHospitalaria()
    {
        return $this->estanciaHospitalaria;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhEgresoReceptor
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
     * Set diasPermanencia
     *
     * @param integer $diasPermanencia
     *
     * @return BlhEgresoReceptor
     */
    public function setDiasPermanencia($diasPermanencia)
    {
        $this->diasPermanencia = $diasPermanencia;

        return $this;
    }

    /**
     * Get diasPermanencia
     *
     * @return integer
     */
    public function getDiasPermanencia()
    {
        return $this->diasPermanencia;
    }

    /**
     * Set fechaHoraReg
     *
     * @param \DateTime $fechaHoraReg
     *
     * @return BlhEgresoReceptor
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
     * Set metodoMadreCanguro
     *
     * @param boolean $metodoMadreCanguro
     * @return BlhEgresoReceptor
     */
    public function setMetodoMadreCanguro($metodoMadreCanguro)
    {
        $this->metodoMadreCanguro = $metodoMadreCanguro;

        return $this;
    }

    /**
     * Get metodoMadreCanguro
     *
     * @return boolean 
     */
    public function getMetodoMadreCanguro()
    {
        return $this->metodoMadreCanguro;
    }

    /**
     * Set trasladarPeriferico
     *
     * @param boolean $trasladarPeriferico
     * @return BlhEgresoReceptor
     */
    public function setTrasladarPeriferico($trasladarPeriferico)
    {
        $this->trasladarPeriferico = $trasladarPeriferico;

        return $this;
    }

    /**
     * Get trasladarPeriferico
     *
     * @return boolean 
     */
    public function getTrasladarPeriferico()
    {
        return $this->trasladarPeriferico;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     *
     * @return BlhEgresoReceptor
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
     * Set idReceptor
     *
     * @param \Minsal\SiblhBundle\Entity\BlhReceptor $idReceptor
     *
     * @return BlhEgresoReceptor
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
     * @return BlhEgresoReceptor
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
     * Set idTipoEgreso
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCtlTipoEgreso $idTipoEgreso
     *
     * @return BlhEgresoReceptor
     */
    public function setIdTipoEgreso(\Minsal\SiblhBundle\Entity\BlhCtlTipoEgreso $idTipoEgreso = null)
    {
        $this->idTipoEgreso = $idTipoEgreso;

        return $this;
    }

    /**
     * Get idTipoEgreso
     *
     * @return \Minsal\SiblhBundle\Entity\BlhCtlTipoEgreso
     */
    public function getIdTipoEgreso()
    {
        return $this->idTipoEgreso;
    }

    /**
     * Set idBancoDeLeche
     *
     * @param \Minsal\SiblhBundle\Entity\BlhBancoDeLeche $idBancoDeLeche
     *
     * @return BlhEgresoReceptor
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
