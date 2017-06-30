<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhFrascoProcesado
 *
 * @ORM\Table(name="blh_frasco_procesado", indexes={@ORM\Index(name="fk_pasteurizacion_frasco_proces", columns={"id_pasteurizacion"}), @ORM\Index(name="IDX_4BD55E3D6A540E", columns={"id_estado"})})
 * @ORM\Entity
 */
class BlhFrascoProcesado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_frasco_procesado_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_frasco_procesado", type="string", length=15, nullable=true)
     */
    private $codigoFrascoProcesado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_frasco_pasteurizado", type="decimal", precision=7, scale=4, nullable=false)
     */
    private $volumenFrascoPasteurizado;

    /**
     * @var string
     *
     * @ORM\Column(name="acidez_total", type="decimal", precision=7, scale=4, nullable=false)
     */
    private $acidezTotal;

    /**
     * @var string
     *
     * @ORM\Column(name="kcalorias_totales", type="decimal", precision=7, scale=4, nullable=false)
     */
    private $kcaloriasTotales;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion_frasco_procesado", type="string", length=150, nullable=true)
     */
    private $observacionFrascoProcesado;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_disponible_fp", type="decimal", precision=7, scale=4, nullable=true)
     */
    private $volumenDisponibleFp;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario", type="integer", nullable=true)
     */
    private $usuario;

    /**
     * @var \BlhEstado
     *
     * @ORM\ManyToOne(targetEntity="BlhEstado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado", referencedColumnName="id")
     * })
     */
    private $idEstado;

    /**
     * @var \BlhPasteurizacion
     *
     * @ORM\ManyToOne(targetEntity="BlhPasteurizacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pasteurizacion", referencedColumnName="id")
     * })
     */
    private $idPasteurizacion;


}

