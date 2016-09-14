<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ReqCtlTipoServicio
 *
 * @ORM\Table(name="req_ctl_tipo_servicio", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_tipo_servicio", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_BB5B956705370F4", columns={"id_tipo_padre"})})
 * @ORM\Entity
 */
class ReqCtlTipoServicio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_ctl_tipo_servicio_id_seq", allocationSize=1, initialValue=1)
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
     */
    private $nombre = 'División Administrativa';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=3, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     */
    private $codigo = 'ADM';

    /**
     * @var \ReqCtlTipoServicio
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlTipoServicio", inversedBy="tipoSubtiposServicioAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_padre", referencedColumnName="id")
     * })
     */
    private $idTipoPadre;

    /**
     * @ORM\OneToMany(targetEntity="ReqCtlTipoServicio", mappedBy="idTipoPadre", cascade={"all"}, orphanRemoval=true)
     */
    private $tipoSubtiposServicioAtencion;

    /**
     * ToString
     */
    public function __toString()
    {
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tipoSubtiposServicioAtencion = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ReqCtlTipoServicio
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
     * @return ReqCtlTipoServicio
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
     * Set idTipoPadre
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlTipoServicio $idTipoPadre
     *
     * @return ReqCtlTipoServicio
     */
    public function setIdTipoPadre(\SanRafael\RequerimientosBundle\Entity\ReqCtlTipoServicio $idTipoPadre = null)
    {
        $this->idTipoPadre = $idTipoPadre;

        return $this;
    }

    /**
     * Get idTipoPadre
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlTipoServicio
     */
    public function getIdTipoPadre()
    {
        return $this->idTipoPadre;
    }

    /**
     * Add tipoSubtiposServicioAtencion
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlTipoServicio $tipoSubtiposServicioAtencion
     *
     * @return ReqCtlTipoServicio
     */
    public function addTipoSubtiposServicioAtencion(\SanRafael\RequerimientosBundle\Entity\ReqCtlTipoServicio $tipoSubtiposServicioAtencion)
    {
        $this->tipoSubtiposServicioAtencion[] = $tipoSubtiposServicioAtencion;

        return $this;
    }

    /**
     * Remove tipoSubtiposServicioAtencion
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlTipoServicio $tipoSubtiposServicioAtencion
     */
    public function removeTipoSubtiposServicioAtencion(\SanRafael\RequerimientosBundle\Entity\ReqCtlTipoServicio $tipoSubtiposServicioAtencion)
    {
        $this->tipoSubtiposServicioAtencion->removeElement($tipoSubtiposServicioAtencion);
    }

    /**
     * Get tipoSubtiposServicioAtencion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTipoSubtiposServicioAtencion()
    {
        return $this->tipoSubtiposServicioAtencion;
    }
}
