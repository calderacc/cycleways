<?php

namespace Caldera\Bundle\CyclewaysBundle\Controller;

use Caldera\Bundle\CyclewaysBundle\Entity\Incident;
use Elastica\Exception\NotImplementedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends AbstractController
{
    public function apiAction(Request $request): JsonResponse
    {
        return $this->deadlyAccidentApi($request);
    }

    protected function deadlyAccidentApi(Request $request): JsonResponse
    {
        $year = $request->query->get('year');

        if (!$year) {
            throw new NotImplementedException();
        }

        $incidentList = $this->getIncidentManager()->getIncidentsByType(Incident::INCIDENT_DEADLY_ACCIDENT, $year);

        $jsonResponse = $this->get('jms_serializer')->serialize($incidentList, 'json');

        return new JsonResponse($jsonResponse, 200, []);
    }
}
