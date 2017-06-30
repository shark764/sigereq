<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhExamenDonante
 *
 * @ORM\Table(name="blh_examen_donante", indexes={@ORM\Index(name="fk__donante_examen_donante", columns={"id_examen"}), @ORM\Index(name="IDX_BECE40754F03532", columns={"id_donante"})})
 * @ORM\Entity
 */
class BlhExamenDonante
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_examen_donante_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="resultado_examen", type="string", length=8, nullable=false)
     */
    private $resultadoExamen;

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
     * @var \BlhExamen
     *
     * @ORM\ManyToOne(targetEntity="BlhExamen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_examen", referencedColumnName="id")
     * })
     */
    private $idExamen;


}

