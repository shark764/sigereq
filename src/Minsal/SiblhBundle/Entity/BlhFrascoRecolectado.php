<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhFrascoRecolectado
 *
 * @ORM\Table(name="blh_frasco_recolectado", indexes={@ORM\Index(name="fk_frasco_recolectado_lote_anal", columns={"id_lote_analisis"}), @ORM\Index(name="fk_estado_frasco_recolectado", columns={"id_estado"}), @ORM\Index(name="fk_donante_frasco_recolectado", columns={"id_donante"}), @ORM\Index(name="fk_donacion_frasco_recolectado", columns={"id_donacion"}), @ORM\Index(name="IDX_37ABF7A6D8A5832B", columns={"id_user_reg"}), @ORM\Index(name="IDX_37ABF7A67DA00A52", columns={"id_forma_extraccion"}), @ORM\Index(name="IDX_37ABF7A62DF9F9B6", columns={"id_banco_de_leche"}), @ORM\Index(name="IDX_37ABF7A68653A7AF", columns={"id_centro_recoleccion"})})
 * @ORM\Entity(repositoryClass="Minsal\SiblhBundle\Repository\BlhFrascoRecolectadoRepository")
 */
class BlhFrascoRecolectado implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_frasco_recolectado_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_frasco_recolectado", type="string", length=15, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 15,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $codigoFrascoRecolectado;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_recolectado", type="decimal", precision=7, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $volumenRecolectado;

    /**
     * @var string
     *
     * @ORM\Column(name="forma_extraccion", type="string", length=8, nullable=true)
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
    private $formaExtraccion;

    /**
     * @var string
     *
     * @ORM\Column(name="onz_recolectado", type="decimal", precision=6, scale=4, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $onzRecolectado;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion_frasco_recolectado", type="string", length=150, nullable=true)
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
    private $observacionFrascoRecolectado;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_disponible_fr", type="decimal", precision=7, scale=4, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $volumenDisponibleFr;

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
     * @ORM\Column(name="volumen_real", type="decimal", precision=7, scale=4, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $volumenReal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_reg", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaHoraReg;

    /**
     * @var boolean
     *
     * @ORM\Column(name="desechado", type="boolean", nullable=true)
     */
    private $desechado = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="descartado", type="boolean", nullable=true)
     */
    private $descartado = false;

    /**
     * @var \BlhEstado
     *
     * @ORM\ManyToOne(targetEntity="BlhEstado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado", referencedColumnName="id")
     * })
     */
    private $idEstado;

    /**
     * @var \BlhDonacion
     *
     * @ORM\ManyToOne(targetEntity="BlhDonacion", inversedBy="donacionFrascoRecolectado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_donacion", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idDonacion;

    /**
     * @var \BlhDonante
     *
     * @ORM\ManyToOne(targetEntity="BlhDonante")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_donante", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idDonante;

    /**
     * @var \BlhLoteAnalisis
     *
     * @ORM\ManyToOne(targetEntity="BlhLoteAnalisis", inversedBy="loteAnalisisFrascoRecolectado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_lote_analisis", referencedColumnName="id")
     * })
     */
    private $idLoteAnalisis;

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
     * @var \BlhCtlFormaExtraccion
     *
     * @ORM\ManyToOne(targetEntity="BlhCtlFormaExtraccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_forma_extraccion", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idFormaExtraccion;

    /**
     * @var \BlhCtlCentroRecoleccion
     *
     * @ORM\ManyToOne(targetEntity="BlhCtlCentroRecoleccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_centro_recoleccion", referencedColumnName="id")
     * })
     */
    private $idCentroRecoleccion;

    /**
     * @var \BlhBancoDeLeche
     *
     * @ORM\ManyToOne(targetEntity="BlhBancoDeLeche")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_banco_de_leche", referencedColumnName="id")
     * })
     */
    private $idBancoDeLeche;

    /**
     * @ORM\OneToMany(targetEntity="BlhAcidez", mappedBy="idFrascoRecolectado", cascade={"all"}, orphanRemoval=true)
     */
    private $frascoRecolectadoAcidez;

    /**
     * @ORM\OneToMany(targetEntity="BlhAnalisisSensorial", mappedBy="idFrascoRecolectado", cascade={"all"}, orphanRemoval=true)
     */
    private $frascoRecolectadoAnalisisSensorial;

    /**
     * @ORM\OneToMany(targetEntity="BlhCrematocrito", mappedBy="idFrascoRecolectado", cascade={"all"}, orphanRemoval=true)
     */
    private $frascoRecolectadoCrematocrito;

    /**
     * @ORM\OneToMany(targetEntity="BlhDonacionFrascoRecolectado", mappedBy="idFrascoRecolectado", cascade={"all"}, orphanRemoval=true)
     */
    private $frascoRecolectadoDonacionMezcla;

    /**
     * @ORM\OneToMany(targetEntity="BlhFrascoRecolectadoFrascoP", mappedBy="idFrascoRecolectado", cascade={"all"}, orphanRemoval=true)
     */
    private $frascoRecolectadoFrascoProcesadoCombinado;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fechaHoraReg = new \DateTime('now');
        
        $this->frascoRecolectadoAcidez = new \Doctrine\Common\Collections\ArrayCollection();
        $this->frascoRecolectadoAnalisisSensorial = new \Doctrine\Common\Collections\ArrayCollection();
        $this->frascoRecolectadoCrematocrito = new \Doctrine\Common\Collections\ArrayCollection();
        $this->frascoRecolectadoDonacionMezcla = new \Doctrine\Common\Collections\ArrayCollection();
        $this->frascoRecolectadoFrascoProcesadoCombinado = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->idDonante . ' - ' . $this->idLoteAnalisis . ' - ' . $this->volumenRecolectado;
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
     * Set codigoFrascoRecolectado
     *
     * @param string $codigoFrascoRecolectado
     *
     * @return BlhFrascoRecolectado
     */
    public function setCodigoFrascoRecolectado($codigoFrascoRecolectado)
    {
        $this->codigoFrascoRecolectado = $codigoFrascoRecolectado;

        return $this;
    }

    /**
     * Get codigoFrascoRecolectado
     *
     * @return string
     */
    public function getCodigoFrascoRecolectado()
    {
        return $this->codigoFrascoRecolectado;
    }

    /**
     * Set volumenRecolectado
     *
     * @param string $volumenRecolectado
     *
     * @return BlhFrascoRecolectado
     */
    public function setVolumenRecolectado($volumenRecolectado)
    {
        $this->volumenRecolectado = $volumenRecolectado;

        return $this;
    }

    /**
     * Get volumenRecolectado
     *
     * @return string
     */
    public function getVolumenRecolectado()
    {
        return $this->volumenRecolectado;
    }

    /**
     * Set formaExtraccion
     *
     * @param string $formaExtraccion
     *
     * @return BlhFrascoRecolectado
     */
    public function setFormaExtraccion($formaExtraccion)
    {
        $this->formaExtraccion = $formaExtraccion;

        return $this;
    }

    /**
     * Get formaExtraccion
     *
     * @return string
     */
    public function getFormaExtraccion()
    {
        return $this->formaExtraccion;
    }

    /**
     * Set onzRecolectado
     *
     * @param string $onzRecolectado
     *
     * @return BlhFrascoRecolectado
     */
    public function setOnzRecolectado($onzRecolectado)
    {
        $this->onzRecolectado = $onzRecolectado;

        return $this;
    }

    /**
     * Get onzRecolectado
     *
     * @return string
     */
    public function getOnzRecolectado()
    {
        return $this->onzRecolectado;
    }

    /**
     * Set observacionFrascoRecolectado
     *
     * @param string $observacionFrascoRecolectado
     *
     * @return BlhFrascoRecolectado
     */
    public function setObservacionFrascoRecolectado($observacionFrascoRecolectado)
    {
        $this->observacionFrascoRecolectado = $observacionFrascoRecolectado;

        return $this;
    }

    /**
     * Get observacionFrascoRecolectado
     *
     * @return string
     */
    public function getObservacionFrascoRecolectado()
    {
        return $this->observacionFrascoRecolectado;
    }

    /**
     * Set volumenDisponibleFr
     *
     * @param string $volumenDisponibleFr
     *
     * @return BlhFrascoRecolectado
     */
    public function setVolumenDisponibleFr($volumenDisponibleFr)
    {
        $this->volumenDisponibleFr = $volumenDisponibleFr;

        return $this;
    }

    /**
     * Get volumenDisponibleFr
     *
     * @return string
     */
    public function getVolumenDisponibleFr()
    {
        return $this->volumenDisponibleFr;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhFrascoRecolectado
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
     * Set volumenReal
     *
     * @param string $volumenReal
     *
     * @return BlhFrascoRecolectado
     */
    public function setVolumenReal($volumenReal)
    {
        $this->volumenReal = $volumenReal;

        return $this;
    }

    /**
     * Get volumenReal
     *
     * @return string
     */
    public function getVolumenReal()
    {
        return $this->volumenReal;
    }

    /**
     * Set fechaHoraReg
     *
     * @param \DateTime $fechaHoraReg
     *
     * @return BlhFrascoRecolectado
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
     * Set desechado
     *
     * @param boolean $desechado
     * @return BlhFrascoRecolectado
     */
    public function setDesechado($desechado)
    {
        $this->desechado = $desechado;

        return $this;
    }

    /**
     * Get desechado
     *
     * @return boolean 
     */
    public function getDesechado()
    {
        return $this->desechado;
    }

    /**
     * Set descartado
     *
     * @param boolean $descartado
     * @return BlhFrascoRecolectado
     */
    public function setDescartado($descartado)
    {
        $this->descartado = $descartado;

        return $this;
    }

    /**
     * Get descartado
     *
     * @return boolean 
     */
    public function getDescartado()
    {
        return $this->descartado;
    }

    /**
     * Set idEstado
     *
     * @param \Minsal\SiblhBundle\Entity\BlhEstado $idEstado
     *
     * @return BlhFrascoRecolectado
     */
    public function setIdEstado(\Minsal\SiblhBundle\Entity\BlhEstado $idEstado = null)
    {
        $this->idEstado = $idEstado;

        return $this;
    }

    /**
     * Get idEstado
     *
     * @return \Minsal\SiblhBundle\Entity\BlhEstado
     */
    public function getIdEstado()
    {
        return $this->idEstado;
    }

    /**
     * Set idDonacion
     *
     * @param \Minsal\SiblhBundle\Entity\BlhDonacion $idDonacion
     *
     * @return BlhFrascoRecolectado
     */
    public function setIdDonacion(\Minsal\SiblhBundle\Entity\BlhDonacion $idDonacion = null)
    {
        $this->idDonacion = $idDonacion;

        return $this;
    }

    /**
     * Get idDonacion
     *
     * @return \Minsal\SiblhBundle\Entity\BlhDonacion
     */
    public function getIdDonacion()
    {
        return $this->idDonacion;
    }

    /**
     * Set idDonante
     *
     * @param \Minsal\SiblhBundle\Entity\BlhDonante $idDonante
     *
     * @return BlhFrascoRecolectado
     */
    public function setIdDonante(\Minsal\SiblhBundle\Entity\BlhDonante $idDonante = null)
    {
        $this->idDonante = $idDonante;

        return $this;
    }

    /**
     * Get idDonante
     *
     * @return \Minsal\SiblhBundle\Entity\BlhDonante
     */
    public function getIdDonante()
    {
        return $this->idDonante;
    }

    /**
     * Set idLoteAnalisis
     *
     * @param \Minsal\SiblhBundle\Entity\BlhLoteAnalisis $idLoteAnalisis
     *
     * @return BlhFrascoRecolectado
     */
    public function setIdLoteAnalisis(\Minsal\SiblhBundle\Entity\BlhLoteAnalisis $idLoteAnalisis = null)
    {
        $this->idLoteAnalisis = $idLoteAnalisis;

        return $this;
    }

    /**
     * Get idLoteAnalisis
     *
     * @return \Minsal\SiblhBundle\Entity\BlhLoteAnalisis
     */
    public function getIdLoteAnalisis()
    {
        return $this->idLoteAnalisis;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     *
     * @return BlhFrascoRecolectado
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
     * Set idFormaExtraccion
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCtlFormaExtraccion $idFormaExtraccion
     *
     * @return BlhFrascoRecolectado
     */
    public function setIdFormaExtraccion(\Minsal\SiblhBundle\Entity\BlhCtlFormaExtraccion $idFormaExtraccion = null)
    {
        $this->idFormaExtraccion = $idFormaExtraccion;

        return $this;
    }

    /**
     * Get idFormaExtraccion
     *
     * @return \Minsal\SiblhBundle\Entity\BlhCtlFormaExtraccion
     */
    public function getIdFormaExtraccion()
    {
        return $this->idFormaExtraccion;
    }

    /**
     * Set idBancoDeLeche
     *
     * @param \Minsal\SiblhBundle\Entity\BlhBancoDeLeche $idBancoDeLeche
     *
     * @return BlhFrascoRecolectado
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
     * Set idCentroRecoleccion
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCtlCentroRecoleccion $idCentroRecoleccion
     *
     * @return BlhFrascoRecolectado
     */
    public function setIdCentroRecoleccion(\Minsal\SiblhBundle\Entity\BlhCtlCentroRecoleccion $idCentroRecoleccion = null)
    {
        $this->idCentroRecoleccion = $idCentroRecoleccion;

        return $this;
    }

    /**
     * Get idCentroRecoleccion
     *
     * @return \Minsal\SiblhBundle\Entity\BlhCtlCentroRecoleccion
     */
    public function getIdCentroRecoleccion()
    {
        return $this->idCentroRecoleccion;
    }

    /**
     * Add frascoRecolectadoAcidez
     *
     * @param \Minsal\SiblhBundle\Entity\BlhAcidez $frascoRecolectadoAcidez
     *
     * @return BlhFrascoRecolectado
     */
    public function addFrascoRecolectadoAcidez(\Minsal\SiblhBundle\Entity\BlhAcidez $frascoRecolectadoAcidez)
    {
        $this->frascoRecolectadoAcidez[] = $frascoRecolectadoAcidez;

        return $this;
    }

    /**
     * Remove frascoRecolectadoAcidez
     *
     * @param \Minsal\SiblhBundle\Entity\BlhAcidez $frascoRecolectadoAcidez
     */
    public function removeFrascoRecolectadoAcidez(\Minsal\SiblhBundle\Entity\BlhAcidez $frascoRecolectadoAcidez)
    {
        $this->frascoRecolectadoAcidez->removeElement($frascoRecolectadoAcidez);
    }

    /**
     * Get frascoRecolectadoAcidez
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFrascoRecolectadoAcidez()
    {
        return $this->frascoRecolectadoAcidez;
    }

    /**
     * Add frascoRecolectadoAnalisisSensorial
     *
     * @param \Minsal\SiblhBundle\Entity\BlhAnalisisSensorial $frascoRecolectadoAnalisisSensorial
     *
     * @return BlhFrascoRecolectado
     */
    public function addFrascoRecolectadoAnalisisSensorial(\Minsal\SiblhBundle\Entity\BlhAnalisisSensorial $frascoRecolectadoAnalisisSensorial)
    {
        $this->frascoRecolectadoAnalisisSensorial[] = $frascoRecolectadoAnalisisSensorial;

        return $this;
    }

    /**
     * Remove frascoRecolectadoAnalisisSensorial
     *
     * @param \Minsal\SiblhBundle\Entity\BlhAnalisisSensorial $frascoRecolectadoAnalisisSensorial
     */
    public function removeFrascoRecolectadoAnalisisSensorial(\Minsal\SiblhBundle\Entity\BlhAnalisisSensorial $frascoRecolectadoAnalisisSensorial)
    {
        $this->frascoRecolectadoAnalisisSensorial->removeElement($frascoRecolectadoAnalisisSensorial);
    }

    /**
     * Get frascoRecolectadoAnalisisSensorial
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFrascoRecolectadoAnalisisSensorial()
    {
        return $this->frascoRecolectadoAnalisisSensorial;
    }

    /**
     * Add frascoRecolectadoCrematocrito
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCrematocrito $frascoRecolectadoCrematocrito
     *
     * @return BlhFrascoRecolectado
     */
    public function addFrascoRecolectadoCrematocrito(\Minsal\SiblhBundle\Entity\BlhCrematocrito $frascoRecolectadoCrematocrito)
    {
        $this->frascoRecolectadoCrematocrito[] = $frascoRecolectadoCrematocrito;

        return $this;
    }

    /**
     * Remove frascoRecolectadoCrematocrito
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCrematocrito $frascoRecolectadoCrematocrito
     */
    public function removeFrascoRecolectadoCrematocrito(\Minsal\SiblhBundle\Entity\BlhCrematocrito $frascoRecolectadoCrematocrito)
    {
        $this->frascoRecolectadoCrematocrito->removeElement($frascoRecolectadoCrematocrito);
    }

    /**
     * Get frascoRecolectadoCrematocrito
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFrascoRecolectadoCrematocrito()
    {
        return $this->frascoRecolectadoCrematocrito;
    }

    /**
     * Add frascoRecolectadoDonacionMezcla
     *
     * @param \Minsal\SiblhBundle\Entity\BlhDonacionFrascoRecolectado $frascoRecolectadoDonacionMezcla
     *
     * @return BlhFrascoRecolectado
     */
    public function addFrascoRecolectadoDonacionMezcla(\Minsal\SiblhBundle\Entity\BlhDonacionFrascoRecolectado $frascoRecolectadoDonacionMezcla)
    {
        $this->frascoRecolectadoDonacionMezcla[] = $frascoRecolectadoDonacionMezcla;

        return $this;
    }

    /**
     * Remove frascoRecolectadoDonacionMezcla
     *
     * @param \Minsal\SiblhBundle\Entity\BlhDonacionFrascoRecolectado $frascoRecolectadoDonacionMezcla
     */
    public function removeFrascoRecolectadoDonacionMezcla(\Minsal\SiblhBundle\Entity\BlhDonacionFrascoRecolectado $frascoRecolectadoDonacionMezcla)
    {
        $this->frascoRecolectadoDonacionMezcla->removeElement($frascoRecolectadoDonacionMezcla);
    }

    /**
     * Get frascoRecolectadoDonacionMezcla
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFrascoRecolectadoDonacionMezcla()
    {
        return $this->frascoRecolectadoDonacionMezcla;
    }

    /**
     * Add frascoRecolectadoFrascoProcesadoCombinado
     *
     * @param \Minsal\SiblhBundle\Entity\BlhFrascoRecolectadoFrascoP $frascoRecolectadoFrascoProcesadoCombinado
     *
     * @return BlhFrascoRecolectado
     */
    public function addFrascoRecolectadoFrascoProcesadoCombinado(\Minsal\SiblhBundle\Entity\BlhFrascoRecolectadoFrascoP $frascoRecolectadoFrascoProcesadoCombinado)
    {
        $this->frascoRecolectadoFrascoProcesadoCombinado[] = $frascoRecolectadoFrascoProcesadoCombinado;

        return $this;
    }

    /**
     * Remove frascoRecolectadoFrascoProcesadoCombinado
     *
     * @param \Minsal\SiblhBundle\Entity\BlhFrascoRecolectadoFrascoP $frascoRecolectadoFrascoProcesadoCombinado
     */
    public function removeFrascoRecolectadoFrascoProcesadoCombinado(\Minsal\SiblhBundle\Entity\BlhFrascoRecolectadoFrascoP $frascoRecolectadoFrascoProcesadoCombinado)
    {
        $this->frascoRecolectadoFrascoProcesadoCombinado->removeElement($frascoRecolectadoFrascoProcesadoCombinado);
    }

    /**
     * Get frascoRecolectadoFrascoProcesadoCombinado
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFrascoRecolectadoFrascoProcesadoCombinado()
    {
        return $this->frascoRecolectadoFrascoProcesadoCombinado;
    }

}
