<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhBancoDeLeche
 *
 * @ORM\Table(name="blh_banco_de_leche", indexes={@ORM\Index(name="fk_establecimiento_banco_de_lec", columns={"id_establecimiento"}), @ORM\Index(name="IDX_329E5BD1D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity(repositoryClass="Minsal\SiblhBundle\Repository\BlhBancoDeLecheRepository")
 */
class BlhBancoDeLeche implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_banco_de_leche_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_banco_de_leche", type="string", length=6, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 6,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $codigoBancoDeLeche;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_banco", type="string", length=8, nullable=true)
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
    private $estadoBanco;

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
     * @ORM\Column(name="nombre", type="string", length=150, nullable=true)
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
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_reg", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaHoraReg;

    /**
     * @var \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idEstablecimiento;

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
     * @ORM\OneToMany(targetEntity="BlhCtlCentroRecoleccion", mappedBy="idBancoDeLeche", cascade={"all"}, orphanRemoval=true)
     */
    private $bancoLecheCentroRecoleccion;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fechaHoraReg = new \DateTime('now');
        
        $this->bancoLecheCentroRecoleccion = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigoBancoDeLeche)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }
    
    /**
     * Text converter for the Entity (Second form).
     */
    public function getPresentacionEntidad()
    {
        return $this->nombre ? mb_strtoupper(trim($this->nombre), 'utf-8') : '';
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
     * Set codigoBancoDeLeche
     *
     * @param string $codigoBancoDeLeche
     *
     * @return BlhBancoDeLeche
     */
    public function setCodigoBancoDeLeche($codigoBancoDeLeche)
    {
        $this->codigoBancoDeLeche = $codigoBancoDeLeche;

        return $this;
    }

    /**
     * Get codigoBancoDeLeche
     *
     * @return string
     */
    public function getCodigoBancoDeLeche()
    {
        return $this->codigoBancoDeLeche;
    }

    /**
     * Set estadoBanco
     *
     * @param string $estadoBanco
     *
     * @return BlhBancoDeLeche
     */
    public function setEstadoBanco($estadoBanco)
    {
        $this->estadoBanco = $estadoBanco;

        return $this;
    }

    /**
     * Get estadoBanco
     *
     * @return string
     */
    public function getEstadoBanco()
    {
        return $this->estadoBanco;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhBancoDeLeche
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
     * @return BlhBancoDeLeche
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return BlhBancoDeLeche
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set idEstablecimiento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento
     *
     * @return BlhBancoDeLeche
     */
    public function setIdEstablecimiento(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento = null)
    {
        $this->idEstablecimiento = $idEstablecimiento;

        return $this;
    }

    /**
     * Get idEstablecimiento
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    public function getIdEstablecimiento()
    {
        return $this->idEstablecimiento;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     *
     * @return BlhBancoDeLeche
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
     * Add bancoLecheCentroRecoleccion
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCtlCentroRecoleccion $bancoLecheCentroRecoleccion
     *
     * @return BlhBancoDeLeche
     */
    public function addBancoLecheCentroRecoleccion(\Minsal\SiblhBundle\Entity\BlhCtlCentroRecoleccion $bancoLecheCentroRecoleccion)
    {
        $this->bancoLecheCentroRecoleccion[] = $bancoLecheCentroRecoleccion;

        return $this;
    }

    /**
     * Remove bancoLecheCentroRecoleccion
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCtlCentroRecoleccion $bancoLecheCentroRecoleccion
     */
    public function removeBancoLecheCentroRecoleccion(\Minsal\SiblhBundle\Entity\BlhCtlCentroRecoleccion $bancoLecheCentroRecoleccion)
    {
        $this->bancoLecheCentroRecoleccion->removeElement($bancoLecheCentroRecoleccion);
    }

    /**
     * Get bancoLecheCentroRecoleccion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBancoLecheCentroRecoleccion()
    {
        return $this->bancoLecheCentroRecoleccion;
    }

}