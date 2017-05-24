<?php

namespace AppBundle\Controller\Incident;

use AppBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListController extends AbstractController
{
    public function listAction(Request $request, string $citySlug): Response
    {
        $city = $this->getCityBySlug($citySlug);

        $incidents = $this->getIncidentManager()->getIncidentsForCity($city);

        return $this->render(
            'AppBundle:Incident:list.html.twig',
            [
                'incidents' => $incidents,
                'city' => $city
            ]
        );
    }
}
