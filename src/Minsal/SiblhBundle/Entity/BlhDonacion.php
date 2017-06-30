<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhDonacion
 *
 * @ORM\Table(name="blh_donacion", indexes={@ORM\Index(name="fk_banco_de_leche_donacion", columns={"id_banco_de_leche"}), @ORM\Index(name="IDX_13A0CBCB54F03532", columns={"id_donante"}), @ORM\Index(name="IDX_13A0CBCB8653A7AF", columns={"id_centro_recoleccion"})})
 * @ORM\Entity
 */
class BlhDonacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_donacion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_donante", type="string", length=15, nullable=true)
     */
    private $codigoDonante;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_donacion", type="date", nullable=false)
     */
    private $fechaDonacion;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_donacion", type="string", length=60, nullable=false)
     */
    private $responsableDonacion;

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
     * @var \CtlCentroRecoleccion
     *
     * @ORM\ManyToOne(targetEntity="CtlCentroRecoleccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_centro_recoleccion", referencedColumnName="id")
     * })
     */
    private $idCentroRecoleccion;

    /**
     * @var \BlhBancoDeLeche
     *
     * @ORM\ManyToOne(targetEntity="BlhBancoDeLeche")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_banco_de_leche", referencedColumnName="id")
     * })
     */
    private $idBancoDeLeche;


}

