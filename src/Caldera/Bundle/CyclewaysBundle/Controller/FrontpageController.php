<?php

namespace Caldera\Bundle\CyclewaysBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

class FrontpageController extends AbstractController
{
    public function indexAction(Request $request)
    {
        return $this->redirectToRoute(
            'caldera_cycleways_incident_map_city',
            [
                'citySlug' => 'hamburg'
            ]
        );
    }
}
