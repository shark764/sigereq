<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhPasteurizacion
 *
 * @ORM\Table(name="blh_pasteurizacion", indexes={@ORM\Index(name="fk_curva_pasteurizacion", columns={"id_curva"})})
 * @ORM\Entity
 */
class BlhPasteurizacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_pasteurizacion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_pasteurizacion", type="string", length=11, nullable=false)
     */
    private $codigoPasteurizacion = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="num_ciclo", type="integer", nullable=true)
     */
    private $numCiclo;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_pasteurizado", type="decimal", precision=7, scale=4, nullable=false)
     */
    private $volumenPasteurizado;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_frascos_pasteurizados", type="integer", nullable=false)
     */
    private $numFrascosPasteurizados;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_pasteurizacion", type="date", nullable=false)
     */
    private $fechaPasteurizacion;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_pasteurizacion", type="string", length=60, nullable=false)
     */
    private $responsablePasteurizacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario", type="integer", nullable=true)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_total", type="decimal", precision=8, scale=0, nullable=true)
     */
    private $volumenTotal;

    /**
     * @var \BlhCurva
     *
     * @ORM\ManyToOne(targetEntity="BlhCurva")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_curva", referencedColumnName="id")
     * })
     */
    private $idCurva;


}

