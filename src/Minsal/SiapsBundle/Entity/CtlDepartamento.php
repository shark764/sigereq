<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
// use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * CtlDepartamento
 *
 * @ORM\Table(name="ctl_departamento", indexes={@ORM\Index(name="IDX_C3F1602B24308A3B", columns={"id_establecimiento_region"}), @ORM\Index(name="IDX_C3F1602BF57D32FD", columns={"id_pais"})})
 * @ORM\Entity
 */
class CtlDepartamento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_departamento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

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
     * @var string
     *
     * @ORM\Column(name="codigo_cnr", type="string", length=5, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 5,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $codigoCnr;

    /**
     * @var string
     *
     * @ORM\Column(name="abreviatura", type="string", length=5, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 5,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $abreviatura;

    /**
     * @var string
     *
     * @ORM\Column(name="iso31662", type="string", length=5, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 5,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $iso31662;

    /**
     * @var \CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento_region", referencedColumnName="id")
     * })
     */
    private $idEstablecimientoRegion;

    /**
     * @var \CtlPais
     *
     * @ORM\ManyToOne(targetEntity="CtlPais", inversedBy="paisDepartamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pais", referencedColumnName="id")
     * })
     */
    private $idPais;

    /**
     * @ORM\OneToMany(targetEntity="CtlMunicipio", mappedBy="idDepartamento", cascade={"all"}, orphanRemoval=true)
     */
    private $departamentoMunicipio;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->departamentoMunicipio = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->nombre ? : '';
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return CtlDepartamento
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
     * Set codigoCnr
     *
     * @param string $codigoCnr
     *
     * @return CtlDepartamento
     */
    public function setCodigoCnr($codigoCnr)
    {
        $this->codigoCnr = $codigoCnr;

        return $this;
    }

    /**
     * Get codigoCnr
     *
     * @return string
     */
    public function getCodigoCnr()
    {
        return $this->codigoCnr;
    }

    /**
     * Set abreviatura
     *
     * @param string $abreviatura
     *
     * @return CtlDepartamento
     */
    public function setAbreviatura($abreviatura)
    {
        $this->abreviatura = $abreviatura;

        return $this;
    }

    /**
     * Get abreviatura
     *
     * @return string
     */
    public function getAbreviatura()
    {
        return $this->abreviatura;
    }

    /**
     * Set iso31662
     *
     * @param string $iso31662
     *
     * @return CtlDepartamento
     */
    public function setIso31662($iso31662)
    {
        $this->iso31662 = $iso31662;

        return $this;
    }

    /**
     * Get iso31662
     *
     * @return string
     */
    public function getIso31662()
    {
        return $this->iso31662;
    }

    /**
     * Set idEstablecimientoRegion
     *
     * @param \Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoRegion
     *
     * @return CtlDepartamento
     */
    public function setIdEstablecimientoRegion(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimientoRegion = null)
    {
        $this->idEstablecimientoRegion = $idEstablecimientoRegion;

        return $this;
    }

    /**
     * Get idEstablecimientoRegion
     *
     * @return \Minsal\SiapsBundle\Entity\CtlEstablecimiento
     */
    public function getIdEstablecimientoRegion()
    {
        return $this->idEstablecimientoRegion;
    }

    /**
     * Set idPais
     *
     * @param \Minsal\SiapsBundle\Entity\CtlPais $idPais
     *
     * @return CtlDepartamento
     */
    public function setIdPais(\Minsal\SiapsBundle\Entity\CtlPais $idPais = null)
    {
        $this->idPais = $idPais;

        return $this;
    }

    /**
     * Get idPais
     *
     * @return \Minsal\SiapsBundle\Entity\CtlPais
     */
    public function getIdPais()
    {
        return $this->idPais;
    }

    /**
     * Add departamentoMunicipio
     *
     * @param \Minsal\SiapsBundle\Entity\CtlMunicipio $departamentoMunicipio
     *
     * @return CtlDepartamento
     */
    public function addDepartamentoMunicipio(\Minsal\SiapsBundle\Entity\CtlMunicipio $departamentoMunicipio)
    {
        $this->departamentoMunicipio[] = $departamentoMunicipio;

        return $this;
    }

    /**
     * Remove departamentoMunicipio
     *
     * @param \Minsal\SiapsBundle\Entity\CtlMunicipio $departamentoMunicipio
     */
    public function removeDepartamentoMunicipio(\Minsal\SiapsBundle\Entity\CtlMunicipio $departamentoMunicipio)
    {
        $this->departamentoMunicipio->removeElement($departamentoMunicipio);
    }

    /**
     * Get departamentoMunicipio
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepartamentoMunicipio()
    {
        return $this->departamentoMunicipio;
    }

}
