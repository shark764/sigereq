<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhFrascoProcesado
 *
 * @ORM\Table(name="blh_frasco_procesado", indexes={@ORM\Index(name="fk_pasteurizacion_frasco_proces", columns={"id_pasteurizacion"}), @ORM\Index(name="IDX_4BD55E3D6A540E", columns={"id_estado"}), @ORM\Index(name="IDX_4BD55E3DD8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class BlhFrascoProcesado implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_frasco_procesado_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_frasco_procesado", type="string", length=15, nullable=true)
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
    private $codigoFrascoProcesado;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_frasco_pasteurizado", type="decimal", precision=7, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $volumenFrascoPasteurizado;

    /**
     * @var string
     *
     * @ORM\Column(name="acidez_total", type="decimal", precision=7, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $acidezTotal;

    /**
     * @var string
     *
     * @ORM\Column(name="kcalorias_totales", type="decimal", precision=7, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $kcaloriasTotales;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion_frasco_procesado", type="string", length=150, nullable=true)
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
    private $observacionFrascoProcesado;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_disponible_fp", type="decimal", precision=7, scale=4, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $volumenDisponibleFp;

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
     * @ORM\Column(name="desechado", type="boolean", nullable=true)
     */
    private $desechado = false;

    /**
     * @var \BlhEstado
     *
     * @ORM\ManyToOne(targetEntity="BlhEstado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idEstado;

    /**
     * @var \BlhPasteurizacion
     *
     * @ORM\ManyToOne(targetEntity="BlhPasteurizacion", inversedBy="pasteurizacionFrascoProcesado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pasteurizacion", referencedColumnName="id")
     * })
     */
    private $idPasteurizacion;

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
     * @ORM\OneToMany(targetEntity="BlhAnalisisMicrobiologico", mappedBy="idFrascoProcesado", cascade={"all"}, orphanRemoval=true)
     */
    private $frascoProcesadoAnalisisMicrobiologico;

    /**
     * @ORM\OneToMany(targetEntity="BlhCrematocrito", mappedBy="idFrascoProcesado", cascade={"all"}, orphanRemoval=true)
     */
    private $frascoProcesadoCrematocrito;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fechaHoraReg = new \DateTime('now');
        
        $this->frascoProcesadoAnalisisMicrobiologico = new \Doctrine\Common\Collections\ArrayCollection();
        $this->frascoProcesadoCrematocrito = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->idPasteurizacion . ' - ' . $this->codigoFrascoProcesado;
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
     * Set codigoFrascoProcesado
     *
     * @param string $codigoFrascoProcesado
     *
     * @return BlhFrascoProcesado
     */
    public function setCodigoFrascoProcesado($codigoFrascoProcesado)
    {
        $this->codigoFrascoProcesado = $codigoFrascoProcesado;

        return $this;
    }

    /**
     * Get codigoFrascoProcesado
     *
     * @return string
     */
    public function getCodigoFrascoProcesado()
    {
        return $this->codigoFrascoProcesado;
    }

    /**
     * Set volumenFrascoPasteurizado
     *
     * @param string $volumenFrascoPasteurizado
     *
     * @return BlhFrascoProcesado
     */
    public function setVolumenFrascoPasteurizado($volumenFrascoPasteurizado)
    {
        $this->volumenFrascoPasteurizado = $volumenFrascoPasteurizado;

        return $this;
    }

    /**
     * Get volumenFrascoPasteurizado
     *
     * @return string
     */
    public function getVolumenFrascoPasteurizado()
    {
        return $this->volumenFrascoPasteurizado;
    }

    /**
     * Set acidezTotal
     *
     * @param string $acidezTotal
     *
     * @return BlhFrascoProcesado
     */
    public function setAcidezTotal($acidezTotal)
    {
        $this->acidezTotal = $acidezTotal;

        return $this;
    }

    /**
     * Get acidezTotal
     *
     * @return string
     */
    public function getAcidezTotal()
    {
        return $this->acidezTotal;
    }

    /**
     * Set kcaloriasTotales
     *
     * @param string $kcaloriasTotales
     *
     * @return BlhFrascoProcesado
     */
    public function setKcaloriasTotales($kcaloriasTotales)
    {
        $this->kcaloriasTotales = $kcaloriasTotales;

        return $this;
    }

    /**
     * Get kcaloriasTotales
     *
     * @return string
     */
    public function getKcaloriasTotales()
    {
        return $this->kcaloriasTotales;
    }

    /**
     * Set observacionFrascoProcesado
     *
     * @param string $observacionFrascoProcesado
     *
     * @return BlhFrascoProcesado
     */
    public function setObservacionFrascoProcesado($observacionFrascoProcesado)
    {
        $this->observacionFrascoProcesado = $observacionFrascoProcesado;

        return $this;
    }

    /**
     * Get observacionFrascoProcesado
     *
     * @return string
     */
    public function getObservacionFrascoProcesado()
    {
        return $this->observacionFrascoProcesado;
    }

    /**
     * Set volumenDisponibleFp
     *
     * @param string $volumenDisponibleFp
     *
     * @return BlhFrascoProcesado
     */
    public function setVolumenDisponibleFp($volumenDisponibleFp)
    {
        $this->volumenDisponibleFp = $volumenDisponibleFp;

        return $this;
    }

    /**
     * Get volumenDisponibleFp
     *
     * @return string
     */
    public function getVolumenDisponibleFp()
    {
        return $this->volumenDisponibleFp;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhFrascoProcesado
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
     * @return BlhFrascoProcesado
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
     * Set desechado
     *
     * @param boolean $desechado
     * @return BlhFrascoProcesado
     */
    public function setDesechado($desechado)
    {
        $this->desechado = $desechado;

        return $this;
    }

    /**
     * Get desechado
     *
     * @return boolean 
     */
    public function getDesechado()
    {
        return $this->desechado;
    }

    /**
     * Set idEstado
     *
     * @param \Minsal\SiblhBundle\Entity\BlhEstado $idEstado
     *
     * @return BlhFrascoProcesado
     */
    public function setIdEstado(\Minsal\SiblhBundle\Entity\BlhEstado $idEstado = null)
    {
        $this->idEstado = $idEstado;

        return $this;
    }

    /**
     * Get idEstado
     *
     * @return \Minsal\SiblhBundle\Entity\BlhEstado
     */
    public function getIdEstado()
    {
        return $this->idEstado;
    }

    /**
     * Set idPasteurizacion
     *
     * @param \Minsal\SiblhBundle\Entity\BlhPasteurizacion $idPasteurizacion
     *
     * @return BlhFrascoProcesado
     */
    public function setIdPasteurizacion(\Minsal\SiblhBundle\Entity\BlhPasteurizacion $idPasteurizacion = null)
    {
        $this->idPasteurizacion = $idPasteurizacion;

        return $this;
    }

    /**
     * Get idPasteurizacion
     *
     * @return \Minsal\SiblhBundle\Entity\BlhPasteurizacion
     */
    public function getIdPasteurizacion()
    {
        return $this->idPasteurizacion;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     *
     * @return BlhFrascoProcesado
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
     * Add frascoProcesadoAnalisisMicrobiologico
     *
     * @param \Minsal\SiblhBundle\Entity\BlhAnalisisMicrobiologico $frascoProcesadoAnalisisMicrobiologico
     *
     * @return BlhFrascoProcesado
     */
    public function addFrascoProcesadoAnalisisMicrobiologico(\Minsal\SiblhBundle\Entity\BlhAnalisisMicrobiologico $frascoProcesadoAnalisisMicrobiologico)
    {
        $this->frascoProcesadoAnalisisMicrobiologico[] = $frascoProcesadoAnalisisMicrobiologico;

        return $this;
    }

    /**
     * Remove frascoProcesadoAnalisisMicrobiologico
     *
     * @param \Minsal\SiblhBundle\Entity\BlhAnalisisMicrobiologico $frascoProcesadoAnalisisMicrobiologico
     */
    public function removeFrascoProcesadoAnalisisMicrobiologico(\Minsal\SiblhBundle\Entity\BlhAnalisisMicrobiologico $frascoProcesadoAnalisisMicrobiologico)
    {
        $this->frascoProcesadoAnalisisMicrobiologico->removeElement($frascoProcesadoAnalisisMicrobiologico);
    }

    /**
     * Get frascoProcesadoAnalisisMicrobiologico
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFrascoProcesadoAnalisisMicrobiologico()
    {
        return $this->frascoProcesadoAnalisisMicrobiologico;
    }

    /**
     * Add frascoProcesadoCrematocrito
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCrematocrito $frascoProcesadoCrematocrito
     *
     * @return BlhFrascoProcesado
     */
    public function addFrascoProcesadoCrematocrito(\Minsal\SiblhBundle\Entity\BlhCrematocrito $frascoProcesadoCrematocrito)
    {
        $this->frascoProcesadoCrematocrito[] = $frascoProcesadoCrematocrito;

        return $this;
    }

    /**
     * Remove frascoProcesadoCrematocrito
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCrematocrito $frascoProcesadoCrematocrito
     */
    public function removeFrascoProcesadoCrematocrito(\Minsal\SiblhBundle\Entity\BlhCrematocrito $frascoProcesadoCrematocrito)
    {
        $this->frascoProcesadoCrematocrito->removeElement($frascoProcesadoCrematocrito);
    }

    /**
     * Get frascoProcesadoCrematocrito
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFrascoProcesadoCrematocrito()
    {
        return $this->frascoProcesadoCrematocrito;
    }

}