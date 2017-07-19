<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhTemperaturaPasteurizacion
 *
 * @ORM\Table(name="blh_temperatura_pasteurizacion", indexes={@ORM\Index(name="IDX_A77617AA9D483370", columns={"id_pasteurizacion"}), @ORM\Index(name="IDX_A77617AAD8A5832B", columns={"id_user_reg"})})
 * @ORM\Entity
 */
class BlhTemperaturaPasteurizacion implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_temperatura_pasteurizacion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="temperatura_p", type="integer", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $temperaturaP;

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
     * @ORM\Column(name="hora_inicio_p", type="time", nullable=true)
     * @Assert\Time()
     */
    private $horaInicioP;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_final_p", type="time", nullable=true)
     * @Assert\Time()
     */
    private $horaFinalP;

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
     * @ORM\ManyToOne(targetEntity="BlhPasteurizacion", inversedBy="pasteurizacionTemperaturaPasteurizacion")
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
        return (string) $this->idPasteurizacion . ' - ' . $this->temperaturaP;
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
     * Set temperaturaP
     *
     * @param integer $temperaturaP
     *
     * @return BlhTemperaturaPasteurizacion
     */
    public function setTemperaturaP($temperaturaP)
    {
        $this->temperaturaP = $temperaturaP;

        return $this;
    }

    /**
     * Get temperaturaP
     *
     * @return integer
     */
    public function getTemperaturaP()
    {
        return $this->temperaturaP;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhTemperaturaPasteurizacion
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
     * Set horaInicioP
     *
     * @param \DateTime $horaInicioP
     *
     * @return BlhTemperaturaPasteurizacion
     */
    public function setHoraInicioP($horaInicioP)
    {
        $this->horaInicioP = $horaInicioP;

        return $this;
    }

    /**
     * Get horaInicioP
     *
     * @return \DateTime
     */
    public function getHoraInicioP()
    {
        return $this->horaInicioP;
    }

    /**
     * Set horaFinalP
     *
     * @param \DateTime $horaFinalP
     *
     * @return BlhTemperaturaPasteurizacion
     */
    public function setHoraFinalP($horaFinalP)
    {
        $this->horaFinalP = $horaFinalP;

        return $this;
    }

    /**
     * Get horaFinalP
     *
     * @return \DateTime
     */
    public function getHoraFinalP()
    {
        return $this->horaFinalP;
    }

    /**
     * Set fechaHoraReg
     *
     * @param \DateTime $fechaHoraReg
     *
     * @return BlhTemperaturaPasteurizacion
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
     * @return BlhTemperaturaPasteurizacion
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
     * @return BlhTemperaturaPasteurizacion
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