<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhSeguimientoReceptor
 *
 * @ORM\Table(name="blh_seguimiento_receptor", indexes={@ORM\Index(name="IDX_EB08C6D4B91944F2", columns={"id_receptor"})})
 * @ORM\Entity
 */
class BlhSeguimientoReceptor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_seguimiento_receptor_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="talla_receptor", type="decimal", precision=7, scale=4, nullable=false)
     */
    private $tallaReceptor;

    /**
     * @var string
     *
     * @ORM\Column(name="peso_seguimiento", type="decimal", precision=8, scale=4, nullable=false)
     */
    private $pesoSeguimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="pc_seguimiento", type="decimal", precision=6, scale=4, nullable=false)
     */
    private $pcSeguimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="ganancia_dia_peso", type="decimal", precision=7, scale=4, nullable=false)
     */
    private $gananciaDiaPeso;

    /**
     * @var integer
     *
     * @ORM\Column(name="semana", type="integer", nullable=false)
     */
    private $semana;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_seguimiento", type="date", nullable=false)
     */
    private $fechaSeguimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="ganancia_dia_talla", type="decimal", precision=7, scale=4, nullable=false)
     */
    private $gananciaDiaTalla;

    /**
     * @var string
     *
     * @ORM\Column(name="complicaciones", type="string", length=50, nullable=false)
     */
    private $complicaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=150, nullable=true)
     */
    private $observacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="periodo_evaluacion", type="integer", nullable=true)
     */
    private $periodoEvaluacion;

    /**
     * @var string
     *
     * @ORM\Column(name="ganancia_dia_pc", type="decimal", precision=7, scale=4, nullable=true)
     */
    private $gananciaDiaPc;

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


}

