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

    /**
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $title
     * @return IncidentTag
     */
    public function setTitle(string $title): IncidentTag
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $fontColor
     * @return IncidentTag
     */
    public function setFontColor(string $fontColor): IncidentTag
    {
        $this->fontColor = $fontColor;

        return $this;
    }

    /**
     * @return string
     */
    public function getFontColor(): string
    {
        return $this->fontColor;
    }

    /**
     * @param string $backgroundColor
     * @return IncidentTag
     */
    public function setBackgroundColor($backgroundColor): IncidentTag
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    /**
     * @return string
     */
    public function getBackgroundColor(): string
    {
        return $this->backgroundColor;
    }

    /**
     * @param Incident $incident
     * @return IncidentTag
     */
    public function addIncident(Incident $incident): IncidentTag
    {
        $this->incidents[] = $incident;

        return $this;
    }

    /**
     * @param Incident $incident
     */
    public function removeIncident(Incident $incident): void
    {
        $this->incidents->removeElement($incident);
    }

    /**
     * @return Collection
     */
    public function getIncidents(): Collection
    {
        return $this->incidents;
    }
}
