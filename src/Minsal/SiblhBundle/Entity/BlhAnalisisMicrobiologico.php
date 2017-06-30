<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhAnalisisMicrobiologico
 *
 * @ORM\Table(name="blh_analisis_microbiologico", indexes={@ORM\Index(name="fk_frasco_procesado_analisis_mi", columns={"id_frasco_procesado"})})
 * @ORM\Entity
 */
class BlhAnalisisMicrobiologico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_analisis_microbiologico_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_analisis_microbiologico", type="string", length=13, nullable=false)
     */
    private $codigoAnalisisMicrobiologico;

    /**
     * @var string
     *
     * @ORM\Column(name="coliformes_totales", type="string", length=8, nullable=true)
     */
    private $coliformesTotales;

    /**
     * @var string
     *
     * @ORM\Column(name="control", type="string", length=8, nullable=true)
     */
    private $control;

    /**
     * @var string
     *
     * @ORM\Column(name="situacion", type="string", length=9, nullable=true)
     */
    private $situacion;

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


}

