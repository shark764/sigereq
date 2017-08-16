<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhAnalisisSensorial
 *
 * @ORM\Table(name="blh_analisis_sensorial", indexes={@ORM\Index(name="IDX_880123DFEC124187", columns={"id_frasco_recolectado"}), @ORM\Index(name="IDX_880123DFD8A5832B", columns={"id_user_reg"}), @ORM\Index(name="IDX_880123DF6708CAF6", columns={"id_resultado_embalaje"}), @ORM\Index(name="IDX_880123DF9DF1DCAB", columns={"id_resultado_suciedad"}), @ORM\Index(name="IDX_880123DFB9798FD9", columns={"id_resultado_color"}), @ORM\Index(name="IDX_880123DF9A232B3F", columns={"id_resultado_flavor"})})
 * @ORM\Entity(repositoryClass="Minsal\SiblhBundle\Repository\BlhAnalisisSensorialRepository")
 */
class BlhAnalisisSensorial implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_analisis_sensorial_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="embalaje", type="string", length=9, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 9,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $embalaje;

    /**
     * @var string
     *
     * @ORM\Column(name="suciedad", type="string", length=9, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 9,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $suciedad;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=9, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 9,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(name="flavor", type="string", length=9, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 9,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $flavor;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=150, nullable=true)
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
    private $observacion;

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
     * @ORM\ManyToOne(targetEntity="BlhFrascoRecolectado", inversedBy="frascoRecolectadoAnalisisSensorial")
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
     * @var \BlhCtlResultadoAnalisis
     *
     * @ORM\ManyToOne(targetEntity="BlhCtlResultadoAnalisis")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_resultado_embalaje", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idResultadoEmbalaje;

    /**
     * @var \BlhCtlResultadoAnalisis
     *
     * @ORM\ManyToOne(targetEntity="BlhCtlResultadoAnalisis")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_resultado_suciedad", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idResultadoSuciedad;

    /**
     * @var \BlhCtlResultadoAnalisis
     *
     * @ORM\ManyToOne(targetEntity="BlhCtlResultadoAnalisis")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_resultado_color", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idResultadoColor;

    /**
     * @var \BlhCtlResultadoAnalisis
     *
     * @ORM\ManyToOne(targetEntity="BlhCtlResultadoAnalisis")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_resultado_flavor", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idResultadoFlavor;

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
        return (string) $this->embalaje . ' - ' . $this->suciedad . ' - ' . $this->color . ' - ' . $this->flavor;
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
     * Set embalaje
     *
     * @param string $embalaje
     *
     * @return BlhAnalisisSensorial
     */
    public function setEmbalaje($embalaje)
    {
        $this->embalaje = $embalaje;

        return $this;
    }

    /**
     * Get embalaje
     *
     * @return string
     */
    public function getEmbalaje()
    {
        return $this->embalaje;
    }

    /**
     * Set suciedad
     *
     * @param string $suciedad
     *
     * @return BlhAnalisisSensorial
     */
    public function setSuciedad($suciedad)
    {
        $this->suciedad = $suciedad;

        return $this;
    }

    /**
     * Get suciedad
     *
     * @return string
     */
    public function getSuciedad()
    {
        return $this->suciedad;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return BlhAnalisisSensorial
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set flavor
     *
     * @param string $flavor
     *
     * @return BlhAnalisisSensorial
     */
    public function setFlavor($flavor)
    {
        $this->flavor = $flavor;

        return $this;
    }

    /**
     * Get flavor
     *
     * @return string
     */
    public function getFlavor()
    {
        return $this->flavor;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     *
     * @return BlhAnalisisSensorial
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhAnalisisSensorial
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
     * @return BlhAnalisisSensorial
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
     * @return BlhAnalisisSensorial
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
     * @return BlhAnalisisSensorial
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
     * Set idResultadoEmbalaje
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCtlResultadoAnalisis $idResultadoEmbalaje
     *
     * @return BlhAnalisisSensorial
     */
    public function setIdResultadoEmbalaje(\Minsal\SiblhBundle\Entity\BlhCtlResultadoAnalisis $idResultadoEmbalaje = null)
    {
        $this->idResultadoEmbalaje = $idResultadoEmbalaje;

        return $this;
    }

    /**
     * Get idResultadoEmbalaje
     *
     * @return \Minsal\SiblhBundle\Entity\BlhCtlResultadoAnalisis
     */
    public function getIdResultadoEmbalaje()
    {
        return $this->idResultadoEmbalaje;
    }

    /**
     * Set idResultadoSuciedad
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCtlResultadoAnalisis $idResultadoSuciedad
     *
     * @return BlhAnalisisSensorial
     */
    public function setIdResultadoSuciedad(\Minsal\SiblhBundle\Entity\BlhCtlResultadoAnalisis $idResultadoSuciedad = null)
    {
        $this->idResultadoSuciedad = $idResultadoSuciedad;

        return $this;
    }

    /**
     * Get idResultadoSuciedad
     *
     * @return \Minsal\SiblhBundle\Entity\BlhCtlResultadoAnalisis
     */
    public function getIdResultadoSuciedad()
    {
        return $this->idResultadoSuciedad;
    }

    /**
     * Set idResultadoColor
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCtlResultadoAnalisis $idResultadoColor
     *
     * @return BlhAnalisisSensorial
     */
    public function setIdResultadoColor(\Minsal\SiblhBundle\Entity\BlhCtlResultadoAnalisis $idResultadoColor = null)
    {
        $this->idResultadoColor = $idResultadoColor;

        return $this;
    }

    /**
     * Get idResultadoColor
     *
     * @return \Minsal\SiblhBundle\Entity\BlhCtlResultadoAnalisis
     */
    public function getIdResultadoColor()
    {
        return $this->idResultadoColor;
    }

    /**
     * Set idResultadoFlavor
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCtlResultadoAnalisis $idResultadoFlavor
     *
     * @return BlhAnalisisSensorial
     */
    public function setIdResultadoFlavor(\Minsal\SiblhBundle\Entity\BlhCtlResultadoAnalisis $idResultadoFlavor = null)
    {
        $this->idResultadoFlavor = $idResultadoFlavor;

        return $this;
    }

    /**
     * Get idResultadoFlavor
     *
     * @return \Minsal\SiblhBundle\Entity\BlhCtlResultadoAnalisis
     */
    public function getIdResultadoFlavor()
    {
        return $this->idResultadoFlavor;
    }

}
