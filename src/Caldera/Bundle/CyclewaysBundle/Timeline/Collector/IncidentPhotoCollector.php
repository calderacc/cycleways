<?php

namespace Caldera\Bundle\CyclewaysBundle\Timeline\Collector;

use Caldera\Bundle\CyclewaysBundle\Entity\Photo;
use Caldera\Bundle\CyclewaysBundle\Timeline\Item\IncidentPhotoItem;

class IncidentPhotoCollector extends AbstractTimelineCollector
{
    protected function fetchEntities(): array
    {
        return $this->doctrine->getRepository('CalderaCyclewaysBundle:Photo')->findForTimelinePhotoCollector($this->startDateTime, $this->endDateTime);
    }

    protected function groupEntities(array $photoEntities): array
    {
        $groupedEntities = [];

        /**
         * @var Photo $photoEntity
         */
        foreach ($photoEntities as $photoEntity) {
            $userKey = $photoEntity->getUser()->getId();
            $incidentKey = $photoEntity->getIncident()->getId();
            $photoKey = $photoEntity->getId();

            if (!array_key_exists($userKey, $groupedEntities) || !is_array($groupedEntities[$userKey])) {
                $groupedEntities[$userKey] = [];
            }

            $groupedEntities[$userKey][$incidentKey][$photoKey] = $photoEntity;
        }

        return $groupedEntities;
    }

    protected function convertGroupedEntities(array $groupedEntities): void
    {
        foreach ($groupedEntities as $userGroup) {
            foreach ($userGroup as $incidentGroup) {
                $item = new IncidentPhotoItem();
                $item->setCounter(count($incidentGroup));

                // grab a random photo as preview
                $previewPhotoId = array_rand($incidentGroup);
                $item->setPreviewPhoto($incidentGroup[$previewPhotoId]);

                // take last photo to fetch $user and $ride and $dateTime
                /** @var Photo $lastPhoto */
                $lastPhoto = array_pop($incidentGroup);

                $item
                    ->setUsername($lastPhoto->getUser()->getUsername())
                    ->setIncident($lastPhoto->getIncident())
                    ->setIncidentTitle($lastPhoto->getIncident()->getTitle())
                    ->setDateTime($lastPhoto->getCreationDateTime())
                ;

                $this->addItem($item);
            }
        }
    }
}