<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhCurva
 *
 * @ORM\Table(name="blh_curva", indexes={@ORM\Index(name="IDX_C08FDE6BD8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SiblhBundle\Repository\BlhCurvaRepository")
 */
class BlhCurva implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_curva_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tiempo1", type="decimal", precision=4, scale=2, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $tiempo1;

    /**
     * @var string
     *
     * @ORM\Column(name="tiempo2", type="decimal", precision=4, scale=2, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $tiempo2;

    /**
     * @var string
     *
     * @ORM\Column(name="tiempo3", type="decimal", precision=4, scale=2, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $tiempo3;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_curva", type="decimal", precision=4, scale=2, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $valorCurva;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_curva", type="date", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Date()
     */
    private $fechaCurva;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad_frascos", type="integer", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $cantidadFrascos;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_por_frasco", type="decimal", precision=7, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $volumenPorFrasco;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_inicio_curva", type="time", nullable=true)
     * @Assert\Time()
     */
    private $horaInicioCurva;

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
     * @var string
     *
     * @ORM\Column(name="volumen_total", type="decimal", precision=20, scale=0, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $volumenTotal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_reg", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaHoraReg;

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
        $this->fechaCurva = new \DateTime('now');
        $this->horaInicioCurva = new \DateTime('now');
        $this->fechaHoraReg = new \DateTime('now');
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->valorCurva . ' - ' . $this->volumenTotal;
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
     * Set tiempo1
     *
     * @param string $tiempo1
     *
     * @return BlhCurva
     */
    public function setTiempo1($tiempo1)
    {
        $this->tiempo1 = $tiempo1;

        return $this;
    }

    /**
     * Get tiempo1
     *
     * @return string
     */
    public function getTiempo1()
    {
        return $this->tiempo1;
    }

    /**
     * Set tiempo2
     *
     * @param string $tiempo2
     *
     * @return BlhCurva
     */
    public function setTiempo2($tiempo2)
    {
        $this->tiempo2 = $tiempo2;

        return $this;
    }

    /**
     * Get tiempo2
     *
     * @return string
     */
    public function getTiempo2()
    {
        return $this->tiempo2;
    }

    /**
     * Set tiempo3
     *
     * @param string $tiempo3
     *
     * @return BlhCurva
     */
    public function setTiempo3($tiempo3)
    {
        $this->tiempo3 = $tiempo3;

        return $this;
    }

    /**
     * Get tiempo3
     *
     * @return string
     */
    public function getTiempo3()
    {
        return $this->tiempo3;
    }

    /**
     * Set valorCurva
     *
     * @param string $valorCurva
     *
     * @return BlhCurva
     */
    public function setValorCurva($valorCurva)
    {
        $this->valorCurva = $valorCurva;

        return $this;
    }

    /**
     * Get valorCurva
     *
     * @return string
     */
    public function getValorCurva()
    {
        return $this->valorCurva;
    }

    /**
     * Set fechaCurva
     *
     * @param \DateTime $fechaCurva
     *
     * @return BlhCurva
     */
    public function setFechaCurva($fechaCurva)
    {
        $this->fechaCurva = $fechaCurva;

        return $this;
    }

    /**
     * Get fechaCurva
     *
     * @return \DateTime
     */
    public function getFechaCurva()
    {
        return $this->fechaCurva;
    }

    /**
     * Set cantidadFrascos
     *
     * @param integer $cantidadFrascos
     *
     * @return BlhCurva
     */
    public function setCantidadFrascos($cantidadFrascos)
    {
        $this->cantidadFrascos = $cantidadFrascos;

        return $this;
    }

    /**
     * Get cantidadFrascos
     *
     * @return integer
     */
    public function getCantidadFrascos()
    {
        return $this->cantidadFrascos;
    }

    /**
     * Set volumenPorFrasco
     *
     * @param string $volumenPorFrasco
     *
     * @return BlhCurva
     */
    public function setVolumenPorFrasco($volumenPorFrasco)
    {
        $this->volumenPorFrasco = $volumenPorFrasco;

        return $this;
    }

    /**
     * Get volumenPorFrasco
     *
     * @return string
     */
    public function getVolumenPorFrasco()
    {
        return $this->volumenPorFrasco;
    }

    /**
     * Set horaInicioCurva
     *
     * @param \DateTime $horaInicioCurva
     *
     * @return BlhCurva
     */
    public function setHoraInicioCurva($horaInicioCurva)
    {
        $this->horaInicioCurva = $horaInicioCurva;

        return $this;
    }

    /**
     * Get horaInicioCurva
     *
     * @return \DateTime
     */
    public function getHoraInicioCurva()
    {
        return $this->horaInicioCurva;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhCurva
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
     * Set volumenTotal
     *
     * @param string $volumenTotal
     *
     * @return BlhCurva
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
     * Set fechaHoraReg
     *
     * @param \DateTime $fechaHoraReg
     *
     * @return BlhCurva
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
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     *
     * @return BlhCurva
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
