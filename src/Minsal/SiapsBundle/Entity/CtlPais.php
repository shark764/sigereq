<?php

namespace Minsal\SiapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
// use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * CtlPais
 *
 * @ORM\Table(name="ctl_pais")
 * @ORM\Entity
 */
class CtlPais
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ctl_pais_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=150, nullable=true)
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 150,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $nombre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=true)
     */
    private $activo;

    /**
     * @ORM\OneToMany(targetEntity="CtlDepartamento", mappedBy="idPais", cascade={"all"}, orphanRemoval=true)
     */
    private $paisDepartamento;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->paisDepartamento = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->nombre ? : '';
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return CtlPais
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return CtlPais
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Add paisDepartamento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlDepartamento $paisDepartamento
     *
     * @return CtlPais
     */
    public function addPaisDepartamento(\Minsal\SiapsBundle\Entity\CtlDepartamento $paisDepartamento)
    {
        $this->paisDepartamento[] = $paisDepartamento;

        return $this;
    }

    /**
     * Remove paisDepartamento
     *
     * @param \Minsal\SiapsBundle\Entity\CtlDepartamento $paisDepartamento
     */
    public function removePaisDepartamento(\Minsal\SiapsBundle\Entity\CtlDepartamento $paisDepartamento)
    {
        $this->paisDepartamento->removeElement($paisDepartamento);
    }

    /**
     * Get paisDepartamento
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPaisDepartamento()
    {
        return $this->paisDepartamento;
    }

}