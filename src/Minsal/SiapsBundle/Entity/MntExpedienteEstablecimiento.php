<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MntExpedienteEstablecimiento
 *
 * @ORM\Table(name="mnt_expediente_establecimiento", indexes={@ORM\Index(name="IDX_8715ED227DFA12F6", columns={"id_establecimiento"})})
 * @ORM\Entity
 */
class MntExpedienteEstablecimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="mnt_expediente_establecimiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_paciente_inicial", type="bigint", nullable=true)
     */
    private $idPacienteInicial;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_paciente_siap_local", type="bigint", nullable=true)
     */
    private $idPacienteSiapLocal;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_numero_expediente", type="bigint", nullable=true)
     */
    private $idNumeroExpediente;

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

