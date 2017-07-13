<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhDonacion
 *
 * @ORM\Table(name="blh_donacion", indexes={@ORM\Index(name="fk_banco_de_leche_donacion", columns={"id_banco_de_leche"}), @ORM\Index(name="IDX_13A0CBCB8653A7AF", columns={"id_centro_recoleccion"}), @ORM\Index(name="IDX_13A0CBCB54F03532", columns={"id_donante"}), @ORM\Index(name="IDX_13A0CBCBD8A5832B", columns={"id_user_reg"}), @ORM\Index(name="IDX_13A0CBCBD4737338", columns={"id_responsable_donacion"}), @ORM\Index(name="IDX_13A0CBCB85E56563", columns={"id_tipo_colecta"})})
 * @ORM\Entity
 */
class BlhDonacion implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_donacion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_donante", type="string", length=15, nullable=true)
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
    private $codigoDonante;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_donacion", type="date", nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Date()
     */
    private $fechaDonacion;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_donacion", type="string", length=60, nullable=false)
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
    private $responsableDonacion;

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
     * @var \BlhCtlCentroRecoleccion
     *
     * @ORM\ManyToOne(targetEntity="BlhCtlCentroRecoleccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_centro_recoleccion", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idCentroRecoleccion;

    /**
     * @var \BlhDonante
     *
     * @ORM\ManyToOne(targetEntity="BlhDonante", inversedBy="donanteDonaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_donante", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idDonante;

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
     *   @ORM\JoinColumn(name="id_responsable_donacion", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idResponsableDonacion;

    /**
     * @var \BlhCtlTipoColecta
     *
     * @ORM\ManyToOne(targetEntity="BlhCtlTipoColecta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_colecta", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idTipoColecta;

    /**
     * @ORM\OneToMany(targetEntity="BlhFrascoRecolectado", mappedBy="idDonacion", cascade={"all"}, orphanRemoval=true)
     */
    private $donacionFrascoRecolectado;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fechaDonacion = new \DateTime('now');
        $this->fechaHoraReg = new \DateTime('now');
        
        $this->donacionFrascoRecolectado = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->idBancoDeLeche . ' - ' . $this->idDonante . ' - ' . $this->codigoDonante;
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
     * Set codigoDonante
     *
     * @param string $codigoDonante
     *
     * @return BlhDonacion
     */
    public function setCodigoDonante($codigoDonante)
    {
        $this->codigoDonante = $codigoDonante;

        return $this;
    }

    /**
     * Get codigoDonante
     *
     * @return string
     */
    public function getCodigoDonante()
    {
        return $this->codigoDonante;
    }

    /**
     * Set fechaDonacion
     *
     * @param \DateTime $fechaDonacion
     *
     * @return BlhDonacion
     */
    public function setFechaDonacion($fechaDonacion)
    {
        $this->fechaDonacion = $fechaDonacion;

        return $this;
    }

    /**
     * Get fechaDonacion
     *
     * @return \DateTime
     */
    public function getFechaDonacion()
    {
        return $this->fechaDonacion;
    }

    /**
     * Set responsableDonacion
     *
     * @param string $responsableDonacion
     *
     * @return BlhDonacion
     */
    public function setResponsableDonacion($responsableDonacion)
    {
        $this->responsableDonacion = $responsableDonacion;

        return $this;
    }

    /**
     * Get responsableDonacion
     *
     * @return string
     */
    public function getResponsableDonacion()
    {
        return $this->responsableDonacion;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return BlhDonacion
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
     * @return BlhDonacion
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
     * Set idCentroRecoleccion
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCtlCentroRecoleccion $idCentroRecoleccion
     *
     * @return BlhDonacion
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
     * Set idDonante
     *
     * @param \Minsal\SiblhBundle\Entity\BlhDonante $idDonante
     *
     * @return BlhDonacion
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
     * Set idBancoDeLeche
     *
     * @param \Minsal\SiblhBundle\Entity\BlhBancoDeLeche $idBancoDeLeche
     *
     * @return BlhDonacion
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
     * Set idUserReg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idUserReg
     *
     * @return BlhDonacion
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
     * Add donacionFrascoRecolectado
     *
     * @param \Minsal\SiblhBundle\Entity\BlhFrascoRecolectado $donacionFrascoRecolectado
     *
     * @return BlhDonacion
     */
    public function addDonacionFrascoRecolectado(\Minsal\SiblhBundle\Entity\BlhFrascoRecolectado $donacionFrascoRecolectado)
    {
        $this->donacionFrascoRecolectado[] = $donacionFrascoRecolectado;

        return $this;
    }

    /**
     * Remove donacionFrascoRecolectado
     *
     * @param \Minsal\SiblhBundle\Entity\BlhFrascoRecolectado $donacionFrascoRecolectado
     */
    public function removeDonacionFrascoRecolectado(\Minsal\SiblhBundle\Entity\BlhFrascoRecolectado $donacionFrascoRecolectado)
    {
        $this->donacionFrascoRecolectado->removeElement($donacionFrascoRecolectado);
    }

    /**
     * Get donacionFrascoRecolectado
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDonacionFrascoRecolectado()
    {
        return $this->donacionFrascoRecolectado;
    }

    /**
     * Set idResponsableDonacion
     *
     * @param \Minsal\SiapsBundle\Entity\MntEmpleado $idResponsableDonacion
     *
     * @return BlhDonacion
     */
    public function setIdResponsableDonacion(\Minsal\SiapsBundle\Entity\MntEmpleado $idResponsableDonacion = null)
    {
        $this->idResponsableDonacion = $idResponsableDonacion;

        return $this;
    }

    /**
     * Get idResponsableDonacion
     *
     * @return \Minsal\SiapsBundle\Entity\MntEmpleado
     */
    public function getIdResponsableDonacion()
    {
        return $this->idResponsableDonacion;
    }

    /**
     * Set idTipoColecta
     *
     * @param \Minsal\SiblhBundle\Entity\BlhCtlTipoColecta $idTipoColecta
     *
     * @return BlhDonante
     */
    public function setIdTipoColecta(\Minsal\SiblhBundle\Entity\BlhCtlTipoColecta $idTipoColecta = null)
    {
        $this->idTipoColecta = $idTipoColecta;

        return $this;
    }

    /**
     * Get idTipoColecta
     *
     * @return \Minsal\SiblhBundle\Entity\BlhCtlTipoColecta
     */
    public function getIdTipoColecta()
    {
        return $this->idTipoColecta;
    }

}