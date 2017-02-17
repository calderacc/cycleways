<?php

namespace AppBundle\Timeline\Item;

use AppBundle\Entity\Incident;

class IncidentPostItem extends AbstractItem
{
    /**
     * @var string $username
     */
    public $username;

    /**
     * @var Incident $incident
     */
    public $incident;

    /**
     * @var string $incidentTitle
     */
    public $incidentTitle;

    /**
     * @var string $text
     */
    public $text;

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): IncidentPostItem
    {
        $this->username = $username;

        return $this;
    }

    public function getIncident(): Incident
    {
        return $this->incident;
    }

    public function setIncident(Incident $incident): IncidentPostItem
    {
        $this->incident = $incident;

        return $this;
    }

    public function getIncidentTitle(): string
    {
        return $this->incidentTitle;
    }

    public function setIncidentTitle(string $incidentTitle): IncidentPostItem
    {
        $this->incidentTitle = $incidentTitle;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): IncidentPostItem
    {
        $this->text = $text;

        return $this;
    }

}