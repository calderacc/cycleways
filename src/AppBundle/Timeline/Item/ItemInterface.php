<?php

namespace AppBundle\Timeline\Item;

interface ItemInterface
{
    public function setDateTime(\DateTime $dateTime): ItemInterface;

    public function getDateTime(): \DateTime;

    public function getUniqId(): string;
}