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
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=6, nullable=true)
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
        return $this->nombre ? strtoupper(trim($this->codigo)) . ' - ' . mb_strtoupper(trim($this->nombre), 'utf-8') : '';
    }

}