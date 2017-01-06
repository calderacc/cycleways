<?php

namespace Caldera\Bundle\CyclewaysBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="incident_tag")
 * @ORM\Entity()
 */
class IncidentTag
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Incident")
     * @ORM\JoinTable(name="incident_incident_tag",
     *      joinColumns={@ORM\JoinColumn(name="incident_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     */
    protected $incidents;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @ORM\Column(name="font_color", type="string", length=255, nullable=true)
     */
    protected $fontColor;

    /**
     * @ORM\Column(name="background_color", type="string", length=255, nullable=true)
     */
    protected $backgroundColor;

    public function __construct()
    {
        $this->incidents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setTitle(string $title): IncidentTag
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setFontColor(string $fontColor): IncidentTag
    {
        $this->fontColor = $fontColor;

        return $this;
    }

    public function getFontColor(): string
    {
        return $this->fontColor;
    }

    public function setBackgroundColor($backgroundColor): IncidentTag
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    public function getBackgroundColor(): string
    {
        return $this->backgroundColor;
    }

    public function addIncident(Incident $incident): IncidentTag
    {
        $this->incidents[] = $incident;

        return $this;
    }

    public function removeIncident(Incident $incident): void
    {
        $this->incidents->removeElement($incident);
    }

    public function getIncidents(): Collection
    {
        return $this->incidents;
    }
}
