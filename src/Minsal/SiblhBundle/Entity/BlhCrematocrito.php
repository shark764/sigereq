<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhCrematocrito
 *
 * @ORM\Table(name="blh_crematocrito", indexes={@ORM\Index(name="IDX_94B73C6C59B17EFE", columns={"id_frasco_procesado"}), @ORM\Index(name="IDX_94B73C6CEC124187", columns={"id_frasco_recolectado"})})
 * @ORM\Entity
 */
class BlhCrematocrito
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_crematocrito_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="crema1", type="decimal", precision=6, scale=4, nullable=true)
     */
    private $crema1;

    /**
     * @var string
     *
     * @ORM\Column(name="crema2", type="decimal", precision=6, scale=4, nullable=true)
     */
    private $crema2;

    /**
     * @var string
     *
     * @ORM\Column(name="crema3", type="decimal", precision=6, scale=4, nullable=true)
     */
    private $crema3;

    /**
     * @var string
     *
     * @ORM\Column(name="ct1", type="decimal", precision=6, scale=4, nullable=true)
     */
    private $ct1;

    /**
     * @var string
     *
     * @ORM\Column(name="ct2", type="decimal", precision=6, scale=4, nullable=true)
     */
    private $ct2;

    /**
     * @var string
     *
     * @ORM\Column(name="ct3", type="decimal", precision=6, scale=4, nullable=true)
     */
    private $ct3;

    /**
     * @var string
     *
     * @ORM\Column(name="media_crema", type="decimal", precision=6, scale=4, nullable=true)
     */
    private $mediaCrema;

    /**
     * @var string
     *
     * @ORM\Column(name="media_ct", type="decimal", precision=6, scale=4, nullable=true)
     */
    private $mediaCt;

    /**
     * @var string
     *
     * @ORM\Column(name="porcentaje_crema", type="decimal", precision=6, scale=4, nullable=true)
     */
    private $porcentajeCrema;

    /**
     * @var string
     *
     * @ORM\Column(name="kilocalorias", type="decimal", precision=7, scale=4, nullable=true)
     */
    private $kilocalorias;

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

