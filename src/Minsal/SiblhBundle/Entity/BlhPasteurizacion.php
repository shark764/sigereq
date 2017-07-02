<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhPasteurizacion
 *
 * @ORM\Table(name="blh_pasteurizacion", indexes={@ORM\Index(name="fk_curva_pasteurizacion", columns={"id_curva"})})
 * @ORM\Entity
 */
class BlhPasteurizacion implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_pasteurizacion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_pasteurizacion", type="string", length=11, nullable=false)
     */
    private $codigoPasteurizacion = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_ciclo", type="integer", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $numCiclo;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_pasteurizado", type="decimal", precision=7, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $volumenPasteurizado;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_frascos_pasteurizados", type="integer", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $numFrascosPasteurizados;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_pasteurizacion", type="date", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Date()
     */
    private $fechaPasteurizacion;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_pasteurizacion", type="string", length=60, nullable=false)
     */
    private $responsablePasteurizacion;

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
     * @ORM\Column(name="fecha_hora_reg", type="datetime", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\DateTime()
     */
    private $fechaHoraReg;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_total", type="decimal", precision=8, scale=0, nullable=true)
     */
    private $volumenTotal;

    /**
     * @var \BlhCurva
     *
     * @ORM\ManyToOne(targetEntity="BlhCurva")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_curva", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idCurva;

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
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->id;
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
     * Set codigoPasteurizacion
     *
     * @param string $codigoPasteurizacion
     *
     * @return BlhPasteurizacion
     */
    public function setCodigoPasteurizacion($codigoPasteurizacion)
    {
        $this->codigoPasteurizacion = $codigoPasteurizacion;

        return $this;
    }

    /**
     * Get codigoPasteurizacion
     *
     * @return string
     */
    public function getCodigoPasteurizacion()
    {
        return $this->codigoPasteurizacion;
    }

    /**
     * Set numCiclo
     *
     * @param integer $numCiclo
     *
     * @return BlhPasteurizacion
     */
    public function setNumCiclo($numCiclo)
    {
        $this->numCiclo = $numCiclo;

        return $this;
    }

    /**
     * Get numCiclo
     *
     * @return integer
     */
    public function getNumCiclo()
    {
        return $this->numCiclo;
    }

    /**
     * Set volumenPasteurizado
     *
     * @param string $volumenPasteurizado
     *
     * @return BlhPasteurizacion
     */
    public function setVolumenPasteurizado($volumenPasteurizado)
    {
        $this->volumenPasteurizado = $volumenPasteurizado;

        return $this;
    }

    /**
     * Get volumenPasteurizado
     *
     * @return string
     */
    public function getVolumenPasteurizado()
    {
        return $this->volumenPasteurizado;
    }

    /**
     * Set numFrascosPasteurizados
     *
     * @param integer $numFrascosPasteurizados
     *
     * @return BlhPasteurizacion
     */
    public function setNumFrascosPasteurizados($numFrascosPasteurizados)
    {
        $this->numFrascosPasteurizados = $numFrascosPasteurizados;

        return $this;
    }

    /**
     * Get numFrascosPasteurizados
     *
     * @return integer
     */
    public function getNumFrascosPasteurizados()
    {
        return $this->numFrascosPasteurizados;
    }

    /**
     * Set fechaPasteurizacion
     *
     * @param \DateTime $fechaPasteurizacion
     *
     * @return BlhPasteurizacion
     */
    public function setFechaPasteurizacion($fechaPasteurizacion)
    {
        $this->fechaPasteurizacion = $fechaPasteurizacion;

        return $this;
    }

    /**
     * Get fechaPasteurizacion
     *
     * @return \DateTime
     */
    public function getFechaPasteurizacion()
    {
        return $this->fechaPasteurizacion;
    }

    /**
     * Set responsablePasteurizacion
     *
     * @param string $responsablePasteurizacion
     *
     * @return BlhPasteurizacion
     */
    public function setResponsablePasteurizacion($responsablePasteurizacion)
    {
        $this->responsablePasteurizacion = $responsablePasteurizacion;

        return $this;
    }

    /**
     * Get responsablePasteurizacion
     *
     * @return string
     */
    public function getResponsablePasteurizacion()
    {
        return $this->responsablePasteurizacion;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhPasteurizacion
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
     * @return BlhPasteurizacion
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
     * Set volumenTotal
     *
     * @param string $volumenTotal
     *
     * @return BlhPasteurizacion
     */
    public function setVolumenTotal($volumenTotal)
    {
        $this->volumenTotal = $volumenTotal;

        return $this;
    }

    /**
     * Get volumenTotal
     *
     * @return string
     */
    public function getVolumenTotal()
    {
        return $this->volumenTotal;
    }

    /**
     * Set idCurva
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCurva $idCurva
     *
     * @return BlhPasteurizacion
     */
    public function setIdCurva(\Minsal\SiblhBundle\Entity\BlhCurva $idCurva = null)
    {
        $this->idCurva = $idCurva;

        return $this;
    }

    /**
     * Get idCurva
     *
     * @return \Minsal\SiblhBundle\Entity\BlhCurva
     */
    public function getIdCurva()
    {
        return $this->idCurva;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     *
     * @return BlhPasteurizacion
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