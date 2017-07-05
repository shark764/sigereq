<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhLoteAnalisis
 *
 * @ORM\Table(name="blh_lote_analisis", indexes={@ORM\Index(name="IDX_232421CCD8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class BlhLoteAnalisis implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_lote_analisis_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_lote_analisis", type="string", length=11, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 11,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $codigoLoteAnalisis;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_analisis_fisico_quimico", type="date", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Date()
     */
    private $fechaAnalisisFisicoQuimico;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_analisis", type="string", length=60, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 60,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $responsableAnalisis;

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
        return (string) $this->codigoLoteAnalisis;
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
     * Set codigoLoteAnalisis
     *
     * @param string $codigoLoteAnalisis
     *
     * @return BlhLoteAnalisis
     */
    public function setCodigoLoteAnalisis($codigoLoteAnalisis)
    {
        $this->codigoLoteAnalisis = $codigoLoteAnalisis;

        return $this;
    }

    /**
     * Get codigoLoteAnalisis
     *
     * @return string
     */
    public function getCodigoLoteAnalisis()
    {
        return $this->codigoLoteAnalisis;
    }

    /**
     * Set fechaAnalisisFisicoQuimico
     *
     * @param \DateTime $fechaAnalisisFisicoQuimico
     *
     * @return BlhLoteAnalisis
     */
    public function setFechaAnalisisFisicoQuimico($fechaAnalisisFisicoQuimico)
    {
        $this->fechaAnalisisFisicoQuimico = $fechaAnalisisFisicoQuimico;

        return $this;
    }

    /**
     * Get fechaAnalisisFisicoQuimico
     *
     * @return \DateTime
     */
    public function getFechaAnalisisFisicoQuimico()
    {
        return $this->fechaAnalisisFisicoQuimico;
    }

    /**
     * Set responsableAnalisis
     *
     * @param string $responsableAnalisis
     *
     * @return BlhLoteAnalisis
     */
    public function setResponsableAnalisis($responsableAnalisis)
    {
        $this->responsableAnalisis = $responsableAnalisis;

        return $this;
    }

    /**
     * Get responsableAnalisis
     *
     * @return string
     */
    public function getResponsableAnalisis()
    {
        return $this->responsableAnalisis;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhLoteAnalisis
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
     * @return BlhLoteAnalisis
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
     * @return BlhLoteAnalisis
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