<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhFrascoRecolectadoFrascoP
 *
 * @ORM\Table(name="blh_frasco_recolectado_frasco_p", indexes={@ORM\Index(name="IDX_62B6063459B17EFE", columns={"id_frasco_procesado"}), @ORM\Index(name="IDX_62B60634EC124187", columns={"id_frasco_recolectado"}), @ORM\Index(name="IDX_62B60634D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class BlhFrascoRecolectadoFrascoP implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_frasco_recolectado_frasco_p_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_agregado", type="decimal", precision=7, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $volumenAgregado;

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
     * @ORM\ManyToOne(targetEntity="BlhFrascoProcesado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_frasco_procesado", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idFrascoProcesado;

    /**
     * @var \BlhFrascoRecolectado
     *
     * @ORM\ManyToOne(targetEntity="BlhFrascoRecolectado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_frasco_recolectado", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idFrascoRecolectado;

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
        return (string) $this->idFrascoRecolectado . ' - ' . $this->idFrascoProcesado;
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
     * Set volumenAgregado
     *
     * @param string $volumenAgregado
     *
     * @return BlhFrascoRecolectadoFrascoP
     */
    public function setVolumenAgregado($volumenAgregado)
    {
        $this->volumenAgregado = $volumenAgregado;

        return $this;
    }

    /**
     * Get volumenAgregado
     *
     * @return string
     */
    public function getVolumenAgregado()
    {
        return $this->volumenAgregado;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhFrascoRecolectadoFrascoP
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
     * @return BlhFrascoRecolectadoFrascoP
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
     * @return BlhFrascoRecolectadoFrascoP
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
     * Set idFrascoRecolectado
     *
     * @param \Minsal\SiblhBundle\Entity\BlhFrascoRecolectado $idFrascoRecolectado
     *
     * @return BlhFrascoRecolectadoFrascoP
     */
    public function setIdFrascoRecolectado(\Minsal\SiblhBundle\Entity\BlhFrascoRecolectado $idFrascoRecolectado = null)
    {
        $this->idFrascoRecolectado = $idFrascoRecolectado;

        return $this;
    }

    /**
     * Get idFrascoRecolectado
     *
     * @return \Minsal\SiblhBundle\Entity\BlhFrascoRecolectado
     */
    public function getIdFrascoRecolectado()
    {
        return $this->idFrascoRecolectado;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     *
     * @return BlhFrascoRecolectadoFrascoP
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