<?php

namespace AppBundle\Controller\Photo;

use AppBundle\Controller\AbstractController;
use AppBundle\Entity\City;
use AppBundle\Entity\Incident;
use AppBundle\Entity\Photo;
use AppBundle\Form\Type\PhotoDescriptionType;
use AppBundle\Traits\ViewStorageTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Form;
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

    public function editDescriptionAction(Request $request, UserInterface $user = null, string $slug, int $photoId): Response
    {
        if (!$user) {
            return new Response();
        }

        $photo = $this->getPhotoRepository()->find($photoId);

        if (!$photo) {
            throw $this->createNotFoundException();
        }

        $form = $this->createPhotoDescriptionForm($photo);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $photo = $form->getData();

                $this->getDoctrine()->getManager()->flush();
            }

            return $this->redirectToRoute(
                'caldera_cycleways_incident_photo_show',
                [
                    'slug' => $photo->getIncident()->getSlug(),
                    'photoId' => $photo->getId(),
                ]
            );
        }

        return $this->render(
            'AppBundle:Photo:editDescription.html.twig',
            [
                'photoDescriptionForm' => $form->createView()
            ]
        );
    }

    protected function createPhotoDescriptionForm(Photo $photo): Form
    {
        $form = $this->createForm(
            PhotoDescriptionType::class,
            $photo,
            [
                'action' => $this->generateUrl(
                    'caldera_cycleways_photo_edit_description',
                    [
                        'slug' => $photo->getIncident()->getSlug(),
                        'photoId' => $photo->getId(),
                    ]
                )
            ]
        );

        return $form;
    }
}
