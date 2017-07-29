<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="incident_tag")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IncidentTagRepository")
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="createdTagList")
     * @ORM\JoinColumn(name="user_created_id", referencedColumnName="id")
     */
    protected $userCreated;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="removedTagList")
     * @ORM\JoinColumn(name="user_removed_id", referencedColumnName="id")
     */
    protected $userRemoved;

    /**
     * @ORM\ManyToOne(targetEntity="Incident", inversedBy="tagList")
     * @ORM\JoinColumn(name="incident_id", referencedColumnName="id")
     */
    protected $incident;

    /**
     * @ORM\ManyToOne(targetEntity="Tag", inversedBy="tagList")
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

    public function setUserCreated(User $user): IncidentTag
    {
        $this->userCreated = $user;

        return $this;
    }

    public function getUserCreated(): User
    {
        return $this->userCreated;
    }

    public function setUserRemoved(User $user = null): IncidentTag
    {
        $this->userRemoved = $user;

        return $this;
    }

    public function getUserRemoved(): ?User
    {
        return $this->userRemoved;
    }

    public function setIncident(Incident $incident): IncidentTag
    {
        $this->incident = $incident;

        return $this;
    }

    public function getIncident(): Incident
    {
        return $this->incident;
    }

    public function setTag(Tag $tag): IncidentTag
    {
        $this->tag = $tag;

        return $this;
    }

    public function getTag(): Tag
    {
        return $this->tag;
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
