<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhFrascoRecolectadoFrascoP
 *
 * @ORM\Table(name="blh_frasco_recolectado_frasco_p", indexes={@ORM\Index(name="IDX_62B6063459B17EFE", columns={"id_frasco_procesado"}), @ORM\Index(name="IDX_62B60634EC124187", columns={"id_frasco_recolectado"})})
 * @ORM\Entity
 */
class BlhFrascoRecolectadoFrascoP
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_frasco_recolectado_frasco_p_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_agregado", type="decimal", precision=7, scale=4, nullable=false)
     */
    private $volumenAgregado;

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
     * @var \BlhFrascoRecolectado
     *
     * @ORM\ManyToOne(targetEntity="BlhFrascoRecolectado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_frasco_recolectado", referencedColumnName="id")
     * })
     */
    private $idFrascoRecolectado;


}

