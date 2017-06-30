<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhOpcionMenu
 *
 * @ORM\Table(name="blh_opcion_menu", indexes={@ORM\Index(name="fk_menu_opcion_menu", columns={"id_menu"})})
 * @ORM\Entity
 */
class BlhOpcionMenu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_opcion_menu_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_opcion", type="string", length=50, nullable=false)
     */
    private $nombreOpcion;

    /**
     * @var string
     *
     * @ORM\Column(name="url_opcion", type="string", length=100, nullable=true)
     */
    private $urlOpcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario", type="integer", nullable=true)
     */
    private $usuario;

    /**
     * @var \BlhMenu
     *
     * @ORM\ManyToOne(targetEntity="BlhMenu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_menu", referencedColumnName="id")
     * })
     */
    private $idMenu;


}

