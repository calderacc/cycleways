<?php

namespace AppBundle\Controller;

use Elastica\ResultSet;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends AbstractController
{
    protected function createQuery($queryPhrase)
    {
        if ($queryPhrase) {
            $simpleQueryString = new \Elastica\Query\SimpleQueryString($queryPhrase, ['title', 'description', 'location']);
        } else {
            $simpleQueryString = new \Elastica\Query\MatchAll();
        }

        $query = new \Elastica\Query($simpleQueryString);

        $query->setSize(50);
        $query->addSort('_score');

        return $query;
    }

    protected function performSearch(\Elastica\Query $query)
    {
        $mngr = $this->get('fos_elastica.index_manager');

        $search = $mngr->getIndex('cycleways')->createSearch();

        return $search->search($query);
    }

    public function searchAction(Request $request)
    {
        $queryPhrase = $request->get('query');

        $query = $this->createQuery($queryPhrase);

        /** @var ResultSet $resultSet */
        $resultSet = $this->performSearch($query);

        $transformer = $this->get('fos_elastica.elastica_to_model_transformer.collection.cycleways');

        $results = $transformer->transform($resultSet->getResults());

        return $this->render('AppBundle:Search:search.html.twig',
            [
                'incidents' => $results,
                'resultSet' => $resultSet,
                'queryPhrase' => $queryPhrase
            ]
        );
    }
}
