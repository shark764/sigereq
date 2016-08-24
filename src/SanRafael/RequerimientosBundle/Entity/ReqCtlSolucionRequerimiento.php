<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqCtlSolucionRequerimiento
 *
 * @ORM\Table(name="req_ctl_solucion_requerimiento", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_solucion_requerimiento", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_A204D7AB1B0A8FB", columns={"id_solucion_padre"})})
 * @ORM\Entity(repositoryClass="SanRafael\RequerimientosBundle\Repository\SolucionRequerimientoRepository")
 */
class ReqCtlSolucionRequerimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_ctl_solucion_requerimiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=150, nullable=false)
     */
    private $nombre = 'Funciona correctamente';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", nullable=false)
     */
    private $codigo = 'FNC';

    /**
     * @var \ReqCtlSolucionRequerimiento
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlSolucionRequerimiento", inversedBy="solucionSolucionesRequerimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solucion_padre", referencedColumnName="id")
     * })
     */
    private $idSolucionPadre;

    /**
     * @ORM\OneToMany(targetEntity="ReqCtlSolucionRequerimiento", mappedBy="idSolucionPadre", cascade={"all"}, orphanRemoval=true)
     */
    private $solucionSolucionesRequerimiento;

    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->solucionSolucionesRequerimiento = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ReqCtlSolucionRequerimiento
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
     * Set codigo
     *
     * @param string $codigo
     * @return ReqCtlSolucionRequerimiento
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set idSolucionPadre
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlSolucionRequerimiento $idSolucionPadre
     * @return ReqCtlSolucionRequerimiento
     */
    public function setIdSolucionPadre(\SanRafael\RequerimientosBundle\Entity\ReqCtlSolucionRequerimiento $idSolucionPadre = null)
    {
        $this->idSolucionPadre = $idSolucionPadre;

        return $this;
    }

    /**
     * Get idSolucionPadre
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlSolucionRequerimiento 
     */
    public function getIdSolucionPadre()
    {
        return $this->idSolucionPadre;
    }

    /**
     * Add solucionSolucionesRequerimiento
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlSolucionRequerimiento $solucionSolucionesRequerimiento
     * @return ReqCtlSolucionRequerimiento
     */
    public function addSolucionSolucionesRequerimiento(\SanRafael\RequerimientosBundle\Entity\ReqCtlSolucionRequerimiento $solucionSolucionesRequerimiento)
    {
        $this->solucionSolucionesRequerimiento[] = $solucionSolucionesRequerimiento;

        return $this;
    }

    /**
     * Remove solucionSolucionesRequerimiento
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlSolucionRequerimiento $solucionSolucionesRequerimiento
     */
    public function removeSolucionSolucionesRequerimiento(\SanRafael\RequerimientosBundle\Entity\ReqCtlSolucionRequerimiento $solucionSolucionesRequerimiento)
    {
        $this->solucionSolucionesRequerimiento->removeElement($solucionSolucionesRequerimiento);
    }

    /**
     * Get solucionSolucionesRequerimiento
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSolucionSolucionesRequerimiento()
    {
        return $this->solucionSolucionesRequerimiento;
    }
}
