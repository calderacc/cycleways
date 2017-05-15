<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Incident;
use AppBundle\Entity\IncidentStatus;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class IssuerController extends AbstractController
{
    public function renderAction(Request $request, Incident $incident): Response
    {
        $userList = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();

        return $this->render('AppBundle:Issuer:list.html.twig', [
            'userList' => $userList,
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
