<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhHistoriaActual
 *
 * @ORM\Table(name="blh_historia_actual", indexes={@ORM\Index(name="fki_blh_his_fk_hab_tox", columns={"habito_toxico"}), @ORM\Index(name="fki_blh_his_fk_pat", columns={"patologia"}), @ORM\Index(name="fki_blh_his_hab", columns={"habito_toxico"}), @ORM\Index(name="IDX_F93902A254F03532", columns={"id_donante"})})
 * @ORM\Entity
 */
class BlhHistoriaActual
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_historia_actual_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="peso_donante", type="decimal", precision=7, scale=4, nullable=false)
     */
    private $pesoDonante;

    /**
     * @var string
     *
     * @ORM\Column(name="talla_donante", type="decimal", precision=7, scale=4, nullable=false)
     */
    private $tallaDonante;

    /**
     * @var string
     *
     * @ORM\Column(name="medicamento", type="string", length=50, nullable=true)
     */
    private $medicamento;

    /**
     * @var string
     *
     * @ORM\Column(name="motivo_donacion", type="string", length=50, nullable=false)
     */
    private $motivoDonacion;

    /**
     * @var string
     *
     * @ORM\Column(name="imc", type="decimal", precision=7, scale=4, nullable=false)
     */
    private $imc;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_donante", type="string", length=12, nullable=false)
     */
    private $estadoDonante;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario", type="integer", nullable=true)
     */
    private $usuario;

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
     * @var \CtlPatologia
     *
     * @ORM\ManyToOne(targetEntity="CtlPatologia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="patologia", referencedColumnName="id")
     * })
     */
    private $patologia;

    /**
     * @var \CtlHabitoToxico
     *
     * @ORM\ManyToOne(targetEntity="CtlHabitoToxico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="habito_toxico", referencedColumnName="id")
     * })
     */
    private $habitoToxico;


}

