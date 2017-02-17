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

    /**
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param \DateTime $dateTime
     * @return Post
     */
    public function setDateTime(\DateTime $dateTime): Post
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateTime(): \DateTime
    {
        return $this->dateTime;
    }

    /**
     * @param string $text
     * @return Post
     */
    public function setText(string $text): Post
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param boolean $enabled
     * @return Post
     */
    public function setEnabled(bool $enabled): Post
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param User $user
     * @return Post
     */
    public function setUser(User $user = null): Post
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param Incident $incident
     * @return Post
     */
    public function setIncident(Incident $incident = null): Post
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
