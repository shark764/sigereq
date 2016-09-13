<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqCtlServicioAtencion
 *
 * @ORM\Table(name="req_ctl_servicio_atencion", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_servicio_atencion", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_AC47A494C5DC305D", columns={"id_atencion_padre"}), @ORM\Index(name="IDX_AC47A494A36B7986", columns={"id_tipo_servicio"})})
 * @ORM\Entity(repositoryClass="SanRafael\RequerimientosBundle\Repository\ServicioAtencionRepository")
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
    private $nombre = 'Unidad de Informática';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=6, nullable=true)
     */
    private $codigo = 'INF';

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
     * @var \ReqCtlTipoServicio
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlTipoServicio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_servicio", referencedColumnName="id")
     * })
     */
    private $idTipoServicio;

    /**
     * @ORM\OneToMany(targetEntity="ReqCtlServicioAtencion", mappedBy="idAtencionPadre", cascade={"all"}, orphanRemoval=true)
     */
    private $atencionServiciosAtencion;

    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8')
                    . ($this->idAtencionPadre ? ' | ' . $this->idAtencionPadre : '') : '';
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
     *
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
     *
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
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlServicioAtencion $idAtencionPadre
     *
     * @return ReqCtlServicioAtencion
     */
    public function setIdAtencionPadre(\SanRafael\RequerimientosBundle\Entity\ReqCtlServicioAtencion $idAtencionPadre = null)
    {
        $this->idAtencionPadre = $idAtencionPadre;

        return $this;
    }

    /**
     * Get idAtencionPadre
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlServicioAtencion
     */
    public function getIdAtencionPadre()
    {
        return $this->idAtencionPadre;
    }

    /**
     * Set idTipoServicio
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlTipoServicio $idTipoServicio
     *
     * @return ReqCtlServicioAtencion
     */
    public function setIdTipoServicio(\SanRafael\RequerimientosBundle\Entity\ReqCtlTipoServicio $idTipoServicio = null)
    {
        $this->idTipoServicio = $idTipoServicio;

        return $this;
    }

    /**
     * Get idTipoServicio
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlTipoServicio
     */
    public function getIdTipoServicio()
    {
        return $this->idTipoServicio;
    }

    /**
     * Add atencionServiciosAtencion
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlServicioAtencion $atencionServiciosAtencion
     *
     * @return ReqCtlServicioAtencion
     */
    public function addAtencionServiciosAtencion(\SanRafael\RequerimientosBundle\Entity\ReqCtlServicioAtencion $atencionServiciosAtencion)
    {
        $this->atencionServiciosAtencion[] = $atencionServiciosAtencion;

        return $this;
    }

    /**
     * Remove atencionServiciosAtencion
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlServicioAtencion $atencionServiciosAtencion
     */
    public function removeAtencionServiciosAtencion(\SanRafael\RequerimientosBundle\Entity\ReqCtlServicioAtencion $atencionServiciosAtencion)
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
