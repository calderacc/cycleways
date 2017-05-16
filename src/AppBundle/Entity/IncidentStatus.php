<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="incident_status")
 * @ORM\Entity()
 */
class IncidentStatus
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="incidentStatusList")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Incident", inversedBy="incidentStatusList")
     * @ORM\JoinColumn(name="incident_id", referencedColumnName="id")
     */
    protected $incident;

    /**
     * @ORM\ManyToOne(targetEntity="Status", inversedBy="incidentStatusList")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    protected $status;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $dateTime;

    public function __construct()
    {
        $this->dateTime = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setDateTime(\DateTime $dateTime): IncidentStatus
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getDateTime(): \DateTime
    {
        return $this->dateTime;
    }

    public function setStatus(Status $status): IncidentStatus
    {
        $this->status = $status;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setUser(User $user = null): IncidentStatus
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setIncident(Incident $incident = null): IncidentStatus
    {
        $this->incident = $incident;

        return $this;
    }

    public function getIncident(): ?Incident
    {
        return $this->incident;
    }
}
