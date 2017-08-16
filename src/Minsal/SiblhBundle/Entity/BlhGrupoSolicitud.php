<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhGrupoSolicitud
 *
 * @ORM\Table(name="blh_grupo_solicitud", indexes={@ORM\Index(name="IDX_4703F711D8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class BlhGrupoSolicitud implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_grupo_solicitud_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_grupo_solicitud", type="string", length=13, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 13,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $codigoGrupoSolicitud;

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
     * @ORM\OneToMany(targetEntity="BlhSolicitud", mappedBy="idGrupoSolicitud", cascade={"all"}, orphanRemoval=true)
     */
    private $grupoSolicitudes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fechaHoraReg = new \DateTime('now');
        
        $this->grupoSolicitudes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->codigoGrupoSolicitud;
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
     * Set codigoGrupoSolicitud
     *
     * @param string $codigoGrupoSolicitud
     *
     * @return BlhGrupoSolicitud
     */
    public function setCodigoGrupoSolicitud($codigoGrupoSolicitud)
    {
        $this->codigoGrupoSolicitud = $codigoGrupoSolicitud;

        return $this;
    }

    /**
     * Get codigoGrupoSolicitud
     *
     * @return string
     */
    public function getCodigoGrupoSolicitud()
    {
        return $this->codigoGrupoSolicitud;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhGrupoSolicitud
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
     * @return BlhGrupoSolicitud
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
     * @return BlhGrupoSolicitud
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
     * Add grupoSolicitude
     *
     * @param \Minsal\SiblhBundle\Entity\BlhSolicitud $grupoSolicitude
     *
     * @return BlhGrupoSolicitud
     */
    public function addGrupoSolicitude(\Minsal\SiblhBundle\Entity\BlhSolicitud $grupoSolicitude)
    {
        $this->grupoSolicitudes[] = $grupoSolicitude;

        return $this;
    }

    /**
     * Remove grupoSolicitude
     *
     * @param \Minsal\SiblhBundle\Entity\BlhSolicitud $grupoSolicitude
     */
    public function removeGrupoSolicitude(\Minsal\SiblhBundle\Entity\BlhSolicitud $grupoSolicitude)
    {
        $this->grupoSolicitudes->removeElement($grupoSolicitude);
    }

    /**
     * Get grupoSolicitudes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGrupoSolicitudes()
    {
        return $this->grupoSolicitudes;
    }

}
