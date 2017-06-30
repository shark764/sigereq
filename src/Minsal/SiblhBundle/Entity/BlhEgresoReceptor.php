<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhEgresoReceptor
 *
 * @ORM\Table(name="blh_egreso_receptor", indexes={@ORM\Index(name="fk_receptor_egreso_receptor", columns={"id_receptor"}), @ORM\Index(name="IDX_7993CDC67DFA12F6", columns={"id_establecimiento"})})
 * @ORM\Entity
 */
class BlhEgresoReceptor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_egreso_receptor_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="diagnostico_egreso", type="string", length=50, nullable=false)
     */
    private $diagnosticoEgreso;

    /**
     * @var string
     *
     * @ORM\Column(name="madre_canguro", type="string", length=2, nullable=false)
     */
    private $madreCanguro;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_egreso", type="string", length=6, nullable=false)
     */
    private $tipoEgreso;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario_egreso", type="string", length=150, nullable=true)
     */
    private $comentarioEgreso;

    /**
     * @var string
     *
     * @ORM\Column(name="traslado_periferico", type="string", length=2, nullable=false)
     */
    private $trasladoPeriferico;

    /**
     * @var integer
     *
     * @ORM\Column(name="permanencia_ucin", type="integer", nullable=true)
     */
    private $permanenciaUcin;

    /**
     * @var string
     *
     * @ORM\Column(name="hospital_seguimiento_egreso", type="string", length=80, nullable=true)
     */
    private $hospitalSeguimientoEgreso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_egreso", type="date", nullable=false)
     */
    private $fechaEgreso;

    /**
     * @var integer
     *
     * @ORM\Column(name="estancia_hospitalaria", type="integer", nullable=true)
     */
    private $estanciaHospitalaria;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario", type="integer", nullable=true)
     */
    private $usuario;

    /**
     * @var integer
     *
     * @ORM\Column(name="dias_permanencia", type="integer", nullable=true)
     */
    private $diasPermanencia;

    /**
     * @var \CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     */
    private $idEstablecimiento;

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

