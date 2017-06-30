<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhTemperaturaEnfriamiento
 *
 * @ORM\Table(name="blh_temperatura_enfriamiento", indexes={@ORM\Index(name="IDX_3985D55C9D483370", columns={"id_pasteurizacion"})})
 * @ORM\Entity
 */
class BlhTemperaturaEnfriamiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_temperatura_enfriamiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="temperatura_e", type="integer", nullable=false)
     */
    private $temperaturaE;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario", type="integer", nullable=true)
     */
    private $usuario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_inicio_e", type="time", nullable=true)
     */
    private $horaInicioE;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_final_e", type="time", nullable=true)
     */
    private $horaFinalE;

    /**
     * @var \BlhPasteurizacion
     *
     * @ORM\ManyToOne(targetEntity="BlhPasteurizacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pasteurizacion", referencedColumnName="id")
     * })
     */
    private $idPasteurizacion;


}

