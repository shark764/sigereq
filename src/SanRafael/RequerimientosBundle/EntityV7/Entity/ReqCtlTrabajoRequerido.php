<?php

namespace SanRafael\RequerimientosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReqCtlTrabajoRequerido
 *
 * @ORM\Table(name="req_ctl_trabajo_requerido", uniqueConstraints={@ORM\UniqueConstraint(name="idx_req_codigo_trabajo_requerido", columns={"codigo"})}, indexes={@ORM\Index(name="IDX_577A5776DDC7A485", columns={"id_area_trabajo"}), @ORM\Index(name="IDX_577A5776E361769B", columns={"id_trabajo_requerido_padre"})})
 * @ORM\Entity(repositoryClass="SanRafael\RequerimientosBundle\Repository\TrabajoRequeridoRepository")
 */
class ReqCtlTrabajoRequerido
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="req_ctl_trabajo_requerido_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="requerimiento", type="string", length=255, nullable=false)
     */
    private $requerimiento = 'Asignación de equipo de cómputo';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=6, nullable=true)
     */
    private $codigo = '000000';

    /**
     * @var \ReqCtlAreaTrabajo
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlAreaTrabajo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_trabajo", referencedColumnName="id")
     * })
     */
    private $idAreaTrabajo;

    /**
     * @var \ReqCtlTrabajoRequerido
     *
     * @ORM\ManyToOne(targetEntity="ReqCtlTrabajoRequerido", inversedBy="trabajoSubtrabajosRequeridos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_trabajo_requerido_padre", referencedColumnName="id")
     * })
     */
    private $idTrabajoRequeridoPadre;

    /**
     * @ORM\OneToMany(targetEntity="ReqCtlTrabajoRequerido", mappedBy="idTrabajoRequeridoPadre", cascade={"all"}, orphanRemoval=true)
     */
    private $trabajoSubtrabajosRequeridos;

    public function __toString()
    {
        return $this->requerimiento ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->requerimiento), 'utf-8') : '';
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->trabajoSubtrabajosRequeridos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set requerimiento
     *
     * @param string $requerimiento
     *
     * @return ReqCtlTrabajoRequerido
     */
    public function setRequerimiento($requerimiento)
    {
        $this->requerimiento = $requerimiento;

        return $this;
    }

    /**
     * Get requerimiento
     *
     * @return string
     */
    public function getRequerimiento()
    {
        return $this->requerimiento;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     *
     * @return ReqCtlTrabajoRequerido
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
     * Set idAreaTrabajo
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlAreaTrabajo $idAreaTrabajo
     *
     * @return ReqCtlTrabajoRequerido
     */
    public function setIdAreaTrabajo(\SanRafael\RequerimientosBundle\Entity\ReqCtlAreaTrabajo $idAreaTrabajo = null)
    {
        $this->idAreaTrabajo = $idAreaTrabajo;

        return $this;
    }

    /**
     * Get idAreaTrabajo
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlAreaTrabajo
     */
    public function getIdAreaTrabajo()
    {
        return $this->idAreaTrabajo;
    }

    /**
     * Set idTrabajoRequeridoPadre
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlTrabajoRequerido $idTrabajoRequeridoPadre
     *
     * @return ReqCtlTrabajoRequerido
     */
    public function setIdTrabajoRequeridoPadre(\SanRafael\RequerimientosBundle\Entity\ReqCtlTrabajoRequerido $idTrabajoRequeridoPadre = null)
    {
        $this->idTrabajoRequeridoPadre = $idTrabajoRequeridoPadre;

        return $this;
    }

    /**
     * Get idTrabajoRequeridoPadre
     *
     * @return \SanRafael\RequerimientosBundle\Entity\ReqCtlTrabajoRequerido
     */
    public function getIdTrabajoRequeridoPadre()
    {
        return $this->idTrabajoRequeridoPadre;
    }

    /**
     * Add trabajoSubtrabajosRequerido
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlTrabajoRequerido $trabajoSubtrabajosRequerido
     *
     * @return ReqCtlTrabajoRequerido
     */
    public function addTrabajoSubtrabajosRequerido(\SanRafael\RequerimientosBundle\Entity\ReqCtlTrabajoRequerido $trabajoSubtrabajosRequerido)
    {
        $this->trabajoSubtrabajosRequeridos[] = $trabajoSubtrabajosRequerido;

        return $this;
    }

    /**
     * Remove trabajoSubtrabajosRequerido
     *
     * @param \SanRafael\RequerimientosBundle\Entity\ReqCtlTrabajoRequerido $trabajoSubtrabajosRequerido
     */
    public function removeTrabajoSubtrabajosRequerido(\SanRafael\RequerimientosBundle\Entity\ReqCtlTrabajoRequerido $trabajoSubtrabajosRequerido)
    {
        $this->trabajoSubtrabajosRequeridos->removeElement($trabajoSubtrabajosRequerido);
    }

    /**
     * Get trabajoSubtrabajosRequeridos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTrabajoSubtrabajosRequeridos()
    {
        return $this->trabajoSubtrabajosRequeridos;
    }
}
