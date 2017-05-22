<?php

namespace AppBundle\Controller\Incident;

use AppBundle\Controller\AbstractController;
use AppBundle\Entity\Incident;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IncidentController extends AbstractController
{
    public function showAction(Request $request, string $slug): Response
    {
        /** @var Incident $incident */
        $incident = $this->getIncidentRepository()->findOneBySlug($slug);

        if (!$incident) {
            throw $this->createNotFoundException();
        }

        $posts = $this->getPostManager()->getPostsForIncident($incident);
        $photos = $this->getPhotoRepository()->findByIncident($incident);

        $this->storeView($incident);

        /*$this->getMetadata()
            ->setTitle($this->generatePageTitle($incident))
            ->setDescription($incident->getDescription());
*/
        return $this->render(
            'AppBundle:Incident:show.html.twig',
            [
                'incident' => $incident,
                'posts' => $posts,
                'photos' => $photos

            ]
        );
    }
    
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

    protected function storeView(Incident $incident)
    {
        $viewStorage = $this->get('caldera.view_storage.cache');

        $viewStorage->countView($incident);
    }
}
