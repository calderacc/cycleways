<?php

namespace Caldera\Bundle\CyclewaysBundle\Controller;

use Caldera\Bundle\CyclewaysBundle\Timeline\Timeline;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FrontpageController extends AbstractController
{
    public function indexAction(Request $request): Response
    {
        $endDateTime = new \DateTime();
        $startDateTime = new \DateTime();
        $monthInterval = new \DateInterval('P3M');
        $startDateTime->sub($monthInterval);

        /**
         * @var Timeline $timeline
         */
        $timelineContent = $this
            ->get('cycleways.timeline.cached')
            ->setDateRange($startDateTime, $endDateTime)
            ->execute()
            ->getTimelineContent();

        return $this->render(
            'CalderaCyclewaysBundle:Frontpage:index.html.twig',
            [
                'timelineContent' => $timelineContent
            ]);
    }
}
