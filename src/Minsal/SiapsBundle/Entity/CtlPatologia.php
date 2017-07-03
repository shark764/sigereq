<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlPatologia
 *
 * @ORM\Table(name="ctl_patologia", indexes={@ORM\Index(name="fki_tipo_patologia_patologia", columns={"id_tipo_patologia"}), @ORM\Index(name="fki_patologia_patologia", columns={"id_patologia_padre"})})
 * @ORM\Entity
 */
class CtlPatologia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_patologia_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="notificacion", type="boolean", nullable=false)
     */
    private $notificacion = false;

    /**
     * @var \CtlPatologia
     *
     * @ORM\ManyToOne(targetEntity="CtlPatologia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_patologia_padre", referencedColumnName="id")
     * })
     */
    private $idPatologiaPadre;

    /**
     * @var \CtlTipoPatologia
     *
     * @ORM\ManyToOne(targetEntity="CtlTipoPatologia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_patologia", referencedColumnName="id")
     * })
     */
    private $idTipoPatologia;


}

