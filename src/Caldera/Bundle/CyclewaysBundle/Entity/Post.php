<?php

namespace Caldera\Bundle\CyclewaysBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="Caldera\Bundle\CyclewaysBundle\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="posts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Incident", inversedBy="posts")
     * @ORM\JoinColumn(name="incident_id", referencedColumnName="id")
     */
    protected $incident;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $dateTime;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    protected $text;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $enabled = true;

    public function __construct()
    {
        $this->dateTime = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setDateTime(\DateTime $dateTime): Post
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getDateTime(): \DateTime
    {
        return $this->dateTime;
    }

    public function setText(string $text): Post
    {
        $this->text = $text;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setEnabled(bool $enabled): Post
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    public function setUser(User $user = null): Post
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setIncident(Incident $incident = null): Post
    {
        $this->incident = $incident;

        return $this;
    }

    public function getIncident(): ?Incident
    {
        return $this->incident;
    }
}
