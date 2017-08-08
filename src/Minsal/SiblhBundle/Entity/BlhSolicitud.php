<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhSolicitud
 *
 * @ORM\Table(name="blh_solicitud", indexes={@ORM\Index(name="fk_grupo_solicitud_solicitud", columns={"id_grupo_solicitud"}), @ORM\Index(name="IDX_9E50CAC8B91944F2", columns={"id_receptor"}), @ORM\Index(name="IDX_9E50CAC8D8A5832B", columns={"id_user_reg"}), @ORM\Index(name="IDX_9E50CAC8BA23BAD6", columns={"id_responsable_solicitud"}), @ORM\Index(name="IDX_9E50CAC8C9232A1C", columns={"id_acidez_necesaria"}), @ORM\Index(name="IDX_9E50CAC8AE5F7773", columns={"id_calorias_necesarias"}), @ORM\Index(name="IDX_9E50CAC82DF9F9B6", columns={"id_banco_de_leche"})})
 * @ORM\Entity
 */
class BlhSolicitud implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_solicitud_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_solicitud", type="string", length=14, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 14,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $codigoSolicitud;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_por_dia", type="decimal", precision=7, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $volumenPorDia;

    /**
     * @var string
     *
     * @ORM\Column(name="acidez_necesaria", type="string", length=9, nullable=true)
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
    private $acidezNecesaria;

    /**
     * @var string
     *
     * @ORM\Column(name="calorias_necesarias", type="string", length=15, nullable=true)
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
    private $caloriasNecesarias;

    /**
     * @var string
     *
     * @ORM\Column(name="peso_dia", type="decimal", precision=8, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $pesoDia;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_por_toma", type="decimal", precision=7, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $volumenPorToma;

    /**
     * @var integer
     *
     * @ORM\Column(name="toma_por_dia", type="integer", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $tomaPorDia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solicitud", type="date", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Date()
     */
    private $fechaSolicitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="cuna", type="integer", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $cuna;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=10, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 10,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=60, nullable=true)
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
    private $responsable;

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
     * @var \BlhReceptor
     *
     * @ORM\ManyToOne(targetEntity="BlhReceptor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_receptor", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idReceptor;

    /**
     * @var \BlhGrupoSolicitud
     *
     * @ORM\ManyToOne(targetEntity="BlhGrupoSolicitud", inversedBy="grupoSolicitudes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grupo_solicitud", referencedColumnName="id")
     * })
     */
    private $idGrupoSolicitud;

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
     *   @ORM\JoinColumn(name="id_responsable_solicitud", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idResponsableSolicitud;

    /**
     * @var \BlhCtlAcidezDornic
     *
     * @ORM\ManyToOne(targetEntity="BlhCtlAcidezDornic")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_acidez_necesaria", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idAcidezNecesaria;

    /**
     * @var \BlhCtlCaloria
     *
     * @ORM\ManyToOne(targetEntity="BlhCtlCaloria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_calorias_necesarias", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idCaloriasNecesarias;

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
     * Constructor
     */
    public function __construct()
    {
        $this->fechaSolicitud = new \DateTime('now');
        $this->fechaHoraReg = new \DateTime('now');
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->codigoSolicitud . ' - ' . $this->idGrupoSolicitud;
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
     * Set codigoSolicitud
     *
     * @param string $codigoSolicitud
     *
     * @return BlhSolicitud
     */
    public function setCodigoSolicitud($codigoSolicitud)
    {
        $this->codigoSolicitud = $codigoSolicitud;

        return $this;
    }

    /**
     * Get codigoSolicitud
     *
     * @return string
     */
    public function getCodigoSolicitud()
    {
        return $this->codigoSolicitud;
    }

    /**
     * Set volumenPorDia
     *
     * @param string $volumenPorDia
     *
     * @return BlhSolicitud
     */
    public function setVolumenPorDia($volumenPorDia)
    {
        $this->volumenPorDia = $volumenPorDia;

        return $this;
    }

    /**
     * Get volumenPorDia
     *
     * @return string
     */
    public function getVolumenPorDia()
    {
        return $this->volumenPorDia;
    }

    /**
     * Set acidezNecesaria
     *
     * @param string $acidezNecesaria
     *
     * @return BlhSolicitud
     */
    public function setAcidezNecesaria($acidezNecesaria)
    {
        $this->acidezNecesaria = $acidezNecesaria;

        return $this;
    }

    /**
     * Get acidezNecesaria
     *
     * @return string
     */
    public function getAcidezNecesaria()
    {
        return $this->acidezNecesaria;
    }

    /**
     * Set caloriasNecesarias
     *
     * @param string $caloriasNecesarias
     *
     * @return BlhSolicitud
     */
    public function setCaloriasNecesarias($caloriasNecesarias)
    {
        $this->caloriasNecesarias = $caloriasNecesarias;

        return $this;
    }

    /**
     * Get caloriasNecesarias
     *
     * @return string
     */
    public function getCaloriasNecesarias()
    {
        return $this->caloriasNecesarias;
    }

    /**
     * Set pesoDia
     *
     * @param string $pesoDia
     *
     * @return BlhSolicitud
     */
    public function setPesoDia($pesoDia)
    {
        $this->pesoDia = $pesoDia;

        return $this;
    }

    /**
     * Get pesoDia
     *
     * @return string
     */
    public function getPesoDia()
    {
        return $this->pesoDia;
    }

    /**
     * Set volumenPorToma
     *
     * @param string $volumenPorToma
     *
     * @return BlhSolicitud
     */
    public function setVolumenPorToma($volumenPorToma)
    {
        $this->volumenPorToma = $volumenPorToma;

        return $this;
    }

    /**
     * Get volumenPorToma
     *
     * @return string
     */
    public function getVolumenPorToma()
    {
        return $this->volumenPorToma;
    }

    /**
     * Set tomaPorDia
     *
     * @param integer $tomaPorDia
     *
     * @return BlhSolicitud
     */
    public function setTomaPorDia($tomaPorDia)
    {
        $this->tomaPorDia = $tomaPorDia;

        return $this;
    }

    /**
     * Get tomaPorDia
     *
     * @return integer
     */
    public function getTomaPorDia()
    {
        return $this->tomaPorDia;
    }

    /**
     * Set fechaSolicitud
     *
     * @param \DateTime $fechaSolicitud
     *
     * @return BlhSolicitud
     */
    public function setFechaSolicitud($fechaSolicitud)
    {
        $this->fechaSolicitud = $fechaSolicitud;

        return $this;
    }

    /**
     * Get fechaSolicitud
     *
     * @return \DateTime
     */
    public function getFechaSolicitud()
    {
        return $this->fechaSolicitud;
    }

    /**
     * Set cuna
     *
     * @param integer $cuna
     *
     * @return BlhSolicitud
     */
    public function setCuna($cuna)
    {
        $this->cuna = $cuna;

        return $this;
    }

    /**
     * Get cuna
     *
     * @return integer
     */
    public function getCuna()
    {
        return $this->cuna;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return BlhSolicitud
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set responsable
     *
     * @param string $responsable
     *
     * @return BlhSolicitud
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return string
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhSolicitud
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
     * @return BlhSolicitud
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
     * Set idReceptor
     *
     * @param \Minsal\SiblhBundle\Entity\BlhReceptor $idReceptor
     *
     * @return BlhSolicitud
     */
    public function setIdReceptor(\Minsal\SiblhBundle\Entity\BlhReceptor $idReceptor = null)
    {
        $this->idReceptor = $idReceptor;

        return $this;
    }

    /**
     * Get idReceptor
     *
     * @return \Minsal\SiblhBundle\Entity\BlhReceptor
     */
    public function getIdReceptor()
    {
        return $this->idReceptor;
    }

    /**
     * Set idGrupoSolicitud
     *
     * @param \Minsal\SiblhBundle\Entity\BlhGrupoSolicitud $idGrupoSolicitud
     *
     * @return BlhSolicitud
     */
    public function setIdGrupoSolicitud(\Minsal\SiblhBundle\Entity\BlhGrupoSolicitud $idGrupoSolicitud = null)
    {
        $this->idGrupoSolicitud = $idGrupoSolicitud;

        return $this;
    }

    /**
     * Get idGrupoSolicitud
     *
     * @return \Minsal\SiblhBundle\Entity\BlhGrupoSolicitud
     */
    public function getIdGrupoSolicitud()
    {
        return $this->idGrupoSolicitud;
    }

    /**
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     *
     * @return BlhSolicitud
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
     * Set idResponsableSolicitud
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idResponsableSolicitud
     *
     * @return BlhSolicitud
     */
    public function setIdResponsableSolicitud(\Minsal\SiapsBundle\Entity\MntEmpleado $idResponsableSolicitud = null)
    {
        $this->idResponsableSolicitud = $idResponsableSolicitud;

        return $this;
    }

    /**
     * Get idResponsableSolicitud
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado
     */
    public function getIdResponsableSolicitud()
    {
        return $this->idResponsableSolicitud;
    }

    /**
     * Set idAcidezNecesaria
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCtlAcidezDornic $idAcidezNecesaria
     *
     * @return BlhSolicitud
     */
    public function setIdAcidezNecesaria(\Minsal\SiblhBundle\Entity\BlhCtlAcidezDornic $idAcidezNecesaria = null)
    {
        $this->idAcidezNecesaria = $idAcidezNecesaria;

        return $this;
    }

    /**
     * Get idAcidezNecesaria
     *
     * @return \Minsal\SiblhBundle\Entity\BlhCtlAcidezDornic
     */
    public function getIdAcidezNecesaria()
    {
        return $this->idAcidezNecesaria;
    }

    /**
     * Set idCaloriasNecesarias
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCtlCaloria $idCaloriasNecesarias
     *
     * @return BlhSolicitud
     */
    public function setIdCaloriasNecesarias(\Minsal\SiblhBundle\Entity\BlhCtlCaloria $idCaloriasNecesarias = null)
    {
        $this->idCaloriasNecesarias = $idCaloriasNecesarias;

        return $this;
    }

    /**
     * Get idCaloriasNecesarias
     *
     * @return \Minsal\SiblhBundle\Entity\BlhCtlCaloria
     */
    public function getIdCaloriasNecesarias()
    {
        return $this->idCaloriasNecesarias;
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

}