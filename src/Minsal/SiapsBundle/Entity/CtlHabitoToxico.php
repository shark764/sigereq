<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlHabitoToxico
 *
 * @ORM\Table(name="ctl_habito_toxico")
 * @ORM\Entity
 */
class CtlHabitoToxico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_habito_toxico_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="habito_toxico", type="string", length=20, nullable=false)
     */
    private $habitoToxico;


}

