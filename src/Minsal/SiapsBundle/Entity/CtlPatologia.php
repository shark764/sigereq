<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
// use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * CtlPatologia
 *
 * @ORM\Table(name="ctl_patologia", indexes={@ORM\Index(name="fki_patologia_patologia", columns={"id_patologia_padre"}), @ORM\Index(name="fki_tipo_patologia_patologia", columns={"id_tipo_patologia"})})
 * @ORM\Entity
 */
class CtlPatologia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_patologia_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 100,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $nombre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="notificacion", type="boolean", nullable=false)
     */
    private $notificacion = false;

    /**
     * @var \CtlPatologia
     *
     * @ORM\ManyToOne(targetEntity="CtlPatologia", inversedBy="patologiaSubPatologias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_patologia_padre", referencedColumnName="id")
     * })
     */
    private $idPatologiaPadre;

    /**
     * @var \CtlTipoPatologia
     *
     * @ORM\ManyToOne(targetEntity="CtlTipoPatologia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_patologia", referencedColumnName="id")
     * })
     */
    private $idTipoPatologia;

    /**
     * @ORM\OneToMany(targetEntity="CtlPatologia", mappedBy="idPatologiaPadre", cascade={"all"}, orphanRemoval=true)
     */
    private $patologiaSubPatologias;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->patologiaSubPatologias = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return CtlPatologia
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
     * Set notificacion
     *
     * @param boolean $notificacion
     *
     * @return CtlPatologia
     */
    public function setNotificacion($notificacion)
    {
        $this->notificacion = $notificacion;

        return $this;
    }

    /**
     * Get notificacion
     *
     * @return boolean
     */
    public function getNotificacion()
    {
        return $this->notificacion;
    }

    /**
     * Set idPatologiaPadre
     *
     * @param \Minsal\SiapsBundle\Entity\CtlPatologia $idPatologiaPadre
     *
     * @return CtlPatologia
     */
    public function setIdPatologiaPadre(\Minsal\SiapsBundle\Entity\CtlPatologia $idPatologiaPadre = null)
    {
        $this->idPatologiaPadre = $idPatologiaPadre;

        return $this;
    }

    /**
     * Get idPatologiaPadre
     *
     * @return \Minsal\SiapsBundle\Entity\CtlPatologia
     */
    public function getIdPatologiaPadre()
    {
        return $this->idPatologiaPadre;
    }

    /**
     * Set idTipoPatologia
     *
     * @param \Minsal\SiapsBundle\Entity\CtlTipoPatologia $idTipoPatologia
     *
     * @return CtlPatologia
     */
    public function setIdTipoPatologia(\Minsal\SiapsBundle\Entity\CtlTipoPatologia $idTipoPatologia = null)
    {
        $this->idTipoPatologia = $idTipoPatologia;

        return $this;
    }

    /**
     * Get idTipoPatologia
     *
     * @return \Minsal\SiapsBundle\Entity\CtlTipoPatologia
     */
    public function getIdTipoPatologia()
    {
        return $this->idTipoPatologia;
    }

    /**
     * Add patologiaSubPatologia
     *
     * @param \Minsal\SiapsBundle\Entity\CtlPatologia $patologiaSubPatologia
     *
     * @return CtlPatologia
     */
    public function addPatologiaSubPatologia(\Minsal\SiapsBundle\Entity\CtlPatologia $patologiaSubPatologia)
    {
        $this->patologiaSubPatologias[] = $patologiaSubPatologia;

        return $this;
    }

    /**
     * Remove patologiaSubPatologia
     *
     * @param \Minsal\SiapsBundle\Entity\CtlPatologia $patologiaSubPatologia
     */
    public function removePatologiaSubPatologia(\Minsal\SiapsBundle\Entity\CtlPatologia $patologiaSubPatologia)
    {
        $this->patologiaSubPatologias->removeElement($patologiaSubPatologia);
    }

    /**
     * Get patologiaSubPatologias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPatologiaSubPatologias()
    {
        return $this->patologiaSubPatologias;
    }

}
