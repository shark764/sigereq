<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlhRolMenu
 *
 * @ORM\Table(name="blh_rol_menu", indexes={@ORM\Index(name="fk_rol_rol_menu", columns={"id_rol"}), @ORM\Index(name="fk_menu_rol_menu", columns={"id_menu"})})
 * @ORM\Entity
 */
class BlhRolMenu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_rol_menu_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario", type="integer", nullable=true)
     */
    private $usuario;

    /**
     * @var \BlhRol
     *
     * @ORM\ManyToOne(targetEntity="BlhRol")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_rol", referencedColumnName="id")
     * })
     */
    private $idRol;

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

