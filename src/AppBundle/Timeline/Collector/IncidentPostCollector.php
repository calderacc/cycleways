<?php

namespace AppBundle\Timeline\Collector;

use AppBundle\Entity\Post;
use AppBundle\Timeline\Item\IncidentPostItem;

class IncidentPostCollector extends AbstractTimelineCollector
{
    protected function fetchEntities(): array
    {
        return $this->doctrine->getRepository('AppBundle:Post')->findForTimelineIncidentPostCollector($this->startDateTime, $this->endDateTime);
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

            $item
                ->setUsername($postEntity->getUser()->getUsername())
                ->setIncidentTitle($postEntity->getIncident()->getTitle())
                ->setIncident($postEntity->getIncident())
                ->setText($postEntity->getText())
                ->setDateTime($postEntity->getDateTime())
            ;

            $this->addItem($item);
        }
    }
}