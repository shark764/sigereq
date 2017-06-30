<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhSolicitud
 *
 * @ORM\Table(name="blh_solicitud", indexes={@ORM\Index(name="fk_grupo_solicitud_solicitud", columns={"id_grupo_solicitud"}), @ORM\Index(name="IDX_9E50CAC8B91944F2", columns={"id_receptor"})})
 * @ORM\Entity
 */
class BlhSolicitud
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_solicitud_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_solicitud", type="string", length=14, nullable=true)
     */
    private $codigoSolicitud = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_por_dia", type="decimal", precision=7, scale=4, nullable=false)
     */
    private $volumenPorDia;

    /**
     * @var string
     *
     * @ORM\Column(name="acidez_necesaria", type="string", length=9, nullable=false)
     */
    private $acidezNecesaria;

    /**
     * @var string
     *
     * @ORM\Column(name="calorias_necesarias", type="string", length=15, nullable=false)
     */
    private $caloriasNecesarias;

    /**
     * @var string
     *
     * @ORM\Column(name="peso_dia", type="decimal", precision=8, scale=4, nullable=false)
     */
    private $pesoDia;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_por_toma", type="decimal", precision=7, scale=4, nullable=false)
     */
    private $volumenPorToma;

    /**
     * @var integer
     *
     * @ORM\Column(name="toma_por_dia", type="integer", nullable=false)
     */
    private $tomaPorDia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solicitud", type="date", nullable=false)
     */
    private $fechaSolicitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="cuna", type="integer", nullable=false)
     */
    private $cuna;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=10, nullable=false)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=60, nullable=true)
     */
    private $responsable;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario", type="integer", nullable=true)
     */
    private $usuario;

    /**
     * @var \BlhReceptor
     *
     * @ORM\ManyToOne(targetEntity="BlhReceptor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_receptor", referencedColumnName="id")
     * })
     */
    private $idReceptor;

    /**
     * @var \BlhGrupoSolicitud
     *
     * @ORM\ManyToOne(targetEntity="BlhGrupoSolicitud")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grupo_solicitud", referencedColumnName="id")
     * })
     */
    private $idGrupoSolicitud;


}

