<?php

namespace Caldera\Bundle\CyclewaysBundle\Entity;

use Caldera\Bundle\CyclewaysBundle\EntityInterface\ViewInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="photo_view")
 * @ORM\Entity()
 */
class PhotoView implements ViewInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="photo_views")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Photo", inversedBy="photo_views")
     * @ORM\JoinColumn(name="photo_id", referencedColumnName="id")
     */
    protected $photo;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $dateTime;

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

    public function setPhoto(Photo $photo = null): PhotoView
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPhoto(): ?Photo
    {
        return $this->photo;
    }
}
