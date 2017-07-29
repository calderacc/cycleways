<?php

namespace AppBundle\Controller\Incident;

use AppBundle\Controller\AbstractController;
use AppBundle\Entity\Incident;
use AppBundle\Entity\IncidentStatus;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class StatusController extends AbstractController
{
    public function widgetAction(Request $request, Incident $incident): Response
    {
        $statusList = $this->getDoctrine()->getRepository('AppBundle:Status')->findAll();

        return $this->render('AppBundle:IncidentStatus:widget.html.twig', [
            'statusList' => $statusList,
            'incident' => $incident
        ]);
    }

    public function updateAction(Request $request, string $slug, UserInterface $user): Response
    {
        $incidentStatusId = $request->request->getInt('statusId');

        /** @var Incident $incident */
        $incident = $this->getIncidentRepository()->findOneBySlug($slug);

        $status = $this->getDoctrine()->getRepository('AppBundle:Status')->find($incidentStatusId);

        $incidentStatus = new IncidentStatus();

        $incidentStatus
            ->setIncident($incident)
            ->setStatus($status)
            ->setUser($user)
        ;

        $incident->setIncidentStatus($incidentStatus);

        $this->getDoctrine()->getManager()->persist($incidentStatus);
        $this->getDoctrine()->getManager()->flush();

        return new Response();
    }
}
