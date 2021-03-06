<?php

namespace AppBundle\Controller\Photo;

use AppBundle\Controller\AbstractController;
use AppBundle\Entity\Incident;
use AppBundle\Entity\Photo;
use AppBundle\Traits\ViewStorageTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UploadController extends AbstractController
{
    use ViewStorageTrait;

    public function uploadAction(Request $request, string $slug): Response
    {
        $incident = $this->getIncidentRepository()->findOneBySlug($slug);

        if (!$incident) {
            throw $this->createNotFoundException();
        }

        if ($request->getMethod() == 'POST') {
            return $this->uploadPostAction($request, $incident);
        } else {
            return $this->uploadGetAction($request, $incident);
        }
    }

    protected function uploadGetAction(Request $request, Incident $incident): Response
    {
        return $this->render(
            'AppBundle:Photo:upload.html.twig',
            [
                'incident' => $incident
            ]
        );
    }

    protected function uploadPostAction(Request $request, Incident $incident): Response
    {
        $em = $this->getDoctrine()->getManager();

        $photo = new Photo();

        $photo->setImageFile($request->files->get('file'));
        $photo->setUser($this->getUser());

        $photo->setIncident($incident);
        //$photo->setCity($incident->getCity());

        $em->persist($photo);
        $em->flush();

        return new Response('foo');
    }
}
