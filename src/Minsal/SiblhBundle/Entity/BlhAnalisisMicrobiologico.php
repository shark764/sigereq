<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhAnalisisMicrobiologico
 *
 * @ORM\Table(name="blh_analisis_microbiologico", indexes={@ORM\Index(name="fk_frasco_procesado_analisis_mi", columns={"id_frasco_procesado"}), @ORM\Index(name="IDX_709DCB00D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SiblhBundle\Repository\BlhAnalisisMicrobiologicoRepository")
 */
class BlhAnalisisMicrobiologico implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_analisis_microbiologico_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_analisis_microbiologico", type="string", length=13, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 13,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $codigoAnalisisMicrobiologico;

    /**
     * @var string
     *
     * @ORM\Column(name="coliformes_totales", type="string", length=8, nullable=true)
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
    private $coliformesTotales;

    /**
     * @var string
     *
     * @ORM\Column(name="control", type="string", length=8, nullable=true)
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
    private $control;

    /**
     * @var string
     *
     * @ORM\Column(name="situacion", type="string", length=9, nullable=true)
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
    private $situacion;

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
     * @var \BlhFrascoProcesado
     *
     * @ORM\ManyToOne(targetEntity="BlhFrascoProcesado", inversedBy="frascoProcesadoAnalisisMicrobiologico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_frasco_procesado", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idFrascoProcesado;

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
        return (string) $this->idFrascoProcesado . ' - ' . $this->codigoAnalisisMicrobiologico;
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
     * Set codigoAnalisisMicrobiologico
     *
     * @param string $codigoAnalisisMicrobiologico
     *
     * @return BlhAnalisisMicrobiologico
     */
    public function setCodigoAnalisisMicrobiologico($codigoAnalisisMicrobiologico)
    {
        $this->codigoAnalisisMicrobiologico = $codigoAnalisisMicrobiologico;

        return $this;
    }

    /**
     * Get codigoAnalisisMicrobiologico
     *
     * @return string
     */
    public function getCodigoAnalisisMicrobiologico()
    {
        return $this->codigoAnalisisMicrobiologico;
    }

    /**
     * Set coliformesTotales
     *
     * @param string $coliformesTotales
     *
     * @return BlhAnalisisMicrobiologico
     */
    public function setColiformesTotales($coliformesTotales)
    {
        $this->coliformesTotales = $coliformesTotales;

        return $this;
    }

    /**
     * Get coliformesTotales
     *
     * @return string
     */
    public function getColiformesTotales()
    {
        return $this->coliformesTotales;
    }

    /**
     * Set control
     *
     * @param string $control
     *
     * @return BlhAnalisisMicrobiologico
     */
    public function setControl($control)
    {
        $this->control = $control;

        return $this;
    }

    /**
     * Get control
     *
     * @return string
     */
    public function getControl()
    {
        return $this->control;
    }

    /**
     * Set situacion
     *
     * @param string $situacion
     *
     * @return BlhAnalisisMicrobiologico
     */
    public function setSituacion($situacion)
    {
        $this->situacion = $situacion;

        return $this;
    }

    /**
     * Get situacion
     *
     * @return string
     */
    public function getSituacion()
    {
        return $this->situacion;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhAnalisisMicrobiologico
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
     * @return BlhAnalisisMicrobiologico
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
     * Set idFrascoProcesado
     *
     * @param \Minsal\SiblhBundle\Entity\BlhFrascoProcesado $idFrascoProcesado
     *
     * @return BlhAnalisisMicrobiologico
     */
    public function setIdFrascoProcesado(\Minsal\SiblhBundle\Entity\BlhFrascoProcesado $idFrascoProcesado = null)
    {
        $this->idFrascoProcesado = $idFrascoProcesado;

        return $this;
    }

    /**
     * Get idFrascoProcesado
     *
     * @return \Minsal\SiblhBundle\Entity\BlhFrascoProcesado
     */
    public function getIdFrascoProcesado()
    {
        return $this->idFrascoProcesado;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     *
     * @return BlhAnalisisMicrobiologico
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