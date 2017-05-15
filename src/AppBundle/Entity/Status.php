<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity as UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StatusRepository")
 * @ORM\Table(name="status")
 */
class Status
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @JMS\Expose
     */
    protected $caption;

    /**
     * @ORM\Column(type="string", length=255)
     * @JMS\Expose
     */
    protected $style;

    public function __construct()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setCaption(string $caption): Status
    {
        $this->caption = $caption;

        return $this;
    }

    public function getCaption(): string
    {
        return $this->caption;
    }

    public function setStyle(string $style): Status
    {
        $this->style = $style;

        return $this;
    }

    public function getStyle(): string
    {
        return $this->style;
    }

    public function __toString(): string
    {
        return $this->caption;
    }
}
