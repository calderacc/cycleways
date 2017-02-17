<?php

namespace AppBundle\Controller;

use AppBundle\Manager\IncidentManager\IncidentManager;
use AppBundle\Manager\PostManager\PostManager;
use AppBundle\Repository\IncidentRepository;
use AppBundle\Repository\PhotoRepository;
use AppBundle\Repository\PostRepository;
use AppBundle\Entity\City;
use AppBundle\Repository\CityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class AbstractController extends Controller
{
    protected function isLoggedIn(): bool
    {
        return $this
            ->get('security.authorization_checker')
            ->isGranted('IS_AUTHENTICATED_FULLY');
    }

    protected function getCityBySlug(string $slug): City
    {
        $city = $this->getCityRepository()->findOneBySlug($slug);

        if (!$city) {
            throw $this->createNotFoundException();
        }

        return $city;
    }

    protected function getPostManager(): PostManager
    {
        return $this->get('caldera.cycleways.manager.post_manager');
    }

    protected function getIncidentManager(): IncidentManager
    {
        return $this->get('caldera.cycleways.manager.incident_manager');
    }

    protected function getCityRepository(): CityRepository
    {
        return $this->getDoctrine()->getRepository('AppBundle:City');
    }

    protected function getIncidentRepository(): IncidentRepository
    {
        return $this->getDoctrine()->getRepository('AppBundle:Incident');
    }

    protected function getPhotoRepository(): PhotoRepository
    {
        return $this->getDoctrine()->getRepository('AppBundle:Photo');
    }

    protected function getPostRepository(): PostRepository
    {
        return $this->getDoctrine()->getRepository('CalderaBundle:Post');
    }
}