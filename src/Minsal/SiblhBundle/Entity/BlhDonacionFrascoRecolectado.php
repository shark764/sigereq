<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhDonacionFrascoRecolectado
 *
 * @ORM\Table(name="blh_donacion_frasco_recolectado", uniqueConstraints={@ORM\UniqueConstraint(name="idx_blh_donacion_frasco_recolectado", columns={"id_donacion", "id_frasco_recolectado"})}, indexes={@ORM\Index(name="IDX_E98D43ACF00213", columns={"id_donacion"}), @ORM\Index(name="IDX_E98D43EC124187", columns={"id_frasco_recolectado"})})
 * @ORM\Entity
 */
class BlhDonacionFrascoRecolectado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_donacion_frasco_recolectado_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_agregado", type="decimal", precision=7, scale=4, nullable=false)
     */
    private $volumenAgregado = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="volumen_real_agregado", type="decimal", precision=7, scale=4, nullable=false)
     */
    private $volumenRealAgregado = '0';

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
     * @var \BlhFrascoRecolectado
     *
     * @ORM\ManyToOne(targetEntity="BlhFrascoRecolectado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_frasco_recolectado", referencedColumnName="id")
     * })
     */
    private $idFrascoRecolectado;


}

