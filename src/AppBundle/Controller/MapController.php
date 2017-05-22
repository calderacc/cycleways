<?php

namespace AppBundle\Controller;

use Caldera\GeoBasic\Bounds\Bounds;
use Caldera\GeoBasic\Coord\Coord;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MapController extends AbstractController
{
    public function mapAction(Request $request, $citySlug): Response
    {
        $city = $this->getCityBySlug($citySlug);

        return $this->render(
            'AppBundle:Incident:map.html.twig',
            [
                'city' => $city
            ]
        );
    }

    public function loadAction(Request $request): Response
    {
        if (
            !$request->request->get('northWestLatitude') ||
            !$request->request->get('northWestLongitude') ||
            !$request->request->get('southEastLatitude') ||
            !$request->request->get('southEastLongitude')
        ) {
            throw $this->createNotFoundException();
        }

        $northWest = new Coord(
            $request->request->get('northWestLatitude'),
            $request->request->get('northWestLongitude')
        );
        
        $southEast = new Coord(
            $request->request->get('southEastLatitude'),
            $request->request->get('southEastLongitude')
        );

        if ($request->request->get('knownIndizes') && is_array($request->request->get('knownIndizes'))) {
            $knownIndizes = $request->request->get('knownIndizes');
        } else {
            $knownIndizes = [];
        }
        
        $bounds = new Bounds($northWest, $southEast);
        
        $results = $this->getIncidentManager()->getIncidentsInBounds($bounds, $knownIndizes);

        $serializer = $this->get('jms_serializer');
        $serializedData = $serializer->serialize($results, 'json');

        return new Response($serializedData);
    }
}
