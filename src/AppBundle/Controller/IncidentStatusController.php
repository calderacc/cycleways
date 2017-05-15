<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Incident;
use AppBundle\Entity\IncidentStatus;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class IncidentStatusController extends AbstractController
{
    public function renderAction(Request $request, Incident $incident): Response
    {
        $statusList = $this->getDoctrine()->getRepository('AppBundle:Status')->findAll();

        return $this->render('AppBundle:IncidentStatus:list.html.twig', [
            'statusList' => $statusList,
            'incident' => $incident
        ]);
    }

    public function updateAction(Request $request, string $slug, UserInterface $user): Response
    {
        $incidentStatusId = $request->query->getInt('statusId');

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
