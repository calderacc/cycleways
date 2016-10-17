<?php

namespace Caldera\Bundle\CyclewaysBundle\Controller;

use Caldera\Bundle\CalderaBundle\Entity\BikeShop;
use Caldera\Bundle\CalderaBundle\Entity\Incident;
use Elastica\Query\MatchAll;
use Elastica\Test\Filter\GeoBoundingBoxTest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DataSourceController extends Controller
{
    public function loadIncidentsAction(Request $request): Response
    {
        $finder = $this->container->get('fos_elastica.finder.criticalmass.incident');

        $topLeft = [
            'lat' => 55.0,
            'lon' => 9.0
        ];

        $bottomRight = [
            'lat' => 53.0,
            'lon' => 11.0
        ];

        $geoFilter = new \Elastica\Filter\GeoBoundingBox('pin', [$topLeft, $bottomRight]);

        $filteredQuery = new \Elastica\Query\Filtered(new \Elastica\Query\MatchAll(), $geoFilter);

        $query = new \Elastica\Query($filteredQuery);

        $query->setSize(15);

        $results = $finder->find($query);

        $serializer = $this->get('jms_serializer');
        $serializedData = $serializer->serialize($results, 'json');

        return new Response($serializedData);
    }
}
