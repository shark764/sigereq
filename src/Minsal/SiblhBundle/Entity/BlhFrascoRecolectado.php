<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhFrascoRecolectado
 *
 * @ORM\Table(name="blh_frasco_recolectado", indexes={@ORM\Index(name="fk_frasco_recolectado_lote_anal", columns={"id_lote_analisis"}), @ORM\Index(name="fk_donacion_frasco_recolectado", columns={"id_donacion"}), @ORM\Index(name="fk_donante_frasco_recolectado", columns={"id_donante"}), @ORM\Index(name="fk_estado_frasco_recolectado", columns={"id_estado"})})
 * @ORM\Entity
 */
class BlhFrascoRecolectado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_frasco_recolectado_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_frasco_recolectado", type="string", length=15, nullable=false)
     */
    private $codigoFrascoRecolectado;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_recolectado", type="decimal", precision=7, scale=4, nullable=false)
     */
    private $volumenRecolectado;

    /**
     * @var string
     *
     * @ORM\Column(name="forma_extraccion", type="string", length=8, nullable=false)
     */
    private $formaExtraccion;

    /**
     * @var string
     *
     * @ORM\Column(name="onz_recolectado", type="decimal", precision=6, scale=4, nullable=true)
     */
    private $onzRecolectado;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion_frasco_recolectado", type="string", length=150, nullable=true)
     */
    private $observacionFrascoRecolectado;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_disponible_fr", type="decimal", precision=7, scale=4, nullable=true)
     */
    private $volumenDisponibleFr;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario", type="integer", nullable=true)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_real", type="decimal", precision=7, scale=4, nullable=true)
     */
    private $volumenReal;

    /**
     * @var \BlhEstado
     *
     * @ORM\ManyToOne(targetEntity="BlhEstado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado", referencedColumnName="id")
     * })
     */
    private $idEstado;

    /**
     * @var \BlhDonacion
     *
     * @ORM\ManyToOne(targetEntity="BlhDonacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_donacion", referencedColumnName="id")
     * })
     */
    private $idDonacion;

    /**
     * @var \BlhDonante
     *
     * @ORM\ManyToOne(targetEntity="BlhDonante")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_donante", referencedColumnName="id")
     * })
     */
    private $idDonante;

    /**
     * @var \BlhLoteAnalisis
     *
     * @ORM\ManyToOne(targetEntity="BlhLoteAnalisis")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_lote_analisis", referencedColumnName="id")
     * })
     */
    private $idLoteAnalisis;


}

