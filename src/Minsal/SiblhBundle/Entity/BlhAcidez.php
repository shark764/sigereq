<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhAcidez
 *
 * @ORM\Table(name="blh_acidez", indexes={@ORM\Index(name="fk_frasco_reco_acid", columns={"id_frasco_recolectado"})})
 * @ORM\Entity
 */
class BlhAcidez
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_acidez_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="acidez1", type="integer", nullable=false)
     */
    private $acidez1;

    /**
     * @var integer
     *
     * @ORM\Column(name="acidez2", type="integer", nullable=false)
     */
    private $acidez2;

    /**
     * @var integer
     *
     * @ORM\Column(name="acidez3", type="integer", nullable=false)
     */
    private $acidez3;

    /**
     * @var string
     *
     * @ORM\Column(name="factor", type="decimal", precision=6, scale=4, nullable=false)
     */
    private $factor;

    /**
     * @var string
     *
     * @ORM\Column(name="resultado", type="decimal", precision=6, scale=4, nullable=false)
     */
    private $resultado;

    /**
     * @var string
     *
     * @ORM\Column(name="media_acidez", type="decimal", precision=6, scale=4, nullable=false)
     */
    private $mediaAcidez;

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

