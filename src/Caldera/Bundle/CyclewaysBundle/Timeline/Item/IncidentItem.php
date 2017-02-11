<?php

namespace Caldera\Bundle\CyclewaysBundle\Timeline\Item;

use Caldera\Bundle\CyclewaysBundle\Entity\Incident;

class IncidentItem extends AbstractItem
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
     * @var string $title
     */
    public $title;

    /**
     * @var string $text
     */
    public $text;

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): IncidentItem
    {
        $this->username = $username;

        return $this;
    }

    public function getIncident(): Incident
    {
        return $this->incident;
    }

    public function setIncident(Incident $incident): IncidentItem
    {
        $this->incident = $incident;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): IncidentItem
    {
        $this->title = $title;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): IncidentItem
    {
        $this->text = $text;

        return $this;
    }
}