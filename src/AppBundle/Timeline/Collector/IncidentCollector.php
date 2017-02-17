<?php

namespace AppBundle\Timeline\Collector;

use Caldera\Bundle\CalderaBundle\Entity\Thread;
use Caldera\Bundle\CriticalmassCoreBundle\Timeline\Item\ThreadItem;
use AppBundle\Entity\Incident;
use AppBundle\Timeline\Item\IncidentItem;

class IncidentCollector extends AbstractTimelineCollector
{
    protected function fetchEntities(): array
    {
        return $this->doctrine->getRepository('CalderaCyclewaysBundle:Incident')->findForTimelineIncidentCollector($this->startDateTime, $this->endDateTime);
    }

    protected function groupEntities(array $entities): array
    {
        return $entities;
    }

    protected function convertGroupedEntities(array $groupedEntities): void
    {
        /**
         * @var Incident $incidentEntity
         */
        foreach ($groupedEntities as $incidentEntity) {
            $item = new IncidentItem();

            $item
                ->setUsername($incidentEntity->getUser()->getUsername())
                ->setIncident($incidentEntity)
                ->setTitle($incidentEntity->getTitle())
                ->setDescription($incidentEntity->getDescription())
                ->setDateTime($incidentEntity->getCreationDateTime())
            ;

            $this->addItem($item);
        }
    }
}