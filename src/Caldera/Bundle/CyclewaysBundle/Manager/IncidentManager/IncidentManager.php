<?php

namespace Caldera\Bundle\CyclewaysBundle\Manager\IncidentManager;

use Caldera\Bundle\CyclewaysBundle\Entity\City;
use Caldera\Bundle\CyclewaysBundle\Manager\AbstractElasticManager;
use Caldera\Bundle\CyclewaysBundle\Repository\IncidentRepository;

class IncidentManager extends AbstractElasticManager
{
    /** @var IncidentRepository $incidentRepository */
    protected $incidentRepository = null;

    public function __construct($doctrine, $elasticIndex)
    {
        parent::__construct($doctrine, $elasticIndex);

        $this->incidentRepository = $this->doctrine->getRepository('CalderaCyclewaysBundle:Incident');
    }

    public function getIncidentsInBounds(Bounds $bounds, array $knownIndizes = []): array
    {
        $filterList = [];
        $filterList[] = new \Elastica\Filter\GeoBoundingBox('pin', $bounds->toLatLonArray());

        $knownIndexFilters = [];

        foreach ($knownIndizes as $knownIndex) {
            $knownIndexFilters[] = new \Elastica\Filter\Term(['id' => $knownIndex]);
        }

        if (count($knownIndexFilters)) {
            $filterList[] = new \Elastica\Filter\BoolNot(new \Elastica\Filter\BoolOr($knownIndexFilters));

        }

        $andFilter = new \Elastica\Filter\BoolAnd($filterList);

        $filteredQuery = new \Elastica\Query\Filtered(new \Elastica\Query\MatchAll(), $andFilter);

        $query = new \Elastica\Query($filteredQuery);

        $query->setSize(500);

        $result = $this->elasticManager->getRepository('CyclewaysBundle:Incident')->find($query);

        return $result;
    }

    public function getIncidentsForCity(City $city): array
    {
        return $this->incidentRepository->findAll();
    }
}