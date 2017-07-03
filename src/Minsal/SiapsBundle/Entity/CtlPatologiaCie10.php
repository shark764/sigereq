<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlPatologiaCie10
 *
 * @ORM\Table(name="ctl_patologia_cie10", indexes={@ORM\Index(name="fki_pk_patologia_patologia_cie10", columns={"id_patologia"}), @ORM\Index(name="fki_patologia_patologia_cie10", columns={"id_patologia"}), @ORM\Index(name="IDX_2CE02D601E833DEC", columns={"id_cie10"})})
 * @ORM\Entity
 */
class CtlPatologiaCie10
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_patologia_cie10_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \MntCie10
     *
     * @ORM\ManyToOne(targetEntity="MntCie10")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cie10", referencedColumnName="id")
     * })
     */
    private $idCie10;

    /**
     * @var \CtlPatologia
     *
     * @ORM\ManyToOne(targetEntity="CtlPatologia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_patologia", referencedColumnName="id")
     * })
     */
    private $idPatologia;


}

