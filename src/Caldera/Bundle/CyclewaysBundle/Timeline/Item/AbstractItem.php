<?php

namespace Caldera\Bundle\CyclewaysBundle\Timeline\Item;

abstract class AbstractItem implements ItemInterface
{
    /**
     * @var string $uniqId
     */
    protected $uniqId;

    /**
     * @var \DateTime $dateTime
     */
    protected $dateTime;

    public function __construct()
    {
        $this->uniqId = uniqid();
    }

    public function getDateTime(): \DateTime
    {
        return $this->dateTime;
    }

    public function setDateTime(\DateTime $dateTime): ItemInterface
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getUniqId(): string
    {
        return $this->uniqId;
    }
}