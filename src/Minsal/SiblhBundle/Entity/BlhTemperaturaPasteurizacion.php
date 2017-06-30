<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhTemperaturaPasteurizacion
 *
 * @ORM\Table(name="blh_temperatura_pasteurizacion", indexes={@ORM\Index(name="IDX_A77617AA9D483370", columns={"id_pasteurizacion"})})
 * @ORM\Entity
 */
class BlhTemperaturaPasteurizacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_temperatura_pasteurizacion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="temperatura_p", type="integer", nullable=true)
     */
    private $temperaturaP;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario", type="integer", nullable=true)
     */
    private $usuario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_inicio_p", type="time", nullable=true)
     */
    private $horaInicioP;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_final_p", type="time", nullable=true)
     */
    private $horaFinalP;

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

