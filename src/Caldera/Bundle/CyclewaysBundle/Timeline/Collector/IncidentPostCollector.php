<?php

namespace Caldera\Bundle\CyclewaysBundle\Timeline\Collector;

use Caldera\Bundle\CyclewaysBundle\Entity\Post;
use Caldera\Bundle\CyclewaysBundle\Timeline\Item\IncidentPostItem;

class IncidentPostCollector extends AbstractTimelineCollector
{
    protected function fetchEntities(): array
    {
        return $this->doctrine->getRepository('CalderaCyclewaysBundle:Post')->findForTimelineIncidentPostCollector($this->startDateTime, $this->endDateTime);
    }

    protected function groupEntities(array $entities): array
    {
        return $entities;
    }

    protected function convertGroupedEntities(array $groupedEntities): void
    {
        /**
         * @var Post $postEntity
         */
        foreach ($groupedEntities as $postEntity) {
            $item = new IncidentPostItem();

            $item->setUsername($postEntity->getUser()->getUsername());
            $item->setIncidentTitle($postEntity->getIncident()->getTitle());
            $item->setIncident($postEntity->getIncident());
            $item->setText($postEntity->getText());
            $item->setDateTime($postEntity->getDateTime());

            $this->addItem($item);
        }
    }
}