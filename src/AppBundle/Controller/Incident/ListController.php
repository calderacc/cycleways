<?php

namespace AppBundle\Controller\Incident;

use AppBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListController extends AbstractController
{
    public function listAction(Request $request): Response
    {
        $incidentList = $this->getIncidentManager()->findAll();

        return $this->render(
            'AppBundle:Incident:list.html.twig',
            [
                'incidentList' => $incidentList,
            ]
        );
    }
}
