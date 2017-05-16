<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity as UniqueEntity;

/**
 * @ORM\Entity()
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

    /**
     * @ORM\OneToMany(targetEntity="IncidentStatus", mappedBy="status")
     */
    protected $incidentStatusList;

    public function __construct()
    {
        $this->incidentStatusList = new ArrayCollection();
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

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setStyle(string $style): Status
    {
        $this->style = $style;

        return $this;
    }

    public function getStyle(): ?string
    {
        return $this->style;
    }
}
