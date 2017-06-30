<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhCurva
 *
 * @ORM\Table(name="blh_curva")
 * @ORM\Entity
 */
class BlhCurva
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_curva_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tiempo1", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $tiempo1;

    /**
     * @var string
     *
     * @ORM\Column(name="tiempo2", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $tiempo2;

    /**
     * @var string
     *
     * @ORM\Column(name="tiempo3", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $tiempo3;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_curva", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $valorCurva;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_curva", type="date", nullable=false)
     */
    private $fechaCurva;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad_frascos", type="integer", nullable=false)
     */
    private $cantidadFrascos;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_por_frasco", type="decimal", precision=7, scale=4, nullable=false)
     */
    private $volumenPorFrasco;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_inicio_curva", type="time", nullable=true)
     */
    private $horaInicioCurva;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario", type="integer", nullable=true)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_total", type="decimal", precision=20, scale=0, nullable=true)
     */
    private $volumenTotal;


}

