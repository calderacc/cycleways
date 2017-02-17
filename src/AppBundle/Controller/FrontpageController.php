<?php

namespace AppBundle\Controller;

use AppBundle\Timeline\Timeline;
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
            'AppBundle:Frontpage:index.html.twig',
            [
                'timelineContent' => $timelineContent
            ]);
    }
}
