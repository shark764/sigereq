<?php

namespace SanRafael\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqCtlServicioAtencion
 *
 * @ORM\Table(name="req_ctl_servicio_atencion", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_servicio_atencion", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_AC47A494C5DC305D", columns={"id_atencion_padre"})})
 * @ORM\Entity
 */
class ReqCtlServicioAtencion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_ctl_servicio_atencion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", nullable=true)
     */
    private $codigo;

    /**
     * @var \ReqCtlServicioAtencion
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlServicioAtencion", inversedBy="atencionServiciosAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_atencion_padre", referencedColumnName="id")
     * })
     */
    private $idAtencionPadre;

    /**
     * @ORM\OneToMany(targetEntity="ReqCtlServicioAtencion", mappedBy="idAtencionPadre", cascade={"all"}, orphanRemoval=true)
     */
    private $atencionServiciosAtencion;

    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->atencionServiciosAtencion = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ReqCtlServicioAtencion
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
     * @return ReqCtlServicioAtencion
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
     * Set idAtencionPadre
     *
     * @param \SanRafael\AdminBundle\Entity\ReqCtlServicioAtencion $idAtencionPadre
     * @return ReqCtlServicioAtencion
     */
    public function setIdAtencionPadre(\SanRafael\AdminBundle\Entity\ReqCtlServicioAtencion $idAtencionPadre = null)
    {
        $this->idAtencionPadre = $idAtencionPadre;

        return $this;
    }

    /**
     * Get idAtencionPadre
     *
     * @return \SanRafael\AdminBundle\Entity\ReqCtlServicioAtencion 
     */
    public function getIdAtencionPadre()
    {
        return $this->idAtencionPadre;
    }

    /**
     * Add atencionServiciosAtencion
     *
     * @param \SanRafael\AdminBundle\Entity\ReqCtlServicioAtencion $atencionServiciosAtencion
     * @return ReqCtlServicioAtencion
     */
    public function addAtencionServiciosAtencion(\SanRafael\AdminBundle\Entity\ReqCtlServicioAtencion $atencionServiciosAtencion)
    {
        $this->atencionServiciosAtencion[] = $atencionServiciosAtencion;

        return $this;
    }

    /**
     * Remove atencionServiciosAtencion
     *
     * @param \SanRafael\AdminBundle\Entity\ReqCtlServicioAtencion $atencionServiciosAtencion
     */
    public function removeAtencionServiciosAtencion(\SanRafael\AdminBundle\Entity\ReqCtlServicioAtencion $atencionServiciosAtencion)
    {
        $this->atencionServiciosAtencion->removeElement($atencionServiciosAtencion);
    }

    /**
     * Get atencionServiciosAtencion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAtencionServiciosAtencion()
    {
        return $this->atencionServiciosAtencion;
    }
}
