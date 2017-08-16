<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhPasteurizacion
 *
 * @ORM\Table(name="blh_pasteurizacion", indexes={@ORM\Index(name="fk_curva_pasteurizacion", columns={"id_curva"}), @ORM\Index(name="IDX_822F9117D8A5832B", columns={"id_user_reg"}), @ORM\Index(name="IDX_822F9117919F2FC7", columns={"id_responsable_pasteurizacion"}), @ORM\Index(name="IDX_822F91172DF9F9B6", columns={"id_banco_de_leche"})})
 * @ORM\Entity(repositoryClass="Minsal\SiblhBundle\Repository\BlhPasteurizacionRepository")
 */
class BlhPasteurizacion implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_pasteurizacion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_pasteurizacion", type="string", length=11, nullable=true)
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
    private $codigoPasteurizacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_ciclo", type="integer", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $numCiclo;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_pasteurizado", type="decimal", precision=7, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $volumenPasteurizado;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_frascos_pasteurizados", type="integer", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $numFrascosPasteurizados;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_pasteurizacion", type="date", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Date()
     */
    private $fechaPasteurizacion;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_pasteurizacion", type="string", length=60, nullable=true)
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
    private $responsablePasteurizacion;

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
     * @ORM\Column(name="volumen_total", type="decimal", precision=8, scale=0, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $volumenTotal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_reg", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaHoraReg;

    /**
     * @var \BlhCurva
     *
     * @ORM\ManyToOne(targetEntity="BlhCurva")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_curva", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idCurva;

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
     * @var \Minsal\SiapsBundle\Entity\MntEmpleado
     *
     * @ORM\ManyToOne(targetEntity="Minsal\SiapsBundle\Entity\MntEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_responsable_pasteurizacion", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idResponsablePasteurizacion;

    /**
     * @var \BlhBancoDeLeche
     *
     * @ORM\ManyToOne(targetEntity="BlhBancoDeLeche")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_banco_de_leche", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idBancoDeLeche;

    /**
     * @ORM\OneToMany(targetEntity="BlhTemperaturaPasteurizacion", mappedBy="idPasteurizacion", cascade={"all"}, orphanRemoval=true)
     */
    private $pasteurizacionTemperaturaPasteurizacion;

    /**
     * @ORM\OneToMany(targetEntity="BlhTemperaturaEnfriamiento", mappedBy="idPasteurizacion", cascade={"all"}, orphanRemoval=true)
     */
    private $pasteurizacionTemperaturaEnfriamiento;

    /**
     * @ORM\OneToMany(targetEntity="BlhFrascoProcesado", mappedBy="idPasteurizacion", cascade={"all"}, orphanRemoval=true)
     */
    private $pasteurizacionFrascoProcesado;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fechaPasteurizacion = new \DateTime('now');
        $this->fechaHoraReg = new \DateTime('now');
        
        $this->pasteurizacionTemperaturaPasteurizacion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pasteurizacionTemperaturaEnfriamiento = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pasteurizacionFrascoProcesado = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->codigoPasteurizacion . ' - ' . $this->volumenTotal;
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
     * Set codigoPasteurizacion
     *
     * @param string $codigoPasteurizacion
     *
     * @return BlhPasteurizacion
     */
    public function setCodigoPasteurizacion($codigoPasteurizacion)
    {
        $this->codigoPasteurizacion = $codigoPasteurizacion;

        return $this;
    }

    /**
     * Get codigoPasteurizacion
     *
     * @return string
     */
    public function getCodigoPasteurizacion()
    {
        return $this->codigoPasteurizacion;
    }

    /**
     * Set numCiclo
     *
     * @param integer $numCiclo
     *
     * @return BlhPasteurizacion
     */
    public function setNumCiclo($numCiclo)
    {
        $this->numCiclo = $numCiclo;

        return $this;
    }

    /**
     * Get numCiclo
     *
     * @return integer
     */
    public function getNumCiclo()
    {
        return $this->numCiclo;
    }

    /**
     * Set volumenPasteurizado
     *
     * @param string $volumenPasteurizado
     *
     * @return BlhPasteurizacion
     */
    public function setVolumenPasteurizado($volumenPasteurizado)
    {
        $this->volumenPasteurizado = $volumenPasteurizado;

        return $this;
    }

    /**
     * Get volumenPasteurizado
     *
     * @return string
     */
    public function getVolumenPasteurizado()
    {
        return $this->volumenPasteurizado;
    }

    /**
     * Set numFrascosPasteurizados
     *
     * @param integer $numFrascosPasteurizados
     *
     * @return BlhPasteurizacion
     */
    public function setNumFrascosPasteurizados($numFrascosPasteurizados)
    {
        $this->numFrascosPasteurizados = $numFrascosPasteurizados;

        return $this;
    }

    /**
     * Get numFrascosPasteurizados
     *
     * @return integer
     */
    public function getNumFrascosPasteurizados()
    {
        return $this->numFrascosPasteurizados;
    }

    /**
     * Set fechaPasteurizacion
     *
     * @param \DateTime $fechaPasteurizacion
     *
     * @return BlhPasteurizacion
     */
    public function setFechaPasteurizacion($fechaPasteurizacion)
    {
        $this->fechaPasteurizacion = $fechaPasteurizacion;

        return $this;
    }

    /**
     * Get fechaPasteurizacion
     *
     * @return \DateTime
     */
    public function getFechaPasteurizacion()
    {
        return $this->fechaPasteurizacion;
    }

    /**
     * Set responsablePasteurizacion
     *
     * @param string $responsablePasteurizacion
     *
     * @return BlhPasteurizacion
     */
    public function setResponsablePasteurizacion($responsablePasteurizacion)
    {
        $this->responsablePasteurizacion = $responsablePasteurizacion;

        return $this;
    }

    /**
     * Get responsablePasteurizacion
     *
     * @return string
     */
    public function getResponsablePasteurizacion()
    {
        return $this->responsablePasteurizacion;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhPasteurizacion
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
     * Set volumenTotal
     *
     * @param string $volumenTotal
     *
     * @return BlhPasteurizacion
     */
    public function setVolumenTotal($volumenTotal)
    {
        $this->volumenTotal = $volumenTotal;

        return $this;
    }

    /**
     * Get volumenTotal
     *
     * @return string
     */
    public function getVolumenTotal()
    {
        return $this->volumenTotal;
    }

    /**
     * Set fechaHoraReg
     *
     * @param \DateTime $fechaHoraReg
     *
     * @return BlhPasteurizacion
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
     * Set idCurva
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCurva $idCurva
     *
     * @return BlhPasteurizacion
     */
    public function setIdCurva(\Minsal\SiblhBundle\Entity\BlhCurva $idCurva = null)
    {
        $this->idCurva = $idCurva;

        return $this;
    }

    /**
     * Get idCurva
     *
     * @return \Minsal\SiblhBundle\Entity\BlhCurva
     */
    public function getIdCurva()
    {
        return $this->idCurva;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     *
     * @return BlhPasteurizacion
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
     * Set idResponsablePasteurizacion
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idResponsablePasteurizacion
     *
     * @return BlhDonacion
     */
    public function setIdResponsablePasteurizacion(\Minsal\SiapsBundle\Entity\MntEmpleado $idResponsablePasteurizacion = null)
    {
        $this->idResponsablePasteurizacion = $idResponsablePasteurizacion;

        return $this;
    }

    /**
     * Get idResponsablePasteurizacion
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado
     */
    public function getIdResponsablePasteurizacion()
    {
        return $this->idResponsablePasteurizacion;
    }

    /**
     * Set idBancoDeLeche
     *
     * @param \Minsal\SiblhBundle\Entity\BlhBancoDeLeche $idBancoDeLeche
     *
     * @return BlhSolicitud
     */
    public function setIdBancoDeLeche(\Minsal\SiblhBundle\Entity\BlhBancoDeLeche $idBancoDeLeche = null)
    {
        $this->idBancoDeLeche = $idBancoDeLeche;

        return $this;
    }

    /**
     * Get idBancoDeLeche
     *
     * @return \Minsal\SiblhBundle\Entity\BlhBancoDeLeche
     */
    public function getIdBancoDeLeche()
    {
        return $this->idBancoDeLeche;
    }

    /**
     * Add pasteurizacionTemperaturaPasteurizacion
     *
     * @param \Minsal\SiblhBundle\Entity\BlhTemperaturaPasteurizacion $pasteurizacionTemperaturaPasteurizacion
     *
     * @return BlhPasteurizacion
     */
    public function addPasteurizacionTemperaturaPasteurizacion(\Minsal\SiblhBundle\Entity\BlhTemperaturaPasteurizacion $pasteurizacionTemperaturaPasteurizacion)
    {
        $this->pasteurizacionTemperaturaPasteurizacion[] = $pasteurizacionTemperaturaPasteurizacion;

        return $this;
    }

    /**
     * Remove pasteurizacionTemperaturaPasteurizacion
     *
     * @param \Minsal\SiblhBundle\Entity\BlhTemperaturaPasteurizacion $pasteurizacionTemperaturaPasteurizacion
     */
    public function removePasteurizacionTemperaturaPasteurizacion(\Minsal\SiblhBundle\Entity\BlhTemperaturaPasteurizacion $pasteurizacionTemperaturaPasteurizacion)
    {
        $this->pasteurizacionTemperaturaPasteurizacion->removeElement($pasteurizacionTemperaturaPasteurizacion);
    }

    /**
     * Get pasteurizacionTemperaturaPasteurizacion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPasteurizacionTemperaturaPasteurizacion()
    {
        return $this->pasteurizacionTemperaturaPasteurizacion;
    }

    /**
     * Add pasteurizacionTemperaturaEnfriamiento
     *
     * @param \Minsal\SiblhBundle\Entity\BlhTemperaturaEnfriamiento $pasteurizacionTemperaturaEnfriamiento
     *
     * @return BlhPasteurizacion
     */
    public function addPasteurizacionTemperaturaEnfriamiento(\Minsal\SiblhBundle\Entity\BlhTemperaturaEnfriamiento $pasteurizacionTemperaturaEnfriamiento)
    {
        $this->pasteurizacionTemperaturaEnfriamiento[] = $pasteurizacionTemperaturaEnfriamiento;

        return $this;
    }

    /**
     * Remove pasteurizacionTemperaturaEnfriamiento
     *
     * @param \Minsal\SiblhBundle\Entity\BlhTemperaturaEnfriamiento $pasteurizacionTemperaturaEnfriamiento
     */
    public function removePasteurizacionTemperaturaEnfriamiento(\Minsal\SiblhBundle\Entity\BlhTemperaturaEnfriamiento $pasteurizacionTemperaturaEnfriamiento)
    {
        $this->pasteurizacionTemperaturaEnfriamiento->removeElement($pasteurizacionTemperaturaEnfriamiento);
    }

    /**
     * Get pasteurizacionTemperaturaEnfriamiento
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPasteurizacionTemperaturaEnfriamiento()
    {
        return $this->pasteurizacionTemperaturaEnfriamiento;
    }

    /**
     * Add pasteurizacionFrascoProcesado
     *
     * @param \Minsal\SiblhBundle\Entity\BlhFrascoProcesado $pasteurizacionFrascoProcesado
     *
     * @return BlhPasteurizacion
     */
    public function addPasteurizacionFrascoProcesado(\Minsal\SiblhBundle\Entity\BlhFrascoProcesado $pasteurizacionFrascoProcesado)
    {
        $this->pasteurizacionFrascoProcesado[] = $pasteurizacionFrascoProcesado;

        return $this;
    }

    /**
     * Remove pasteurizacionFrascoProcesado
     *
     * @param \Minsal\SiblhBundle\Entity\BlhFrascoProcesado $pasteurizacionFrascoProcesado
     */
    public function removePasteurizacionFrascoProcesado(\Minsal\SiblhBundle\Entity\BlhFrascoProcesado $pasteurizacionFrascoProcesado)
    {
        $this->pasteurizacionFrascoProcesado->removeElement($pasteurizacionFrascoProcesado);
    }

    /**
     * Get pasteurizacionFrascoProcesado
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPasteurizacionFrascoProcesado()
    {
        return $this->pasteurizacionFrascoProcesado;
    }

}
