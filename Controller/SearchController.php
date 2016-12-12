<?php

namespace Caldera\Bundle\CriticalmassSiteBundle\Controller;

use Caldera\Bundle\CalderaBundle\Entity\City;
use Caldera\Bundle\CalderaBundle\Entity\Content;
use Caldera\Bundle\CalderaBundle\Entity\Ride;
use Elastica\Query;
use Elastica\ResultSet;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchController extends AbstractController
{
    protected function createQuery($queryPhrase, \Elastica\Filter\AbstractFilter $cityFilter, \Elastica\Filter\AbstractFilter $countryFilter)
    {
        if ($queryPhrase) {
            $simpleQueryString = new \Elastica\Query\SimpleQueryString($queryPhrase, ['title', 'description', 'location']);
        } else {
            $simpleQueryString = new \Elastica\Query\MatchAll();
        }

        $dateTimeRange = new \Elastica\Query\Range();
        $dateTimeRange->addField('dateTime',
            [
                'lte' => '2013-01-01 00:00:00',
            ]
        );

        $boolQuery = new \Elastica\Query\BoolQuery();
        $boolQuery->addMust($simpleQueryString);
        $boolQuery->addMust($dateTimeRange);

        $archivedFilter = new \Elastica\Filter\Term(['isArchived' => false]);
        $enabledFilter = new \Elastica\Filter\Term(['isEnabled' => true]);

        $filter = new \Elastica\Filter\BoolAnd([$archivedFilter, $enabledFilter, $cityFilter, $countryFilter]);

        $filteredQuery = new \Elastica\Query\Filtered($boolQuery, $filter);

        $query = new \Elastica\Query($filteredQuery);

        $query->setSize(50);
        $query->addSort('_score');

        return $query;
    }

    protected function performSearch(\Elastica\Query $query)
    {
        $mngr = $this->get('fos_elastica.index_manager');

        $search = $mngr->getIndex('criticalmass')->createSearch();

        $search->addType('ride');
        $search->addType('city');

        return $search->search($query);
    }

    protected function addAggregations(\Elastica\Query $query)
    {
        $aggregation = new \Elastica\Aggregation\Terms('city');
        $aggregation->setField('city');
        $aggregation->setSize(50);
        $query->addAggregation($aggregation);

        $aggregation = new \Elastica\Aggregation\Terms('country');
        $aggregation->setField('country');
        $aggregation->setSize(50);
        $query->addAggregation($aggregation);

        return $query;
    }

    protected function createCityFilter(array $cities = [])
    {
        $filters = [];

        foreach ($cities as $city) {
            $filters[] = new \Elastica\Filter\Term(['city' => $city]);
        }

        return new \Elastica\Filter\BoolOr($filters);
    }

    protected function createCountryFilter(array $countries = [])
    {
        $filters = [];

        foreach ($countries as $country) {
            $filters[] = new \Elastica\Filter\Term(['country' => $country]);
        }

        return new \Elastica\Filter\BoolOr($filters);
    }

    public function queryAction(Request $request)
    {
        $queryPhrase = $request->get('query');
        $cities = $request->get('cities');
        $countries = $request->get('countries');

        if ($cities) {
            $cityFilter = $this->createCityFilter($cities);
        } else {
            $cityFilter = new \Elastica\Filter\MatchAll();
        }

        if ($countries) {
            $countryFilter = $this->createCountryFilter($countries);
        } else {
            $countryFilter = new \Elastica\Filter\MatchAll();
        }

        $query = $this->createQuery($queryPhrase, $cityFilter, $countryFilter);

        $query = $this->addAggregations($query);

        /** @var ResultSet $resultSet */
        $resultSet = $this->performSearch($query);

        $transformer = $this->get('fos_elastica.elastica_to_model_transformer.collection.criticalmass');

        $results = $transformer->transform($resultSet->getResults());

        return $this->render('CalderaCriticalmassSiteBundle:Search:result.html.twig',
            [
                'results' => $results,
                'resultSet' => $resultSet,
                'query' => $queryPhrase

            ]
        );
    }

    public function prefetchAction(Request $request)
    {
        $result = [];

        $rides = $this->getRideRepository()->findCurrentRides();

        /** @var Ride $ride */
        foreach ($rides as $ride) {
            $result[] = [
                'type' => 'ride',
                'url' => $this->generateObjectUrl($ride),
                'value' => $ride->getFancyTitle(),
                'meta' => [
                    'dateTime' => $ride->getDateTime()->format('Y-m-d\TH:i:s'),
                    'location' => ($ride->getHasLocation() ? $ride->getLocation() : '')
                ]
            ];
        }

        $cities = $this->getCityRepository()->findEnabledCities();

        /** @var City $city */
        foreach ($cities as $city) {
            $result[] = [
                'type' => 'city',
                'url' => $this->generateObjectUrl($city),
                'value' => $city->getCity()
            ];
        }

        $contents = $this->getContentRepository()->findEnabledContent();

        /** @var Content $content */
        foreach ($contents as $content) {
            $result[] = [
                'type' => 'content',
                'url' => $this->generateObjectUrl($content),
                'value' => $content->getTitle()
            ];
        }

        return new Response(
            json_encode($result),
            200,
            [
                'Content-Type' => 'text/json'
            ]
        );
    }
}
