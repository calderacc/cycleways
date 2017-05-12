<?php

namespace AppBundle\Controller;

use AppBundle\Timeline\Timeline;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FrontpageController extends AbstractController
{
    public function indexAction(Request $request): Response
    {
        $incidentList = $this->getIncidentRepository()->findLatest();
        $postList = $this->getPostRepository()->findLatest();

        return $this->render(
            'AppBundle:Frontpage:index.html.twig',
            [
                'incidentList' => $incidentList,
                'postList' => $postList,
            ]);
    }
}
