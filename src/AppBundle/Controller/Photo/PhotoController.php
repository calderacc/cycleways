<?php

namespace AppBundle\Controller\Photo;

use AppBundle\Controller\AbstractController;
use AppBundle\Entity\Photo;
use AppBundle\Traits\ViewStorageTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PhotoController extends AbstractController
{
    use ViewStorageTrait;

    public function showAction(Request $request, string $slug, int $photoId): Response
    {
        $incident = $this->getIncidentRepository()->findOneBySlug($slug);

        if (!$incident) {
            throw $this->createNotFoundException();
        }

        /** @var Photo $photo */
        $photo = $this->getPhotoRepository()->find($photoId);

        $previousPhoto = $this->getPhotoRepository()->getPreviousPhoto($photo);
        $nextPhoto = $this->getPhotoRepository()->getNextPhoto($photo);

        $this->countPhotoView($photo);

        return $this->render('AppBundle:Photo:show.html.twig',
            [
                'photo' => $photo,
                'nextPhoto' => $nextPhoto,
                'previousPhoto' => $previousPhoto,
                'incident' => $incident
            ]
        );
    }
}
