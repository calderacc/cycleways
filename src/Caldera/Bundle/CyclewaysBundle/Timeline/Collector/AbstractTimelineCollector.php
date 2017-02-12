<?php

namespace Caldera\Bundle\CyclewaysBundle\Timeline\Collector;

use Caldera\Bundle\CyclewaysBundle\Timeline\Item\ItemInterface;
use Doctrine\Bundle\DoctrineBundle\Registry;

abstract class AbstractTimelineCollector
{
    /** @var Registry $doctrine */
    protected $doctrine;

    /** @var array $items */
    protected $items = [];

    /** @var \DateTime $startDateTime */
    protected $startDateTime = null;

    /** @var \DateTime $endDateTime */
    protected $endDateTime = null;

    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function setDateRange(\DateTime $startDateTime, \DateTime $endDateTime): AbstractTimelineCollector
    {
        $this->startDateTime = $startDateTime;
        $this->endDateTime = $endDateTime;

        return $this;
    }

    public function execute(): AbstractTimelineCollector
    {
        $entities = $this->fetchEntities();
        $groupedEntities = $this->groupEntities($entities);
        $this->convertGroupedEntities($groupedEntities);

        return $this;
    }

    protected abstract function fetchEntities();

    protected abstract function groupEntities(array $entities);

    protected abstract function convertGroupedEntities(array $groupedEntities);

    public function getItems(): array
    {
        return $this->items;
    }

    protected function addItem(ItemInterface $item): AbstractTimelineCollector
    {
        $dateTimeString = $item->getDateTime()->format('Y-m-d-H-i-s');

        $itemKey = $dateTimeString . '-' . $item->getUniqId();

        $this->items[$itemKey] = $item;

        return $this;
    }
}