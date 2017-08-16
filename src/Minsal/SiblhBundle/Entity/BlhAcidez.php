<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhAcidez
 *
 * @ORM\Table(name="blh_acidez", indexes={@ORM\Index(name="fk_frasco_reco_acid", columns={"id_frasco_recolectado"}), @ORM\Index(name="IDX_E6CCE10CD8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SiblhBundle\Repository\BlhAcidezRepository")
 */
class BlhAcidez implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_acidez_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="acidez1", type="integer", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $acidez1;

    /**
     * @var integer
     *
     * @ORM\Column(name="acidez2", type="integer", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $acidez2;

    /**
     * @var integer
     *
     * @ORM\Column(name="acidez3", type="integer", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $acidez3;

    /**
     * @var string
     *
     * @ORM\Column(name="factor", type="decimal", precision=6, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $factor;

    /**
     * @var string
     *
     * @ORM\Column(name="resultado", type="decimal", precision=6, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $resultado;

    /**
     * @var string
     *
     * @ORM\Column(name="media_acidez", type="decimal", precision=6, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $mediaAcidez;

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
     * @var \BlhFrascoRecolectado
     *
     * @ORM\ManyToOne(targetEntity="BlhFrascoRecolectado", inversedBy="frascoRecolectadoAcidez")
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
        return (string) $this->idFrascoRecolectado . ' - ' . $this->mediaAcidez;
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
     * Set acidez1
     *
     * @param integer $acidez1
     *
     * @return BlhAcidez
     */
    public function setAcidez1($acidez1)
    {
        $this->acidez1 = $acidez1;

        return $this;
    }

    /**
     * Get acidez1
     *
     * @return integer
     */
    public function getAcidez1()
    {
        return $this->acidez1;
    }

    /**
     * Set acidez2
     *
     * @param integer $acidez2
     *
     * @return BlhAcidez
     */
    public function setAcidez2($acidez2)
    {
        $this->acidez2 = $acidez2;

        return $this;
    }

    /**
     * Get acidez2
     *
     * @return integer
     */
    public function getAcidez2()
    {
        return $this->acidez2;
    }

    /**
     * Set acidez3
     *
     * @param integer $acidez3
     *
     * @return BlhAcidez
     */
    public function setAcidez3($acidez3)
    {
        $this->acidez3 = $acidez3;

        return $this;
    }

    /**
     * Get acidez3
     *
     * @return integer
     */
    public function getAcidez3()
    {
        return $this->acidez3;
    }

    /**
     * Set factor
     *
     * @param string $factor
     *
     * @return BlhAcidez
     */
    public function setFactor($factor)
    {
        $this->factor = $factor;

        return $this;
    }

    /**
     * Get factor
     *
     * @return string
     */
    public function getFactor()
    {
        return $this->factor;
    }

    /**
     * Set resultado
     *
     * @param string $resultado
     *
     * @return BlhAcidez
     */
    public function setResultado($resultado)
    {
        $this->resultado = $resultado;

        return $this;
    }

    /**
     * Get resultado
     *
     * @return string
     */
    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Set mediaAcidez
     *
     * @param string $mediaAcidez
     *
     * @return BlhAcidez
     */
    public function setMediaAcidez($mediaAcidez)
    {
        $this->mediaAcidez = $mediaAcidez;

        return $this;
    }

    /**
     * Get mediaAcidez
     *
     * @return string
     */
    public function getMediaAcidez()
    {
        return $this->mediaAcidez;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhAcidez
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
     * @return BlhAcidez
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
     * Set idFrascoRecolectado
     *
     * @param \Minsal\SiblhBundle\Entity\BlhFrascoRecolectado $idFrascoRecolectado
     *
     * @return BlhAcidez
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
     * @return BlhAcidez
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
