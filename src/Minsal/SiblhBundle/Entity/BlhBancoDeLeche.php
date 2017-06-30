<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhBancoDeLeche
 *
 * @ORM\Table(name="blh_banco_de_leche", indexes={@ORM\Index(name="fk_establecimiento_banco_de_lec", columns={"id_establecimiento"})})
 * @ORM\Entity
 */
class BlhBancoDeLeche
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_banco_de_leche_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_banco_de_leche", type="string", length=6, nullable=false)
     */
    private $codigoBancoDeLeche;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_banco", type="string", length=8, nullable=false)
     */
    private $estadoBanco;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario", type="integer", nullable=true)
     */
    private $usuario;

    /**
     * @var \CtlEstablecimiento
     *
     * @ORM\ManyToOne(targetEntity="CtlEstablecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     */
    private $idEstablecimiento;


}

