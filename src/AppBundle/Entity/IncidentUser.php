<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="incident_user")
 * @ORM\Entity()
 */
class IncidentUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="incident_issuer_user")
     * @ORM\JoinColumn(name="issuer_user_id", referencedColumnName="id")
     */
    protected $issuer;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="incident_user")
     * @ORM\JoinColumn(name="issuer_user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Incident", inversedBy="userList")
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setDateTime(\DateTime $dateTime): IncidentUser
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getDateTime(): \DateTime
    {
        return $this->dateTime;
    }

    public function setUser(User $user): IncidentUser
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setIssuer(User $issuer): IncidentUser
    {
        $this->issuer = $issuer;

        return $this;
    }

    public function getIssuer(): ?User
    {
        return $this->issuer;
    }

    public function setIncident(Incident $incident): IncidentUser
    {
        $this->incident = $incident;

        return $this;
    }

    public function getIncident(): ?Incident
    {
        return $this->incident;
    }
}
