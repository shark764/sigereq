<?php

namespace Minsal\SiblhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Minsal\SiblhBundle\Entity\EntityInterface;

/**
 * BlhCtlHabitoToxico
 *
 * @ORM\Table(name="blh_ctl_habito_toxico")
 * @ORM\Entity
 */
class BlhCtlHabitoToxico implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blh_ctl_habito_toxico_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="habito_toxico", type="string", length=20, nullable=false)
     * @Assert\NotBlank(message = "foreign.default.not_blank")
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]/",
     *     match=true,
     *     message="regex.match.true"
     * )
     * @Assert\Length(
     *      min = 0,
     *      max = 20,
     *      minMessage = "Debe digitar al menos {{ limit }} caracteres",
     *      maxMessage = "Este campo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $habitoToxico;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * ToString
     */
    public function __toString()
    {
        return (string) $this->habitoToxico;
    }
    
    /**
     * Text converter for the Entity (Second form).
     */
    public function getPresentacionEntidad()
    {
    }
    
    /**
     * Text converter for the Entity (Third form).
     */
    public function getFormatoPresentacionEntidad()
    {
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
     * Set habitoToxico
     *
     * @param string $habitoToxico
     *
     * @return BlhCtlHabitoToxico
     */
    public function setHabitoToxico($habitoToxico)
    {
        $this->habitoToxico = $habitoToxico;

        return $this;
    }

    /**
     * Get habitoToxico
     *
     * @return string
     */
    public function getHabitoToxico()
    {
        return $this->habitoToxico;
    }

}