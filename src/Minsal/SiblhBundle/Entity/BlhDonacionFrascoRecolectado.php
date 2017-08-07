<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhDonacionFrascoRecolectado
 *
 * @ORM\Table(name="blh_donacion_frasco_recolectado", uniqueConstraints={@ORM\UniqueConstraint(name="idx_blh_donacion_frasco_recolectado", columns={"id_donacion", "id_frasco_recolectado"})}, indexes={@ORM\Index(name="IDX_E98D43ACF00213", columns={"id_donacion"}), @ORM\Index(name="IDX_E98D43EC124187", columns={"id_frasco_recolectado"})})
 * @ORM\Entity
 */
class BlhDonacionFrascoRecolectado implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_donacion_frasco_recolectado_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_agregado", type="decimal", precision=7, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $volumenAgregado = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_real_agregado", type="decimal", precision=7, scale=4, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Range(
     *      min = 0,
     *      max = 2147483647,
     *      minMessage = "Número no puede ser inferior a {{ limit }}",
     *      maxMessage = "Número no puede ser superior a {{ limit }}"
     * )
     */
    private $volumenRealAgregado = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_mezcla", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaMezcla;

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
     * @var \BlhDonacion
     *
     * @ORM\ManyToOne(targetEntity="BlhDonacion", inversedBy="donacionFrascoRecolectadoMezcla")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_donacion", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idDonacion;

    /**
     * @var \BlhFrascoRecolectado
     *
     * @ORM\ManyToOne(targetEntity="BlhFrascoRecolectado", inversedBy="frascoRecolectadoDonacionMezcla")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_frasco_recolectado", referencedColumnName="id")
     * })
     * @Assert\NotNull(message = "foreign.default.not_null")
     */
    private $idFrascoRecolectado;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fechaMezcla = new \DateTime('now');
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->idDonacion . ' - ' . $this->idFrascoRecolectado . ' - ' . $this->volumenAgregado;
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
     * Set volumenAgregado
     *
     * @param string $volumenAgregado
     *
     * @return BlhDonacionFrascoRecolectado
     */
    public function setVolumenAgregado($volumenAgregado)
    {
        $this->volumenAgregado = $volumenAgregado;

        return $this;
    }

    /**
     * Get volumenAgregado
     *
     * @return string
     */
    public function getVolumenAgregado()
    {
        return $this->volumenAgregado;
    }

    /**
     * Set volumenRealAgregado
     *
     * @param string $volumenRealAgregado
     *
     * @return BlhDonacionFrascoRecolectado
     */
    public function setVolumenRealAgregado($volumenRealAgregado)
    {
        $this->volumenRealAgregado = $volumenRealAgregado;

        return $this;
    }

    /**
     * Get volumenRealAgregado
     *
     * @return string
     */
    public function getVolumenRealAgregado()
    {
        return $this->volumenRealAgregado;
    }

    /**
     * Set idDonacion
     *
     * @param \Minsal\SiblhBundle\Entity\BlhDonacion $idDonacion
     *
     * @return BlhDonacionFrascoRecolectado
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
     * Set idFrascoRecolectado
     *
     * @param \Minsal\SiblhBundle\Entity\BlhFrascoRecolectado $idFrascoRecolectado
     *
     * @return BlhDonacionFrascoRecolectado
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
     * Set fechaMezcla
     *
     * @param \DateTime $fechaMezcla
     *
     * @return BlhDonacionFrascoRecolectado
     */
    public function setFechaMezcla($fechaMezcla)
    {
        $this->fechaMezcla = $fechaMezcla;

        return $this;
    }

    /**
     * Get fechaMezcla
     *
     * @return \DateTime
     */
    public function getFechaMezcla()
    {
        return $this->fechaMezcla;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     *
     * @return BlhDonacionFrascoRecolectado
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

}