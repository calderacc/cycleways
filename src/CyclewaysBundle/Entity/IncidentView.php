<?php

namespace Caldera\Bundle\CyclewaysBundle\Entity;

use Caldera\Bundle\CyclewaysBundle\EntityInterface\ViewInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="incident_view")
 * @ORM\Entity()
 */
class IncidentView implements ViewInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="incident_views")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Incident", inversedBy="incident_views")
     * @ORM\JoinColumn(name="incident_id", referencedColumnName="id")
     */
    protected $incident;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $dateTime;


    public function __construct()
    {
        $this->dateTime = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setUser(User $user = null): ViewInterface
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setDateTime(\DateTime $dateTime): ViewInterface
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getDateTime(): \DateTime
    {
        return $this->dateTime;
    }

    /**
     * @param Incident $incident
     * @return IncidentView
     */
    public function setIncident(Incident $incident = null): IncidentView
    {
        $this->incident = $incident;

        return $this;
    }

    /**
     * @return Incident
     */
    public function getIncident(): ?Incident
    {
        return $this->incident;
    }
}
