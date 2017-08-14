<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhCrematocrito
 *
 * @ORM\Table(name="blh_crematocrito", indexes={@ORM\Index(name="IDX_94B73C6C59B17EFE", columns={"id_frasco_procesado"}), @ORM\Index(name="IDX_94B73C6CEC124187", columns={"id_frasco_recolectado"}), @ORM\Index(name="IDX_94B73C6CD8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SiblhBundle\Repository\BlhCrematocritoRepository")
 */
class BlhCrematocrito implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_crematocrito_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="crema1", type="decimal", precision=6, scale=4, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $crema1;

    /**
     * @var string
     *
     * @ORM\Column(name="crema2", type="decimal", precision=6, scale=4, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $crema2;

    /**
     * @var string
     *
     * @ORM\Column(name="crema3", type="decimal", precision=6, scale=4, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $crema3;

    /**
     * @var string
     *
     * @ORM\Column(name="ct1", type="decimal", precision=6, scale=4, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $ct1;

    /**
     * @var string
     *
     * @ORM\Column(name="ct2", type="decimal", precision=6, scale=4, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $ct2;

    /**
     * @var string
     *
     * @ORM\Column(name="ct3", type="decimal", precision=6, scale=4, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $ct3;

    /**
     * @var string
     *
     * @ORM\Column(name="media_crema", type="decimal", precision=6, scale=4, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $mediaCrema;

    /**
     * @var string
     *
     * @ORM\Column(name="media_ct", type="decimal", precision=6, scale=4, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $mediaCt;

    /**
     * @var string
     *
     * @ORM\Column(name="porcentaje_crema", type="decimal", precision=6, scale=4, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $porcentajeCrema;

    /**
     * @var string
     *
     * @ORM\Column(name="kilocalorias", type="decimal", precision=7, scale=4, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $kilocalorias;

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
     * @ORM\ManyToOne(targetEntity="BlhFrascoProcesado", inversedBy="frascoProcesadoCrematocrito")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_frasco_procesado", referencedColumnName="id")
     * })
     */
    private $idFrascoProcesado;

    /**
     * @var \BlhFrascoRecolectado
     *
     * @ORM\ManyToOne(targetEntity="BlhFrascoRecolectado", inversedBy="frascoRecolectadoCrematocrito")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_frasco_recolectado", referencedColumnName="id")
     * })
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
        return (string) $this->idFrascoRecolectado . ' - ' . $this->idFrascoProcesado . ' - ' . $this->mediaCt;
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
     * Set crema1
     *
     * @param string $crema1
     *
     * @return BlhCrematocrito
     */
    public function setCrema1($crema1)
    {
        $this->crema1 = $crema1;

        return $this;
    }

    /**
     * Get crema1
     *
     * @return string
     */
    public function getCrema1()
    {
        return $this->crema1;
    }

    /**
     * Set crema2
     *
     * @param string $crema2
     *
     * @return BlhCrematocrito
     */
    public function setCrema2($crema2)
    {
        $this->crema2 = $crema2;

        return $this;
    }

    /**
     * Get crema2
     *
     * @return string
     */
    public function getCrema2()
    {
        return $this->crema2;
    }

    /**
     * Set crema3
     *
     * @param string $crema3
     *
     * @return BlhCrematocrito
     */
    public function setCrema3($crema3)
    {
        $this->crema3 = $crema3;

        return $this;
    }

    /**
     * Get crema3
     *
     * @return string
     */
    public function getCrema3()
    {
        return $this->crema3;
    }

    /**
     * Set ct1
     *
     * @param string $ct1
     *
     * @return BlhCrematocrito
     */
    public function setCt1($ct1)
    {
        $this->ct1 = $ct1;

        return $this;
    }

    /**
     * Get ct1
     *
     * @return string
     */
    public function getCt1()
    {
        return $this->ct1;
    }

    /**
     * Set ct2
     *
     * @param string $ct2
     *
     * @return BlhCrematocrito
     */
    public function setCt2($ct2)
    {
        $this->ct2 = $ct2;

        return $this;
    }

    /**
     * Get ct2
     *
     * @return string
     */
    public function getCt2()
    {
        return $this->ct2;
    }

    /**
     * Set ct3
     *
     * @param string $ct3
     *
     * @return BlhCrematocrito
     */
    public function setCt3($ct3)
    {
        $this->ct3 = $ct3;

        return $this;
    }

    /**
     * Get ct3
     *
     * @return string
     */
    public function getCt3()
    {
        return $this->ct3;
    }

    /**
     * Set mediaCrema
     *
     * @param string $mediaCrema
     *
     * @return BlhCrematocrito
     */
    public function setMediaCrema($mediaCrema)
    {
        $this->mediaCrema = $mediaCrema;

        return $this;
    }

    /**
     * Get mediaCrema
     *
     * @return string
     */
    public function getMediaCrema()
    {
        return $this->mediaCrema;
    }

    /**
     * Set mediaCt
     *
     * @param string $mediaCt
     *
     * @return BlhCrematocrito
     */
    public function setMediaCt($mediaCt)
    {
        $this->mediaCt = $mediaCt;

        return $this;
    }

    /**
     * Get mediaCt
     *
     * @return string
     */
    public function getMediaCt()
    {
        return $this->mediaCt;
    }

    /**
     * Set porcentajeCrema
     *
     * @param string $porcentajeCrema
     *
     * @return BlhCrematocrito
     */
    public function setPorcentajeCrema($porcentajeCrema)
    {
        $this->porcentajeCrema = $porcentajeCrema;

        return $this;
    }

    /**
     * Get porcentajeCrema
     *
     * @return string
     */
    public function getPorcentajeCrema()
    {
        return $this->porcentajeCrema;
    }

    /**
     * Set kilocalorias
     *
     * @param string $kilocalorias
     *
     * @return BlhCrematocrito
     */
    public function setKilocalorias($kilocalorias)
    {
        $this->kilocalorias = $kilocalorias;

        return $this;
    }

    /**
     * Get kilocalorias
     *
     * @return string
     */
    public function getKilocalorias()
    {
        return $this->kilocalorias;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhCrematocrito
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
     * @return BlhCrematocrito
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
     * @return BlhCrematocrito
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
     * @return BlhCrematocrito
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
     * @return BlhCrematocrito
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