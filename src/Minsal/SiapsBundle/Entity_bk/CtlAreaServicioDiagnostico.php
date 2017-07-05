<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlAreaServicioDiagnostico
 *
 * @ORM\Table(name="ctl_area_servicio_diagnostico", indexes={@ORM\Index(name="IDX_C44C3A31695EA351", columns={"id_atencion"}), @ORM\Index(name="IDX_C44C3A316724C8DC", columns={"idusuariomod"}), @ORM\Index(name="IDX_C44C3A3113B895A1", columns={"idusuarioreg"})})
 * @ORM\Entity
 */
class CtlAreaServicioDiagnostico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_area_servicio_diagnostico_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="idarea", type="string", length=4, nullable=false)
     */
    private $idarea;

    /**
     * @var string
     *
     * @ORM\Column(name="nombrearea", type="string", length=75, nullable=true)
     */
    private $nombrearea;

    /**
     * @var string
     *
     * @ORM\Column(name="administrativa", type="string", nullable=true)
     */
    private $administrativa = 'N';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahorareg", type="datetime", nullable=true)
     */
    private $fechahorareg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahoramod", type="datetime", nullable=true)
     */
    private $fechahoramod;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var \CtlAtencion
     *
     * @ORM\ManyToOne(targetEntity="CtlAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_atencion", referencedColumnName="id")
     * })
     */
    private $idAtencion;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idusuariomod", referencedColumnName="id")
     * })
     */
    private $idusuariomod;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idusuarioreg", referencedColumnName="id")
     * })
     */
    private $idusuarioreg;

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->nombrearea ? strtoupper($this->idarea) . ' - ' . mb_strtoupper($this->nombrearea, 'utf-8') : '';
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
     * Set idarea
     *
     * @param string $idarea
     *
     * @return CtlAreaServicioDiagnostico
     */
    public function setIdarea($idarea)
    {
        $this->idarea = $idarea;

        return $this;
    }

    /**
     * Get idarea
     *
     * @return string
     */
    public function getIdarea()
    {
        return $this->idarea;
    }

    /**
     * Set nombrearea
     *
     * @param string $nombrearea
     *
     * @return CtlAreaServicioDiagnostico
     */
    public function setNombrearea($nombrearea)
    {
        $this->nombrearea = $nombrearea;

        return $this;
    }

    /**
     * Get nombrearea
     *
     * @return string
     */
    public function getNombrearea()
    {
        return $this->nombrearea;
    }

    /**
     * Set administrativa
     *
     * @param string $administrativa
     *
     * @return CtlAreaServicioDiagnostico
     */
    public function setAdministrativa($administrativa)
    {
        $this->administrativa = $administrativa;

        return $this;
    }

    /**
     * Get administrativa
     *
     * @return string
     */
    public function getAdministrativa()
    {
        return $this->administrativa;
    }

    /**
     * Set fechahorareg
     *
     * @param \DateTime $fechahorareg
     *
     * @return CtlAreaServicioDiagnostico
     */
    public function setFechahorareg($fechahorareg)
    {
        $this->fechahorareg = $fechahorareg;

        return $this;
    }

    /**
     * Get fechahorareg
     *
     * @return \DateTime
     */
    public function getFechahorareg()
    {
        return $this->fechahorareg;
    }

    /**
     * Set fechahoramod
     *
     * @param \DateTime $fechahoramod
     *
     * @return CtlAreaServicioDiagnostico
     */
    public function setFechahoramod($fechahoramod)
    {
        $this->fechahoramod = $fechahoramod;

        return $this;
    }

    /**
     * Get fechahoramod
     *
     * @return \DateTime
     */
    public function getFechahoramod()
    {
        return $this->fechahoramod;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return CtlAreaServicioDiagnostico
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set idAtencion
     *
     * @param \Minsal\SiapsBundle\Entity\CtlAtencion $idAtencion
     *
     * @return CtlAreaServicioDiagnostico
     */
    public function setIdAtencion(\Minsal\SiapsBundle\Entity\CtlAtencion $idAtencion = null)
    {
        $this->idAtencion = $idAtencion;

        return $this;
    }

    /**
     * Get idAtencion
     *
     * @return \Minsal\SiapsBundle\Entity\CtlAtencion
     */
    public function getIdAtencion()
    {
        return $this->idAtencion;
    }

    /**
     * Set idusuariomod
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuariomod
     *
     * @return CtlAreaServicioDiagnostico
     */
    public function setIdusuariomod(\Application\Sonata\UserBundle\Entity\User $idusuariomod = null)
    {
        $this->idusuariomod = $idusuariomod;

        return $this;
    }

    /**
     * Get idusuariomod
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getIdusuariomod()
    {
        return $this->idusuariomod;
    }

    /**
     * Set idusuarioreg
     *
     * @param \Application\Sonata\UserBundle\Entity\User $idusuarioreg
     *
     * @return CtlAreaServicioDiagnostico
     */
    public function setIdusuarioreg(\Application\Sonata\UserBundle\Entity\User $idusuarioreg = null)
    {
        $this->idusuarioreg = $idusuarioreg;

        return $this;
    }

    /**
     * Get idusuarioreg
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getIdusuarioreg()
    {
        return $this->idusuarioreg;
    }

}