<?php

namespace AppBundle\Timeline\Item;

use AppBundle\Entity\Incident;
use AppBundle\Entity\Photo;

class IncidentPhotoItem extends AbstractItem
{
    /**
     * @var string $username
     */
    protected $username;

    /**
     * @var Incident $incident
     */
    protected $incident;

    /**
     * @var string $incidentTitle
     */
    protected $incidentTitle;

    /**
     * @var integer $counter
     */
    protected $counter;

    /**
     * @var Photo $previewPhoto
     */
    protected $previewPhoto;

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): IncidentPhotoItem
    {
        $this->username = $username;

        return $this;
    }

    public function getIncident(): Incident
    {
        return $this->incident;
    }

    public function setIncident(Incident $incident): IncidentPhotoItem
    {
        $this->incident = $incident;

        return $this;
    }

    public function getIncidentTitle(): string
    {
        return $this->incidentTitle;
    }

    public function setIncidentTitle(string $incidentTitle): IncidentPhotoItem
    {
        $this->incidentTitle = $incidentTitle;

        return $this;
    }

    public function getCounter(): int
    {
        return $this->counter;
    }

    public function setCounter(int $counter): IncidentPhotoItem
    {
        $this->counter = $counter;

        return $this;
    }

    public function getPreviewPhoto(): Photo
    {
        return $this->previewPhoto;
    }

    public function setPreviewPhoto(Photo $previewPhoto): IncidentPhotoItem
    {
        $this->previewPhoto = $previewPhoto;

        return $this;
    }
}