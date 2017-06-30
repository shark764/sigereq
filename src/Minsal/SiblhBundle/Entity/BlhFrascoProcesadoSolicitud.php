<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhFrascoProcesadoSolicitud
 *
 * @ORM\Table(name="blh_frasco_procesado_solicitud", indexes={@ORM\Index(name="fk_solicitud_frasco_procesado_s", columns={"id_solicitud"}), @ORM\Index(name="IDX_F422174A59B17EFE", columns={"id_frasco_procesado"})})
 * @ORM\Entity
 */
class BlhFrascoProcesadoSolicitud
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_frasco_procesado_solicitud_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_despachado", type="decimal", precision=6, scale=4, nullable=false)
     */
    private $volumenDespachado;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario", type="integer", nullable=true)
     */
    private $usuario;

    /**
     * @var \BlhFrascoProcesado
     *
     * @ORM\ManyToOne(targetEntity="BlhFrascoProcesado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_frasco_procesado", referencedColumnName="id")
     * })
     */
    private $idFrascoProcesado;

    /**
     * @var \BlhSolicitud
     *
     * @ORM\ManyToOne(targetEntity="BlhSolicitud")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud", referencedColumnName="id")
     * })
     */
    private $idSolicitud;


}

