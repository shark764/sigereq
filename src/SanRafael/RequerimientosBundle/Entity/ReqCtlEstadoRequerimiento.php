<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqCtlEstadoRequerimiento
 *
 * @ORM\Table(name="req_ctl_estado_requerimiento", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_estado_requerimiento", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_3F450511FA5F996B", columns={"id_estado_padre"})})
 * @ORM\Entity
 */
class ReqCtlEstadoRequerimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_ctl_estado_requerimiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=75, nullable=false)
     */
    private $nombre = 'Requerimiento recibido';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=3, nullable=false)
     */
    private $codigo = 'RRC';

    /**
     * @var \ReqCtlEstadoRequerimiento
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlEstadoRequerimiento", inversedBy="estadoSubestadosRequerimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_padre", referencedColumnName="id")
     * })
     */
    private $idEstadoPadre;

    /**
     * @ORM\OneToMany(targetEntity="ReqCtlEstadoRequerimiento", mappedBy="idEstadoPadre", cascade={"all"}, orphanRemoval=true)
     */
    private $estadoSubestadosRequerimiento;

    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->estadoSubestadosRequerimiento = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ReqCtlEstadoRequerimiento
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
     * @return ReqCtlEstadoRequerimiento
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
     * Set idEstadoPadre
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlEstadoRequerimiento $idEstadoPadre
     *
     * @return ReqCtlEstadoRequerimiento
     */
    public function setIdEstadoPadre(\SanRafael\RequerimientosBundle\Entity\ReqCtlEstadoRequerimiento $idEstadoPadre = null)
    {
        $this->idEstadoPadre = $idEstadoPadre;

        return $this;
    }

    /**
     * Get idEstadoPadre
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlEstadoRequerimiento
     */
    public function getIdEstadoPadre()
    {
        return $this->idEstadoPadre;
    }

    /**
     * Add estadoSubestadosRequerimiento
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlEstadoRequerimiento $estadoSubestadosRequerimiento
     *
     * @return ReqCtlEstadoRequerimiento
     */
    public function addEstadoSubestadosRequerimiento(\SanRafael\RequerimientosBundle\Entity\ReqCtlEstadoRequerimiento $estadoSubestadosRequerimiento)
    {
        $this->estadoSubestadosRequerimiento[] = $estadoSubestadosRequerimiento;

        return $this;
    }

    /**
     * Remove estadoSubestadosRequerimiento
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlEstadoRequerimiento $estadoSubestadosRequerimiento
     */
    public function removeEstadoSubestadosRequerimiento(\SanRafael\RequerimientosBundle\Entity\ReqCtlEstadoRequerimiento $estadoSubestadosRequerimiento)
    {
        $this->estadoSubestadosRequerimiento->removeElement($estadoSubestadosRequerimiento);
    }

    /**
     * Get estadoSubestadosRequerimiento
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEstadoSubestadosRequerimiento()
    {
        return $this->estadoSubestadosRequerimiento;
    }
}
