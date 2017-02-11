<?php

namespace Caldera\Bundle\CriticalmassCoreBundle\Timeline\Collector;

use Caldera\Bundle\CalderaBundle\Entity\Thread;
use Caldera\Bundle\CriticalmassCoreBundle\Timeline\Item\ThreadItem;

class ThreadCollector extends AbstractTimelineCollector
{
    protected function fetchEntities()
    {
        return $this->doctrine->getRepository('CalderaBundle:Thread')->findForTimelineThreadCollector($this->startDateTime, $this->endDateTime);
    }

    protected function groupEntities(array $entities)
    {
        return $entities;
    }

    protected function convertGroupedEntities(array $groupedEntities)
    {
        /**
         * @var Thread $threadEntity
         */
        foreach ($groupedEntities as $threadEntity) {
            $item = new ThreadItem();

            $item->setUsername($threadEntity->getFirstPost()->getUser()->getUsername());
            $item->setThread($threadEntity);
            $item->setTitle($threadEntity->getTitle());
            $item->setText($threadEntity->getFirstPost()->getMessage());
            $item->setDateTime($threadEntity->getFirstPost()->getDateTime());

            $this->addItem($item);
        }
    }
}