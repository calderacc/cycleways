<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Incident;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
}
