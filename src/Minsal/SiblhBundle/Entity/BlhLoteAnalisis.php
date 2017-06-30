<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhLoteAnalisis
 *
 * @ORM\Table(name="blh_lote_analisis")
 * @ORM\Entity
 */
class BlhLoteAnalisis
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_lote_analisis_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_lote_analisis", type="string", length=11, nullable=false)
     */
    private $codigoLoteAnalisis;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_analisis_fisico_quimico", type="date", nullable=false)
     */
    private $fechaAnalisisFisicoQuimico;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_analisis", type="string", length=60, nullable=false)
     */
    private $responsableAnalisis;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario", type="integer", nullable=true)
     */
    private $usuario;


}

