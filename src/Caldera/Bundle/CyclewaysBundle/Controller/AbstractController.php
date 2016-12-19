<?php

namespace Caldera\Bundle\CyclewaysBundle\Controller;

use Caldera\Bundle\CalderaBundle\Repository\IncidentRepository;
use Caldera\Bundle\CalderaBundle\Repository\PhotoRepository;
use Caldera\Bundle\CalderaBundle\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class AbstractController extends Controller
{
    protected function isLoggedIn(): bool
    {
        return $this
            ->get('security.authorization_checker')
            ->isGranted('IS_AUTHENTICATED_FULLY');
    }

    protected function getCityRepository(): CityRepository
    {
        return $this->getDoctrine()->getRepository('CalderaCyclewaysBundle:City');
    }

    protected function getIncidentRepository(): IncidentRepository
    {
        return $this->getDoctrine()->getRepository('CalderaCyclewaysBundle:Incident');
    }

    protected function getPhotoRepository(): PhotoRepository
    {
        return $this->getDoctrine()->getRepository('CalderaCyclewaysBundle:Photo');
    }

    protected function getPostRepository(): PostRepository
    {
        return $this->getDoctrine()->getRepository('CalderaBundle:Post');
    }
}