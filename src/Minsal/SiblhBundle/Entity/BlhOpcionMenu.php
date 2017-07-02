<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhOpcionMenu
 *
 * @ORM\Table(name="blh_opcion_menu", indexes={@ORM\Index(name="fk_menu_opcion_menu", columns={"id_menu"})})
 * @ORM\Entity
 */
class BlhOpcionMenu implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_opcion_menu_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_opcion", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $nombreOpcion;

    /**
     * @var string
     *
     * @ORM\Column(name="url_opcion", type="string", length=100, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $urlOpcion;

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
     * @var \BlhMenu
     *
     * @ORM\ManyToOne(targetEntity="BlhMenu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_menu", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idMenu;

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
     * Set nombreOpcion
     *
     * @param string $nombreOpcion
     *
     * @return BlhOpcionMenu
     */
    public function setNombreOpcion($nombreOpcion)
    {
        $this->nombreOpcion = $nombreOpcion;

        return $this;
    }

    /**
     * Get nombreOpcion
     *
     * @return string
     */
    public function getNombreOpcion()
    {
        return $this->nombreOpcion;
    }

    /**
     * Set urlOpcion
     *
     * @param string $urlOpcion
     *
     * @return BlhOpcionMenu
     */
    public function setUrlOpcion($urlOpcion)
    {
        $this->urlOpcion = $urlOpcion;

        return $this;
    }

    /**
     * Get urlOpcion
     *
     * @return string
     */
    public function getUrlOpcion()
    {
        return $this->urlOpcion;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhOpcionMenu
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
     * @return BlhOpcionMenu
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
     * Set idMenu
     *
     * @param \Minsal\SiblhBundle\Entity\BlhMenu $idMenu
     *
     * @return BlhOpcionMenu
     */
    public function setIdMenu(\Minsal\SiblhBundle\Entity\BlhMenu $idMenu = null)
    {
        $this->idMenu = $idMenu;

        return $this;
    }

    /**
     * Get idMenu
     *
     * @return \Minsal\SiblhBundle\Entity\BlhMenu
     */
    public function getIdMenu()
    {
        return $this->idMenu;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     *
     * @return BlhOpcionMenu
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