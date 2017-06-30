<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhAnalisisSensorial
 *
 * @ORM\Table(name="blh_analisis_sensorial", indexes={@ORM\Index(name="IDX_880123DFEC124187", columns={"id_frasco_recolectado"})})
 * @ORM\Entity
 */
class BlhAnalisisSensorial
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_analisis_sensorial_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="embalaje", type="string", length=9, nullable=true)
     */
    private $embalaje;

    /**
     * @var string
     *
     * @ORM\Column(name="suciedad", type="string", length=9, nullable=true)
     */
    private $suciedad;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=9, nullable=true)
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(name="flavor", type="string", length=9, nullable=true)
     */
    private $flavor;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=150, nullable=true)
     */
    private $observacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario", type="integer", nullable=true)
     */
    private $usuario;

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

