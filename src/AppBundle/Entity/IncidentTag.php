<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="incident_tag")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Incident", inversedBy="incident_tag")
     * @ORM\JoinColumn(name="incident_id", referencedColumnName="id")
     */
    protected $incident;

    /**
     * @ORM\ManyToOne(targetEntity="Tag", inversedBy="incident_tag")
     * @ORM\JoinColumn(name="tag_id", referencedColumnName="id")
     */
    protected $tag;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $dateTimeAdded;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $dateTimeRemoved;

    public function __construct()
    {
        $this->dateTimeAdded = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setUser(User $user): IncidentTag
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setIncident(Incident $incident): IncidentTag
    {
        $this->incident = $incident;

        return $this;
    }

    public function getIncident(): ?Incident
    {
        return $this->incident;
    }

    public function setDateTimeAdded(\DateTime $dateTimeAdded): IncidentTag
    {
        $this->dateTimeAdded = $dateTimeAdded;

        return $this;
    }

    public function getDateTimeAdded(): \DateTime
    {
        return $this->dateTimeAdded;
    }

    public function setDateTimeRemoved(\DateTime $dateTimeRemoved): IncidentTag
    {
        $this->dateTimeRemoved = $dateTimeRemoved;

        return $this;
    }

    public function getDateTimeRemoved(): \DateTime
    {
        return $this->dateTimeRemoved;
    }
}
