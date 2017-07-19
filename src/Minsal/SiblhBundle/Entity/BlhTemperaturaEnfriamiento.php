<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhTemperaturaEnfriamiento
 *
 * @ORM\Table(name="blh_temperatura_enfriamiento", indexes={@ORM\Index(name="IDX_3985D55C9D483370", columns={"id_pasteurizacion"}), @ORM\Index(name="IDX_3985D55CD8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class BlhTemperaturaEnfriamiento implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_temperatura_enfriamiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="temperatura_e", type="integer", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $temperaturaE;

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
     * @ORM\Column(name="hora_inicio_e", type="time", nullable=true)
     * @Assert\Time()
     */
    private $horaInicioE;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_final_e", type="time", nullable=true)
     * @Assert\Time()
     */
    private $horaFinalE;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_reg", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaHoraReg;

    /**
     * @var \BlhPasteurizacion
     *
     * @ORM\ManyToOne(targetEntity="BlhPasteurizacion", inversedBy="pasteurizacionTemperaturaEnfriamiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pasteurizacion", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idPasteurizacion;

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
        return (string) $this->idPasteurizacion . ' - ' . $this->temperaturaE;
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
     * Set temperaturaE
     *
     * @param integer $temperaturaE
     *
     * @return BlhTemperaturaEnfriamiento
     */
    public function setTemperaturaE($temperaturaE)
    {
        $this->temperaturaE = $temperaturaE;

        return $this;
    }

    /**
     * Get temperaturaE
     *
     * @return integer
     */
    public function getTemperaturaE()
    {
        return $this->temperaturaE;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhTemperaturaEnfriamiento
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
     * Set horaInicioE
     *
     * @param \DateTime $horaInicioE
     *
     * @return BlhTemperaturaEnfriamiento
     */
    public function setHoraInicioE($horaInicioE)
    {
        $this->horaInicioE = $horaInicioE;

        return $this;
    }

    /**
     * Get horaInicioE
     *
     * @return \DateTime
     */
    public function getHoraInicioE()
    {
        return $this->horaInicioE;
    }

    /**
     * Set horaFinalE
     *
     * @param \DateTime $horaFinalE
     *
     * @return BlhTemperaturaEnfriamiento
     */
    public function setHoraFinalE($horaFinalE)
    {
        $this->horaFinalE = $horaFinalE;

        return $this;
    }

    /**
     * Get horaFinalE
     *
     * @return \DateTime
     */
    public function getHoraFinalE()
    {
        return $this->horaFinalE;
    }

    /**
     * Set fechaHoraReg
     *
     * @param \DateTime $fechaHoraReg
     *
     * @return BlhTemperaturaEnfriamiento
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
     * Set idPasteurizacion
     *
     * @param \Minsal\SiblhBundle\Entity\BlhPasteurizacion $idPasteurizacion
     *
     * @return BlhTemperaturaEnfriamiento
     */
    public function setIdPasteurizacion(\Minsal\SiblhBundle\Entity\BlhPasteurizacion $idPasteurizacion = null)
    {
        $this->idPasteurizacion = $idPasteurizacion;

        return $this;
    }

    /**
     * Get idPasteurizacion
     *
     * @return \Minsal\SiblhBundle\Entity\BlhPasteurizacion
     */
    public function getIdPasteurizacion()
    {
        return $this->idPasteurizacion;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     *
     * @return BlhTemperaturaEnfriamiento
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