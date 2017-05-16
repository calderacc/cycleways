<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="tag")
 * @ORM\Entity()
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $caption;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $style;

    public function __construct()
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setCaption(string $caption): Tag
    {
        $this->caption = $caption;

        return $this;
    }

    public function getCaption(): string
    {
        return $this->caption;
    }

    public function setStyle(string $style): Tag
    {
        $this->style = $style;

        return $this;
    }

    public function getStyle(): string
    {
        return $this->style;
    }
}
