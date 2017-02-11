<?php

namespace Caldera\Bundle\CyclewaysBundle\Timeline\Collector;

use Caldera\Bundle\CalderaBundle\Entity\Thread;
use Caldera\Bundle\CriticalmassCoreBundle\Timeline\Item\ThreadItem;
use Caldera\Bundle\CyclewaysBundle\Entity\Incident;
use Caldera\Bundle\CyclewaysBundle\Timeline\Item\IncidentItem;

class IncidentCollector extends AbstractTimelineCollector
{
    protected function fetchEntities()
    {
        return $this->doctrine->getRepository('CalderaCyclewaysBundle:Incident')->findForTimelineIncidentCollector($this->startDateTime, $this->endDateTime);
    }

    protected function groupEntities(array $entities)
    {
        return $entities;
    }

    protected function convertGroupedEntities(array $groupedEntities)
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
                ->setDateTime($incidentEntity->getDateTime())
            ;

            $this->addItem($item);
        }
    }
}