<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhFrascoProcesadoSolicitud
 *
 * @ORM\Table(name="blh_frasco_procesado_solicitud", indexes={@ORM\Index(name="fk_solicitud_frasco_procesado_s", columns={"id_solicitud"}), @ORM\Index(name="IDX_F422174A59B17EFE", columns={"id_frasco_procesado"}), @ORM\Index(name="IDX_F422174AD8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class BlhFrascoProcesadoSolicitud implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_frasco_procesado_solicitud_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_despachado", type="decimal", precision=6, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $volumenDespachado;

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
     * @var string
     *
     * @ORM\Column(name="volumen_residual", type="decimal", precision=6, scale=4, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $volumenResidual;

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
     * @var \BlhSolicitud
     *
     * @ORM\ManyToOne(targetEntity="BlhSolicitud")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idSolicitud;

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
        return (string) $this->idSolicitud . ' - ' . $this->idFrascoProcesado . ' - ' . $this->volumenDespachado;
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
     * Set volumenDespachado
     *
     * @param string $volumenDespachado
     *
     * @return BlhFrascoProcesadoSolicitud
     */
    public function setVolumenDespachado($volumenDespachado)
    {
        $this->volumenDespachado = $volumenDespachado;

        return $this;
    }

    /**
     * Get volumenDespachado
     *
     * @return string
     */
    public function getVolumenDespachado()
    {
        return $this->volumenDespachado;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhFrascoProcesadoSolicitud
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
     * @return BlhFrascoProcesadoSolicitud
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
     * Set volumenResidual
     *
     * @param string $volumenResidual
     *
     * @return BlhFrascoProcesadoSolicitud
     */
    public function setVolumenResidual($volumenResidual)
    {
        $this->volumenResidual = $volumenResidual;

        return $this;
    }

    /**
     * Get volumenResidual
     *
     * @return string
     */
    public function getVolumenResidual()
    {
        return $this->volumenResidual;
    }

    /**
     * Set idFrascoProcesado
     *
     * @param \Minsal\SiblhBundle\Entity\BlhFrascoProcesado $idFrascoProcesado
     *
     * @return BlhFrascoProcesadoSolicitud
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
     * Set idSolicitud
     *
     * @param \Minsal\SiblhBundle\Entity\BlhSolicitud $idSolicitud
     *
     * @return BlhFrascoProcesadoSolicitud
     */
    public function setIdSolicitud(\Minsal\SiblhBundle\Entity\BlhSolicitud $idSolicitud = null)
    {
        $this->idSolicitud = $idSolicitud;

        return $this;
    }

    /**
     * Get idSolicitud
     *
     * @return \Minsal\SiblhBundle\Entity\BlhSolicitud
     */
    public function getIdSolicitud()
    {
        return $this->idSolicitud;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     *
     * @return BlhFrascoProcesadoSolicitud
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
