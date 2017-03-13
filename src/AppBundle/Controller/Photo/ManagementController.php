<?php

namespace AppBundle\Controller\Photo;

use AppBundle\Controller\AbstractController;
use AppBundle\Entity\Incident;
use AppBundle\Entity\Photo;
use AppBundle\Traits\ViewStorageTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class ManagementController extends AbstractController
{
    public function featuredPhotoAction(Request $request, UserInterface $user, int $photoId): RedirectResponse
    {
        /** @var Photo $photo */
        $photo = $this->getPhotoRepository()->find($photoId);

        if (!$photo) {
            throw $this->createNotFoundException();
        }

        $incident = $photo->getIncident();
        $incident->setFeaturedPhoto($photo);

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute(
            'caldera_cycleways_incident_show',
            [
                'slug' => $incident->getSlug()
            ]
        );
    }

    public function deleteAction(Request $request, UserInterface $user, int $photoId): RedirectResponse
    {
        /** @var Photo $photo */
        $photo = $this->getPhotoRepository()->find($photoId);

        if (!$photo) {
            throw $this->createNotFoundException();
        }

        $photo->setDeleted(true);

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute(
            'caldera_cycleways_incident_show',
            [
                'slug' => $photo->getIncident()->getSlug()
            ]
        );
    }
}
